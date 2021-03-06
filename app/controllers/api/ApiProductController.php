<?php

class ApiProductController extends ApiController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id)
	{
		$input = Input::all();
		$product = Product::find($id);
		$data = null;
		if(isset($product)) {
			if(($input['user_id'] == $product->user_id) || ($product->status == ACTIVE)) {
				$images = ProductImage::where('product_id', $id)->get();
				foreach ($images as $key => $value) {
					$value->image_url = url(PRODUCT_UPLOAD . '/' . $product->user_id . '/' . $value->image_url);
				}
				$data = array(
					'id' => $id,
					'phone' => User::find($product->user_id)->phone,
					'name' => $product->name,
					'description' => $product->description,
					'avatar' => url(PRODUCT_UPLOAD . '/' . $product->user_id . '/' . $product->avatar),
					'category_id' => $product->category_id,
					'category_name' => Category::find($product->category_id)->name,
					'type_id' => $product->type_id,
					'type_name' => getProductType($product->type_id),
					'price' => getFullPriceInVnd($product->price) . ' đ',
					'address' => $product->address,
					'city' => $product->city,
					'city_id' => $product->city_id,
					'lat' => $product->lat,
					'long' => $product->long,
					'position' => $product->position,
					'status' => $product->status,
					'status_name' => getProductStatus($product->status),
					'start_time' => date('d-m-Y H:i', strtotime($product->start_time)),
					'user_id' => $product->user_id,
					'user_name' => User::find($product->user_id)->username,
					'user_avatar' => url(USER_AVATAR . '/' . $product->user_id . '/' . User::find($product->user_id)->avatar),
					'image_list' => $images,
					'block' => Common::checkBlackList($input['user_id'], $product->user_id),
					'favorite' => CommonFavorite::checkFavoriteLike('User', $product->user_id, TYPE_FAVORITE_LIKE, $input['user_id']),
					'product_saved' => CommonProduct::checkProductSaved($product->id, $input['user_id']),
				);
			}
		}
		return Common::returnData(200, SUCCESS, $input['user_id'], $input['session_id'], $data);
	}

	public function saved($id)
	{
		$input = Input::all();
		$sessionId = Common::checkSessionLogin($input);
		$check = CommonFavorite::checkFavoriteLike('Product', $id, TYPE_FAVORITE_SAVE, $input['user_id']);
		if(!$check) {
			Favorite::create([
							'model_name' => 'Product',
							'model_id' => $id,
							'follow_id' => $input['user_id'],
							'type_favorite' => TYPE_FAVORITE_SAVE
						]);	
		} 
		// else {
		// 	Favorite::where('model_name', 'Product')
		// 		->where('model_id', $id)
		// 		->where('follow_id', $input['user_id'])
		// 		->where('type_favorite', TYPE_FAVORITE_SAVE)
		// 		->delete();
		// }
		return Common::returnData(200, SUCCESS, $input['user_id'], $input['session_id']);
	}

	public function listStatus($status)
	{
		$input = Input::all();
		$sessionId = Common::checkSessionLogin($input);
		return CommonProduct::returnProduct(array('user_id'=>$input['user_id'], 'status'=>$status));
	}

	public function listHidden()
	{
		$input = Input::all();
		$sessionId = Common::checkSessionLogin($input);
		return CommonProduct::returnProductDeleted();
	}

	public function listProductUser($id)
	{
		$input = Input::all();

		// $sessionId = Common::checkSessionLogin($input);
		// if($sessionId) {
		// 	$block = Common::checkBlackList($input['user_id'], $id);
		// 	if($block) {
		// 		$isPhone = null;
		// 	} else {
		// 		$isPhone = 1;
		// 	}
		// } else {
		// 	$isPhone = 1;
		// }
		return CommonProduct::returnProduct(array('user_id'=>$id, 'status'=>ACTIVE));
	}

}
