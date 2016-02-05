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
		return CommonUpload::commonUploadImage($input, USER_AVATAR, 2);
	}

	public function imageProduct()
	{
		$input = Input::all();
		return CommonUpload::commonUploadImage($input, PRODUCT_UPLOAD, 1);
	}

}
