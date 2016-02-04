<?php

class ApiProfileController extends ApiController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$input = Input::all();
		$sessionId = Common::checkSessionLogin($input);
		$data = User::where('id', $input['user_id'])->select(listFieldUser())->get();
		return Common::returnData(200, SUCCESS, $input['user_id'], $sessionId, $data);
	}

	public function post()
	{
		$input = Input::all();
		$sessionId = Common::checkSessionLogin($input);
		$updateInput = array(
							'username' => $input['username'],
							'phone' => $input['phone'],
							'email' => $input['email'],
							'avatar' => $input['avatar'],
							'address' => $input['address'],
							'password' => Hash::make($input['password'])
						);
		User::find($input['user_id'])->update($updateInput);
		return Common::returnData(200, SUCCESS, $input['user_id'], $sessionId);
	}

	public function account($id)
	{
		return CommonProduct::returnProduct(array('user_id'=>$id, 'status'=>1));
	}

	public function block($id)
	{
		$input = Input::all();
		$sessionId = Common::checkSessionLogin($input);
		$checkInput = BlackList::where('user_id', $input['user_id'])
								->where('black_id', $id)
								->get();
		if(!empty($checkInput)) {
			BlackList::create(['user_id' => $input['user_id'], 'black_id' => $id, 'kind' => 1]);
		}
		return Common::returnData(200, SUCCESS, $input['user_id'], $sessionId);
	}

}
