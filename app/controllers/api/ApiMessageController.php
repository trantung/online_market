<?php

class ApiMessageController extends ApiController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$input = Input::all();
		$sessionId = Common::checkSessionLogin($input);
		$data_sent = ApiMessage::join('users', 'messages.receiver_id', '=', 'users.id')
					->select('messages.id', 'messages.receiver_id', 'messages.message', 'messages.status', 'messages.created_at', 'users.username', 'users.avatar')
					->where('messages.sent_id', $input['user_id'])
					// ->where('messages.status', ACTIVE)
					->orderBy('messages.id', 'desc')
					->get();
		$data_recived = ApiMessage::join('users', 'messages.sent_id', '=', 'users.id')
					->select('messages.id', 'messages.sent_id', 'messages.message', 'messages.status', 'messages.created_at', 'users.username', 'users.avatar')
					->where('messages.receiver_id', $input['user_id'])
					// ->where('messages.status', ACTIVE)
					->orderBy('messages.id', 'desc')
					->get();
		$data = ['data_sent' => $data_sent, 'data_recived' => $data_recived];
		return Common::returnData(200, SUCCESS, $input['user_id'], $sessionId, $data);
	}

	public function show($id)
	{
		$input = Input::all();
		$sessionId = Common::checkSessionLogin($input);
		$msg = ApiMessage::find($id);
		if($msg->sent_id == $input['user_id'] || $msg->receiver_id == $input['user_id']) {
			$data = $msg;
		} else {
			$data = null;
		}
		return Common::returnData(200, SUCCESS, $input['user_id'], $sessionId, $data);
	}

	public function destroy($id)
	{
		$input = Input::all();
		$sessionId = Common::checkSessionLogin($input);
		ApiMessage::find($id)->delete();
		return Common::returnData(200, DELETE_SUCCESS, $input['user_id'], $sessionId);
	}

	//param productId
	public function send($id)
	{
		$input = Input::all();
		$sessionId = Common::checkSessionLogin($input);
		$inputMsg = [
				'sent_id' => $input['user_id'],
				'receiver_id' => Product::find($id)->user_id,
				'message' => $input['message'],
				'status' => INACTIVE
			];
		ApiMessage::create($inputMsg);
		return Common::returnData(200, SUCCESS, $input['user_id'], $sessionId);
	}

	public function updateStatusMessage($id)
	{
		$input = Input::all();
		$sessionId = Common::checkSessionLogin($input);
		$inputMsg = [
				'status' => ACTIVE
			];
		ApiMessage::find($id)->update($inputMsg);
		return Common::returnData(200, SUCCESS, $input['user_id'], $sessionId);
	}

}
