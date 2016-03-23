<?php
class CommonUser {

	public static function seachUser($input){
		$data = User::where(function ($query) use ($input)
		{
			if($input['username'] != '') {
				$listGame = $query->where('username', 'like', '%'.$input['username'].'%')
					->orWhere('username', 'like', '%'.$input['username'].'%');
			}
			// if($input['start_date'] != ''){
			// 	$query = $query->where('created_at', '>=', $input['start_date']);
			// }
			// if($input['end_date'] != ''){
			// 	$query = $query->where('created_at', '<=', $input['end_date'].' 23:59:59');
			// }
			// if($input['from_update_at'] != ''){
			// 	$query = $query->where('updated_at', '>=', $input['from_update_at']);
			// }
			// if($input['to_update_at'] != ''){
			// 	$query = $query->where('updated_at', '<=', $input['to_update_at']);
			// }
		})->orderBy('id', 'desc')->paginate(PAGINATE);
		return $data;
	}

	public static function getStatus($value)
	{
		if($value == ACTIVE)
			return ACTIVEUSER;
		return INACTIVEUSER;
	}
	public static function getUsername($value)
	{
		$resultUserName = User::find($value);
		if($resultUserName->facebook_id){
			$input['type_user'] = TYPEFACEBOOK;
			return  $input;
		}
		if($resultUserName->google_id){
			$input['type_user'] = TYPEGOOGLE;
			return  $input;
		}
		$input['type_user'] = TYPESYSTEM;
		return  $input;
	}
}