<?php

class ApiPostController extends ApiController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$input = Input::all();
		$sessionId = Common::checkSessionLogin($input);
		$categoryArray = CommonCategory::categoryArray();
		$typeArray = CommonCategory::typeArray();
		$cityArray = Common::listCity();
		$data = array(
				'categoryArray' => $categoryArray,
				'typeArray' => $typeArray,
				'cityArray' => $cityArray,
			);
		return Common::returnData(200, SUCCESS, $input['user_id'], $sessionId, $data);
	}

	public function post()
	{
		$input = Input::all();
		$sessionId = Common::checkSessionLogin($input);
		//check user active
		$checkUser = User::find($input['user_id'])->status;
		if(isset($checkUser) && $checkUser == INACTIVE) {
			throw new Prototype\Exceptions\UserStatusErrorException();
		}
		// create product
		$inputSubmit = [
				'name' => $input['name'],
				'user_id' => $input['user_id'],
				'category_id' => $input['category_id'],
				'type_id' => $input['type_id'],
				'price_id' => CommonProduct::getPriceId($input['price']),
				'price' => $input['price'],
				'lat' => $input['lat'],
				'long' => $input['long'],
				'description' => $input['description'],
				'avatar' => $input['avatar'],
				'address' => $input['address'],
				'city_id' => $input['city_id'],
				'city' => Common::getModelField($input['city_id'], 'City', 'name'),
				'position' => 1,
				'status' => INACTIVE,
				'start_time' => Carbon\Carbon::now(),
				
			];
		$id = Product::create($inputSubmit)->id;
		// images product
		if(isset($input['image_url']) && count($input['image_url']) > 0) {
			foreach($input['image_url'] as $key => $value) {
				$inputImage = array(
						'product_id' => $id,
						'image_url' => $value
					);
				ProductImage::create($inputImage);
			}
		}
		return Common::returnData(200, SUCCESS, $input['user_id'], $sessionId);
	}

}
