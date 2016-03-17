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
		$data = User::find($input['user_id']);
		$data->avatar = url(USER_AVATAR . '/' . $input['user_id'] . '/' . $data->avatar);
		return Common::returnData(200, SUCCESS, $input['user_id'], $sessionId, $data);
	}

	public function post()
	{
		$input = Input::all();
		$sessionId = Common::checkSessionLogin($input);
		$oldPassword = Input::get('old_password');
		$updateInput = array(
							'username' => $input['username'],
							'phone' => $input['phone'],
							'email' => $input['email'],
							'avatar' => $input['avatar'],
							'address' => $input['address'],
						);
		if(!empty($input['password']) || !empty($oldPassword)) {
			if (!(Auth::user()->attempt(['id' => Input::get('user_id'), 'password' => $oldPassword]))){
				throw new Prototype\Exceptions\PasswordErrorException();
			} else {
				$updateInput['password'] = Hash::make($input['password']);
			}
		}
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
