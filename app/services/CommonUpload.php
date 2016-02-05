<?php
class CommonUpload {

	public static function commonUploadImage($input, $id, $path, $width, $height)
	{
		$sessionId = Common::checkSessionLogin($input);
		if (isset($input['image_url'])) {
			foreach ($input['image_url'] as $key => $value) {
				$filename[$key] = $value->getClientOriginalName();
				$filename[$key] = changeFileNameImage($filename[$key]);
				$filename[$key] = $key.$filename[$key];
				$pathUpload = public_path() . $path . '/' . $id;
				$uploadSuccess = $value->move($pathUpload, $filename[$key]);
				$image = Image::make(sprintf(''.$pathUpload.'/%s', $filename[$key]))
					->resize($width, $height)->save();

			}
			$data = $filename;
			return Common::returnData(200, SUCCESS, $id, $sessionId, $data);
		}
        throw new Prototype\Exceptions\UploadErrorException();
	}

	public static function commonUploadImage($input, $path, $width, $height, $type = null)
	{
		$sessionId = Common::checkSessionLogin($input);
		if (isset($input['image_url'])) {
			foreach ($input['image_url'] as $key => $value) {
				$filename[$key] = $value->getClientOriginalName();
				$filename[$key] = changeFileNameImage($filename[$key]);
				$filename[$key] = $key.$filename[$key];
				$pathUpload = public_path() . $path . '/' . $input['user_id'];
				$uploadSuccess = $value->move($pathUpload, $filename[$key]);
				if ($key == 0) {
					$image = Image::make(sprintf(''.$pathUpload.'/%s', $filename[$key]))
						->resize(PRODUCT_AVATAR_WIDTH, PRODUCT_AVATAR_HEIGHT)->save();
				}
				else {
					$image = Image::make(sprintf(''.$pathUpload.'/%s', $filename[$key]))
						->resize($width, $height)->save();
				}

			}
			$data = $filename;
			// dd($data);
			return Common::returnData(200, SUCCESS, $input['user_id'], $sessionId, $data);
		}
        throw new Prototype\Exceptions\UploadErrorException();
	}

}