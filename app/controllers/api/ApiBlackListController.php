<?php

class ApiBlackListController extends ApiController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$input = Input::all();
		$sessionId = Common::checkSessionLogin($input);
		$blacklist = BlackList::where('user_id', $input['user_id'])->lists('black_id');
		$data = User::whereIn('id', $blacklist)->select(['avatar', 'username', 'id'])->get();
		foreach ($data as $key => $value) {
			$value->avatar = url(USER_AVATAR . '/' . $value->id . '/' . $value->avatar);
		}
		return Common::returnData(200, SUCCESS, $input['user_id'], $sessionId, $data);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($blackId)
	{
		$input = Input::all();
		$sessionId = Common::checkSessionLogin($input);
		BlackList::where('user_id', $input['user_id'])
			->where('black_id', $blackId)
			->delete();
		return Common::returnData(200, DELETE_SUCCESS, $input['user_id'], $sessionId);
	}

}
