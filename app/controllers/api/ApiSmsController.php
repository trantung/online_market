<?php

class ApiSmsController extends BaseController {

	public function moMessage()
	{
		$input = Input::all();
		file_put_contents(public_path().'/mo.txt', $input);
		return 0;
	}

	public function mtMessage()
	{
		$input = Input::all();
		file_put_contents(public_path().'/mt.txt', $input);
		return 0;
	}


}
