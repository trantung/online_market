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
		return CommonUpload::commonUploadImage($input, USER_AVATAR, USER_AVATAR_WIDTH, USER_AVATAR_HEIGHT);

	}
	public function imageProduct()
	{
		$input = Input::all();
		return CommonUpload::commonUploadImage($input, PRODUCT_UPLOAD, PRODUCT_SLIDE_WIDTH, PRODUCT_SLIDE_HEIGHT);

	}

}
