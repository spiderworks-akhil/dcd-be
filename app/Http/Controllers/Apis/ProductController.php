<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ProductCollection;
use App\Models\Product;
use App\Models\AttributeValueImage;
use App\Http\Resources\ProductResource;
use App\Http\Resources\AttributeImageResourceCollection;

class ProductController extends Controller
{
    public function index(Request $request){
        try{
            $data = $request->all();           
            $limit = !empty($data['limit'])?(int)$data['limit']:10;
            $products = Product::where('status', 1);
            $products = $products->orderBy('priority', 'DESC')->paginate($limit);
            return new ProductCollection($products);
        }
        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function view(Request $request, $slug){
        try{
            $data = $request->all();
            
            $product = Product::where('slug', $slug)->where('status', 1)->first();
            if(!$product)
                return response()->json(['error' => 'Not found'], 404);
            return new ProductResource($product);
        }
        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function ProductImages(Request $request, $id)
    {
        try{
            $data = $request->all();
            
            $images = AttributeValueImage::where('product_id', $id)->where('status', 1)->get();
            if(!$images)
                return response()->json(['error' => 'Not found'], 404);

            return new AttributeImageResourceCollection($images);
        }
        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
