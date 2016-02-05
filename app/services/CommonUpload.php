<?php
class CommonUpload {

	// type=1:upload avatar product
	// type=2:upload avatar user
	public static function commonUploadImage($input, $path, $type = null)
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
					if($type == 1) {
						$image = Image::make(sprintf(''.$pathUpload.'/%s', $filename[$key]))
							->resize(PRODUCT_AVATAR_WIDTH, PRODUCT_AVATAR_HEIGHT)->save();
 					} else {
 						$image = Image::make(sprintf(''.$pathUpload.'/%s', $filename[$key]))
							->resize(USER_AVATAR_WIDTH, USER_AVATAR_HEIGHT)->save();
 					}
				}
				else {
					$image = Image::make(sprintf(''.$pathUpload.'/%s', $filename[$key]))
						->resize(PRODUCT_SLIDE_WIDTH, PRODUCT_SLIDE_HEIGHT)->save();
				}

			}
			$data = $filename;
			return Common::returnData(200, SUCCESS, $input['user_id'], $sessionId, $data);
		}
        throw new Prototype\Exceptions\UploadErrorException();
	}

}