<?php

class ApiFavoriteController extends ApiController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$input = Input::all();
		$sessionId = Common::checkSessionLogin($input);
		$favorites = CommonFavorite::getFavorite([
													'model_name' => 'User',
													'follow_id' => $input['user_id'],
													'type_favorite' => TYPE_FAVORITE_LIKE
												]);
		$data = User::whereIn('id', $favorites)->select(listFieldUser())->get();
		foreach($data as $value) {
            $value->avatar = url(USER_AVATAR . '/' . $value->id . '/' . User::find($value->id)->avatar);
        }
		// $data->avatar = url(USER_AVATAR . '/' . $value . '/' . User::find($value)->avatar);
		return Common::returnData(200, SUCCESS, $input['user_id'], $sessionId, $data);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$input = Input::all();
		$sessionId = Common::checkSessionLogin($input);
		Favorite::where('model_name', 'User')
				->where('model_id', $id)
				->where('follow_id', $input['user_id'])
				->where('type_favorite', TYPE_FAVORITE_LIKE)
				->delete();
		return Common::returnData(200, DELETE_SUCCESS, $input['user_id'], $sessionId);
	}
	public function detailFavorite($userFavoriteId)
	{
		$input = Input::all();
		$sessionId = Common::checkSessionLogin($input);
		$listProducts = Product::where('user_id', $userFavoriteId)->get();
		foreach ($listProducts as $key => $value) {
			$value->avatar = url(PRODUCT_UPLOAD . '/' . $value->user_id . '/' . Product::find($value->id)->avatar);
		}
		return Common::returnData(200, SUCCESS, $input['user_id'], $sessionId, $listProducts);
	}

}
