<?php

class ApiVerifyAccountController extends ApiController {

	public function index()
	{
		$input = Input::all();
		$sessionId = Common::checkSessionLogin($input);
		$user = User::find($input['user_id']);
		//tao code phone
		$codePhone = generateRandomString(CODEPHONE);
		//luu code phone -> db
		$user->update(['code_phone' => $codePhone]);
		//gui code cho dau so

		//active user
		$user->update(['status' => ACTIVE]);
		return Common::returnData(200, SUCCESS, $input['user_id'], $sessionId);

	}

	public function check()
	{
		//
	}

}
