<?php

class ApiUploadController extends ApiController {

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		//check session
		$sessionId = Common::checkSessionLogin($input);
		//upload
		if (isset($input['image_url'])) {
			//check format image and size image: client
			foreach ($input['image_url'] as $key => $value) {
				$filename = $value->getClientOriginalName();
				print_r($filename.'/');
			}

		// $file = Input::file($fileUpload);
		// $filename = $file->getClientOriginalName();
		// $extension = $file->getClientOriginalExtension();
		// if(isset($isUnique)) {
		// 	$filename = changeFileNameImage($filename);
		// }
		// if($isFile != '') {
		// 	$pathUpload = self::getPathFile($extension);
		// } else {
		// 	$pathUpload = public_path().UPLOAD_GAME_AVATAR;
		// }
		// $uploadSuccess = $file->move($pathUpload, $filename);

		dd(111);
		}
	}
}
