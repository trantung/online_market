<?php

class ApiCategoryController extends ApiController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$input = Input::all();
		return Common::returnData(200, SUCCESS, $input['user_id'], $input['session_id'], Common::getCategory());
	}

	public function show($id)
	{
		return CommonProduct::returnProduct(array('category_id'=>$id, 'status'=>1));
	}

}
