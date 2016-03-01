<?php

class ApiReportController extends ApiController {

	/**
	 *
	 * Param: productId
	 *
	 * @return Response
	 */
	public function post($id)
	{
		$input = Input::all();
		$sessionId = Common::checkSessionLogin($input);
		$inputFeedback = [
				'product_id' => $id,
				'user_id' => $input['user_id'],
				'message' => $input['message'],
				'status' => ACTIVE
			];
		FeedBack::create($inputFeedback)->id;
		return Common::returnData(200, SUCCESS, $input['user_id'], $sessionId);
	}

}
