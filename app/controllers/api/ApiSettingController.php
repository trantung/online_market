<?php

class ApiSettingController extends ApiController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$input = Input::all();
		return Common::returnData(200, SUCCESS, $input['user_id'], $input['session_id'], CommonSetting::getSettingMenu());
	}

}
