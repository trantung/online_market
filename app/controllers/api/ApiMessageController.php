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
		$data_sent = ApiMessage::where('sent_id', $input['user_id'])
			->groupBy('receiver_id')
			->lists('receiver_id');
		$data_recived = ApiMessage::where('receiver_id', $input['user_id'])
			->groupBy('sent_id')
			->lists('sent_id');
		$total = array_diff($data_recived, $data_sent);
		$result = array_merge($total, $data_sent);
		foreach($result as $key => $value) {
			$msg =  ApiMessage::where(function($query) use ($input, $value) {
					$query->where('sent_id', $input['user_id'])
						  ->where('receiver_id', $value);
				})
				->orWhere(function($query) use ($input, $value) {
	                $query->where('receiver_id', $input['user_id'])
						 ->where('sent_id', $value);
	            })
	            ->orderBy('created_at', 'desc')
				->first();
			if($msg) {
				$data[] = array(
						'id' => $msg->id,
						'chat_id' => $value,
						'message' => $msg->message,
						'time' => date('Y-m-d', strtotime($msg->created_at)),
					);
			}
		}
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

	public function active($id)
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
