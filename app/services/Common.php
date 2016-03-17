<?php
class Common {

	public static function returnData($code = 200, $message = SUCCESS, $userId = '', $sessionId = '', $data = null)
	{
		return Response::json([
				'code' => $code,
				'message' => $message,
				'user_id' => $userId,
				'session_id' => $sessionId,
				'data' => $data,
			]);
	}

	public static function getSessionId($input, $userId)
	{
		$device = Device::where('device_id', $input['device_id'])
						->where('user_id', $userId)
						->first();
		if($device) {
			if(empty($input['session_id'])) {
				$sessionId = $device->session_id;
				if(!($sessionId)) {
					$sessionId = generateRandomString();
					Device::find($device->id)->update(['session_id' => $sessionId]);
				}
			}
			else {
				if($device->session_id == $input['session_id']) {
					$sessionId = $input['session_id'];
				} else {
					throw new Prototype\Exceptions\UserSessionErrorException();
				}
			}
		} else {
			$sessionId = generateRandomString();
			Device::create(['device_id'=>$input['device_id'], 'user_id'=>$userId, 'session_id'=>$sessionId]);
		}
		return $sessionId;
	}

	public static function getListArray($modelName, $selectField, $position = null)
	{
		if($position) {
			$obj = $modelName::select($selectField)->orderBy('position', 'asc')->get();
		} else {
			$obj = $modelName::all($selectField);
		}
		$data = array();
		foreach ($obj as $key => $value) {
			$data[$key] = $value->toArray();
		}
		return $data;
	}

	public static function getHeader()
	{
		$category = Common::getListArray('Category', ['id', 'name']);
		$setting = CommonSetting::getSettingMenu();
		$header = ['category' => $category, 'setting' => $setting];
		return $header;
	}
	public static function checkSessionId($input)
	{
		$device = Device::where('device_id', $input['device_id'])
						->where('session_id', $input['session_id'])
						->where('user_id', $input['user_id'])
						->first();
		if(!empty($device)) {
			return $input['session_id'];
		}
		return false;
	}

	public static function getCategory()
	{
		$data = Common::getListArray('Category', ['id', 'name']);
		$data = array_merge(['0'=>array('id'=>0, 'name'=>'Home')], $data);
		return $data;
	}

	public static function checkSessionLogin($input)
	{
		$sessionId = Common::checkSessionId($input);
		if (!$sessionId) {
			throw new Prototype\Exceptions\UserSessionErrorException();
		}
		return $sessionId;
	}
	public static function queryCommonMessage($input, $value)
	{
		$data = ApiMessage::where(function($query) use ($input, $value) {
			$query->where('sent_id', $input['user_id'])
				  ->where('receiver_id', $value);
		})
		->orWhere(function($query) use ($input, $value) {
            $query->where('receiver_id', $input['user_id'])
				 ->where('sent_id', $value);
        });
        return $data;
	}
	public static function removeDefaultMessage($data)
	{
		unset($data['sent_id']);
		unset($data['receiver_id']);
		unset($data['deleted_at']);
		unset($data['updated_at']);
		unset($data['status']);
		return $data;
	}
}
