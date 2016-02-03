<?php

class ApiSettingController extends ApiController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id)
	{
		return Common::returnData(200, SUCCESS, $input['user_id'], $input['session_id'], Common::getHeader());
	}

}
