<?php

namespace App\Http\Controllers;

use App\Utility\FileManager\FileManager;
use DB;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class IndexController extends Controller
{
	public function index() {
		return view('index');
	}

	public function upload(Request $request) {
		if ($request->ajax ()){
			try{
				$result = $resources = FileManager::uploadPropertyPicturesAdmin ($request);
				if ($result){
					return response (json_encode (['id'=>$request->get('property')],JSON_UNESCAPED_UNICODE),200);
				}else
					return response (json_encode (['result'=>$result],JSON_UNESCAPED_UNICODE),200);

			}catch (\Exception $e){
				return response (json_encode (['error'=>'خطا در ثبت اطلاعات'],JSON_UNESCAPED_UNICODE),400);
			}

		}
		return redirect (route ('index'));
    }
}
