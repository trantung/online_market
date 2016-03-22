<?php
class CommonSearch {

	public static function countSearch($input = array())
	{
		$result = self::getSearch($input);
		return count($result);
	}

	public static function getSearch($input = array())
	{
		$result = Search::where(function ($query) use ($input){
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
			if (!empty($input['time_id'])) {
				$query = $query->where('time_id', $input['time_id']);
			}
			if (!empty($input['name'])) {
				$query = $query->where('name', 'like', '%'.$input['name'].'%');
			}
			//lat long

		})->select(listFieldSearch())->get();
		return $result;
	}

	//id = 0: click nut search tren top
	//id > 0: click trong danh sach search da luu, id = search_id
	public static function searchFormData($searchId = 0)
	{
		$priceArray = self::priceFormArray();
		$categoryArray = self::categoryFormArray();
		$typeArray = selectProductType();
		$timeArray = selectProductTime();
		$id = null;
		$name = null;
		$lat = null;
		$long = null;
		$price_id = null;
		$category_id = null;
		$type_id = null;
		$time_id = null;
		if($searchId > 0) {
			$search = Search::find($searchId);
			if(count($search) > 0) {
				$id = $searchId;
				$name = $search->name;
				$lat = $search->lat;
				$long = $search->long;
				$price_id = $search->price_id;
				$category_id = $search->category_id;
				$type_id = $search->type_id;
				$time_id = $search->time_id;
			}
		}
		$data = array(
				'id' => $id,
				'name' => $name,
				'lat' => $lat,
				'long' => $long,
				'price_id' => $price_id,
				'category_id' => $category_id,
				'type_id' => $type_id,
				'time_id' => $time_id,
				'priceArray' => $priceArray,
				'categoryArray' => $categoryArray,
				'typeArray' => $typeArray,
				'timeArray' => $timeArray,
			);
		return $data;
	}

	public static function priceFormArray()
	{
		$obj = Price::all();
		$array[''] = '- Không chọn';
		if(count($obj) > 0) {
			foreach($obj as $value) {
				$array[$value->id] = priceArrangeString($value->min, $value->max);
			}
		}
		return $array;
	}

	public static function categoryFormArray()
	{
		$obj = Category::all();
		$array[''] = '- Danh mục';
		if(count($obj) > 0) {
			foreach($obj as $value) {
				$array[$value->id] = $value->name;
			}
		}
		return $array;
	}

	public static function searchFilter($input)
	{
		//
	}

	public static function searchDistance($lat, $long, $distance)
	{
		$sql = "SELECT id, ( 3959 * acos( cos( radians(".$lat.") ) * cos( radians( lat ) ) * cos( radians( long ) - radians(-".$long.") ) + sin( radians(".$lat.") ) * sin( radians( lat ) ) ) ) AS distance FROM markers HAVING distance < ".$distance." ORDER BY distance LIMIT 0 , 20;";
		return $sql;
	}

}