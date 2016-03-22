<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Input;

use Response;

use Validator;

class ImageController extends Controller
{

    	public function postUpload() {
		$file = Input::file('image');
		$input = array('image' => $file);
		$rules = array(
			'image' => 'image'
		);
		$validator = Validator::make($input, $rules);
		if ( $validator->fails() )
		{
			return Response::json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()]);

		}
		else {
			$destinationPath = 'uploads/';
			$filename = $file->getClientOriginalName();
			$filename = rand(10000000000,99999999999999).'.'.$filename; // renameing image
			Input::file('image')->move($destinationPath, $filename);
			return Response::json(['success' => true,'name' => $filename, 'file' => asset($destinationPath.$filename)]);
		}

	}
}
