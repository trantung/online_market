<?php
class CommonFavorite {

	public static function countFavorite($input = array())
	{
		$result = DB::table('favorites')
						->join('products', 'favorites.model_id', '=', 'products.id')
						->select('favorites.*')
						->where('favorites.follow_id', $input['follow_id'])
						->where('favorites.model_name', $input['model_name'])
						->where('favorites.type_favorite', $input['type_favorite'])
						->where('products.status', ACTIVE)
						->whereNull('products.deleted_at')
						->get();
		// $result = self::getFavorite($input);
		return count($result);
	}

	public static function getFavorite($input = array())
	{
		// $result = Favorite::where(function ($query) use ($input){
		// 	$query = $query->where('model_name', $input['model_name']);
		// 	$query = $query->where('follow_id', $input['follow_id']);
		// 	if (!empty($input['user_id'])) {
		// 		$query = $query->where('user_id', $input['user_id']);
		// 	}
		// })->lists('model_id');
		$result = Favorite::where('follow_id', $input['follow_id'])
			->where('model_name', $input['model_name'])
			->where('type_favorite', $input['type_favorite'])
			->distinct()
			->lists('model_id');
		return $result;
	}

	public static function checkFavoriteLike($modelName, $modelId, $type, $followId)
	{
		$check = Favorite::where('model_name', $modelName)
						->where('model_id', $modelId)
						->where('type_favorite', $type)
						->where('follow_id', $followId)
						->first();
		if(isset($check)) {
			return true;
		}
		return false;
	}

}
