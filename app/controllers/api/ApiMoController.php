<?php 

class ApiMoController extends BaseController {

	//mo theo kieu post return ra int
	 public function moMessageInt()
	{
		$input = Input::all();
		$username = $input['Username'];
		file_put_contents(public_path().'/mo.txt', $username );
	 	return 1;
	}
	//mo theo kieu post return ra json
	public function moMessageJson()
	{
		$input = Input::all();
		$username = $input['Username'];
		file_put_contents(public_path().'/mo.txt', $username );
		return Response::json([
				'statuss' => 1,
				'message' => 'success'
			]);
	}

	//mo theo kieu post return ra json
	public function moMessageJsonAndMT()
	{
		$input = Input::all();
		$username = $input['Username'];
		file_put_contents(public_path().'/mo.txt', $username );
		return Response::json([
				'error_code' => 1,
				'message' => 'success',
				'Username' => 'abc',
				'Password' => '123456',
				'Sender' => '01658002108',
				'Receiver' => '0988758523',
				'ChargedFlag' => '1',
				'ServiceNumber' => '8709',
				'MessageType' => '1',
				'MessageID' => '1',
				'TextContent' => 'this is message',
				'BinaryContent' => 'abc'
			]);
	}
	
	public function mtMessage()
	 {
		$input = Input::all();
		file_put_contents(public_path().'/mt.txt', $input);
		return 0;
	 }
}
