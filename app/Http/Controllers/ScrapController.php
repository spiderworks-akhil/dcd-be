<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\News;
use App\Models\Media;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ScrapController extends Controller
{

    public function fetchDataFromWebflow()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.webflow.com/v2/collections/66a8d6161e1f1316fde881b8/items/');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer 08eadbef2bd743316788362990f4899c66573209beaca413cb45a623a0757054',
            'Accept: application/json',
        ]);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);
        return $data;

    }

    public function insertDataIntoNews()
    {
        $data = $this->fetchDataFromWebflow();

        if (!empty($data)) {
            $details = [];
            foreach ($data['items'] as $key => $item) {
                echo "started..<br>";
                if (!News::where('slug', $item['fieldData']['slug'])->where('type','ar')->exists()) {
                    $news = new News();
                    $news->slug = $item['fieldData']['slug'];
                    $news->type = 'ar';
                    $news->name = $item['fieldData']['name'];
                    $news->title = $item['fieldData']['title'] ?? $item['fieldData']['name'];
                    $news->created_at = Carbon::parse($item['createdOn'])->format('Y-m-d H:i:s');
                    $news->published_on = Carbon::parse($item['fieldData']['date'])->format('Y-m-d H:i:s');
                    $news->browser_title = $item['fieldData']['title'] ?? $item['fieldData']['name'];
                    $news->meta_description = $item['fieldData']['description'] ?? null;
                    $news->content = $item['fieldData']['content'];
                    if (isset($item['fieldData']['image']['url'])) {
                        $news->featured_image_id = $this->saveImage($item['fieldData']['image']['url']) ?? null;
                        $news->banner_image_id = $this->saveImage($item['fieldData']['image']['url']) ?? null;
                    }
                    if (isset($item['fieldData']['author-name'])) {
                        $autherData = new \stdClass();
                        $autherData->name = $item['fieldData']['author-name'];
                        $autherData->image = $item['fieldData']['author-avatar']['url'] ?? null;
                        $news->published_by_author_id = $this->checkAuther($autherData);
                    }
                    $news->raw_data = json_encode($item);
                    $news->created_by = 1;
                    $news->updated_by = 1;
                    $news->save();
                    $details[] = $news;
                    echo $news->id . ":".$news->name."<br>";
                } else {
                    echo $key.":".$item['fieldData']['slug']." already exists.<br>";
                }
            }
            echo "end..";
        }
    }

    public function saveImage($url, $folder = "news")
    {
        $name = basename($url);
        $data = pathinfo($name);
        $rand = rand(11111, 99999);
        $slugName = $this->slug($data['filename']) . "-" . $rand . "." . $data['extension'];
        $path = public_path($folder . '/' . $slugName);

        try {
            $image = file_get_contents($url);

            if (!file_exists(public_path($folder))) {
                mkdir(public_path($folder), 0755, true);
            }

            $filesize = file_put_contents($path, $image);

            $media = new Media();
            $media->file_name = $slugName;
            $media->file_path = $folder . '/' . $slugName;
            $media->thumb_file_path = $media->file_path;
            $media->file_size = $filesize;

            try {
                $imagesize = getimagesize($path);
                $media->file_type = $imagesize['mime'];
                $media->dimensions = $imagesize[0] . " X " . $imagesize[1];
            } catch (\Exception $e) {
                $media->file_type = 'NO/FAIL';
                $media->dimensions = '0 X 0';
            }

            $media->media_type = 'Image';
            $media->is_public = 1;
            $media->created_by = 1;
            $media->updated_by = 1;
            $media->created_at = Carbon::now();
            $media->updated_at = Carbon::now();
            $media->save();

            return $media->id;
        } catch (\Exception $e) {
            return $e;
        }
    }
    public static function slug($slug)
    {
        return strtolower(preg_replace('/[-+()^ $%&.*~]+/', '-', $slug));
    }
    public function checkAuther($a)
    {

        $auther = Author::where('name', $a->name)->first();
        if (!$auther) {
            $auther = new Author();
            $auther->name = $a->name;
            $auther->designation = 'Project Updates';
            $auther->featured_image_id = isset($a->image) ? $this->saveImage($a->image) : null;
            $auther->created_by = 1;
            $auther->updated_by = 1;
            $auther->save();
        }
        return $auther->id;
    }

    public function NewsUpdate()
    {
        $news  = News::where('status',1)->get();
        foreach ($news as $key => $value) {
             $raw_data = json_decode($value->raw_data);

             $t_c = !empty($raw_data['fieldData']['table-content'])?$raw_data['fieldData']['table-content']:null;
             if($t_c != null)
             $value->news_title = $t_c;
            echo $value->id."added </br>";
        }
    }

    public function ImageUpdate()
    {
        $news  = News::where('status',1)->get();
        foreach ($news as $key => $value) {
             $raw_data = json_decode($value->raw_data, true);

             $img_path = !empty($raw_data['fieldData']['image']['url'])?$raw_data['fieldData']['image']['url']:null;
             if($img_path != null)

             $value->featured_image_id = $this->saveImage($img_path) ?? null;
             $value->banner_image_id = $this->saveImage($img_path) ?? null;
             $value->update();

            echo $value->id."image updated </br>";
        }
    }}
