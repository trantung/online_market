<?php

class ApiTextController extends ApiController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id)
	{
		$input = Input::all();
		$data = Text::where('id', $id)->select(['title', 'description'])->get();
		return Common::returnData(200, SUCCESS, $input['user_id'], $input['session_id'], $data);
	}

}
