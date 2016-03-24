<?php
class CommonProduct {

	public static function countProduct($input = array())
	{
		$result = self::getProduct($input);
		return count($result);
	}

	public static function getProduct($input = array())
	{
		$result = Product::where(function ($query) use ($input){
			if (!empty($input['user_id'])) {
				$query = $query->where('user_id', $input['user_id']);
			}
			if (!empty($input['category_id'])) {
				$query = $query->where('category_id', $input['category_id']);
			}
			if (!empty($input['type_id'])) {
				$query = $query->where('type_id', $input['type_id']);
			}
			if (!empty($input['price_id'])) {
				$query = $query->where('price_id', $input['price_id']);
			}
			if (!empty($input['city_id'])) {
				$query = $query->where('city_id', $input['city_id']);
			}
			if (!empty($input['status'])) {
				$query = $query->where('status', $input['status']);
			}
			if (!empty($input['name'])) {
				$query = $query->where('name', 'like', '%'.$input['name'].'%');
			}
			if (!empty($input['time_id'])) {
				$inputDate = getTime($input['time_id']);
				$query = $query->where('start_time', '>=', $inputDate);
			}
			if (!empty($input['start_date'])) {
				$query = $query->where('start_time', '>=', $input['start_date']);
			}
			if (!empty($input['end_date'])) {
				$query = $query->where('start_time', '<=', $input['end_date']);
			}
			//lat long
			

			if (!empty($input['ids'])) {
				$query = $query->whereIn('id', $input['ids']);
			}
		})->select(listFieldProduct())->orderBy('position', 'asc')->get();
		foreach ($result as $key => $value) {
			$value->avatar = url(PRODUCT_UPLOAD . '/' . $value->user_id . '/' . Product::find($value->id)->avatar);
		}
		return $result;
	}

	public static function getProductDeleted($input = array())
	{
		$result = Product::onlyTrashed()
			->where('user_id', $input['user_id'])
			->select(listFieldProduct())->orderBy('position', 'asc')->get();
		return $result;
	}

	public static function countProductDeleted($input = array())
	{
		$result = self::getProductDeleted($input);
		return count($result);
	}

	public static function returnProduct($options = array())
	{
		$input = Input::all();
		// neu tra ve phone cua user so huu product
		if(isset($options['user_id'])) {
			$user = User::find($options['user_id']);	
		}
		if(isset($options['user_id']) && isset($options['isPhone']) && count($user) > 0) {
			$data = ['products' => CommonProduct::getProduct($options), 'phone' => $user->phone];	
		} else {
			$data = CommonProduct::getProduct($options);
		}
		return Common::returnData(200, SUCCESS, $input['user_id'], $input['session_id'], $data);
	}

	public static function returnProductDeleted()
	{
		$input = Input::all();
		$data = CommonProduct::getProductDeleted($input);
		return Common::returnData(200, SUCCESS, $input['user_id'], $input['session_id'], $data);
	}

	public static function getPriceId($price)
	{
		$price = Price::where('min', '<=', $price)
					->where('max', '>=', $price)
					->first();
		$priceLastMin = Price::whereNull('max')->first();
		if(isset($price)) {
			return $price->id;
		}
		if($price > $priceLastMin) {
			return $priceLastMin->id;
		}
		return 1;
	}

}
