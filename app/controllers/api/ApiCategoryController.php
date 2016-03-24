<?php

class ApiCategoryController extends ApiController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$input = Input::all();
		return Common::returnData(200, SUCCESS, $input['user_id'], $input['session_id'], Common::getCategoryWithLike($input));
	}

	public function show($id)
	{
		return CommonProduct::returnProduct(array('category_id'=>$id, 'status'=>ACTIVE));
	}

	public function action($id)
	{
		$input = Input::all();
		$sessionId = Common::checkSessionLogin($input);
		$check = CommonFavorite::checkFavoriteLike('Category', $id, TYPE_FAVORITE_CATE, $input['user_id']);
		if($check) {
			Favorite::where('model_name', 'Category')
				->where('model_id', $id)
				->where('follow_id', $input['user_id'])
				->where('type_favorite', TYPE_FAVORITE_CATE)
				->delete();
		} else {
			Favorite::create([
						'model_name' => 'Category', 
						'model_id' => $id, 
						'follow_id' => $input['user_id'], 
						'type_favorite' => TYPE_FAVORITE_CATE
					]);
		}
		return Common::returnData(200, SUCCESS, $input['user_id'], $sessionId);
	}

}
