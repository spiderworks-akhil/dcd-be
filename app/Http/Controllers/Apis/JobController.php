<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\JobApplication;
use App\Http\Requests\Job as JobRequest;
use App\Http\Resources\Job as JobResource;
use App\Http\Resources\JobCollection;
use App\Services\MailSettings;
use App\Models\Setting;
use App\Traits\ClientInfoTrait;
use File;


class JobController extends Controller
{
    use ClientInfoTrait;

    public function index(Request $request){
        try{
            $data = $request->all();
            $limit = !empty($data['limit'])?(int)$data['limit']:10;
            $jobs = Job::where('status', 1);
            $jobs = $jobs->orderBy('priority', 'DESC')->paginate($limit);
            return new JobCollection($jobs);
        }
        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function featured(){
        $jobs = Job::select('name','title','short_description','id','slug','featured_image_id','banner_image_id')->with(['featured_image','banner_image'])->where('status', 1)->where('is_featured', 1)->orderBy('priority','DESC')->get();
        return new JobCollection($jobs);
    }


    public function view(Request $request, $slug){
        try{
            $data = $request->all();
            $job = Job::with(['featured_image','banner_image'])->where('slug', $slug)->where('status', 1)->first();
            if(!$job)
                return response()->json(['error' => 'Not found'], 404);
            return new JobResource($job);
        }
        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function apply(JobRequest $request){
        try{
            $request->validated();
            $data = $request->all();
            if ( $request->hasFile('resume')) {
                $file = $request->file('resume');
                if($file->isValid())
                {

                    $filenameWithExt = $file->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;
                    $path = $file->storeAs('resume', $fileNameToStore, ['disk' => 'public']);
                    $data['resume'] = 'uploads/'.$path;
                }
            }
            $job = new JobApplication();

            $job->ip_address = $this->get_ip();
            $job->fill($data);
            if($job->save()){
                $notif_emails = Setting::where('code','career_notification_email_ids')->first();

                if($notif_emails && trim($notif_emails->value_text) != '')
                {
                    $mail = new MailSettings;
                    $email_array = explode(',', $notif_emails->value_text);
                    array_filter($email_array, function($value){ 
                        return !is_null($value) && $value !== '';
                    });
                    $email_array = array_map('trim', $email_array);
                    $mail->to($email_array)->send(new \App\Mail\JobApplication($job));
                }
            }
            return response()->json(['success' => true]);
        }
        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


}
