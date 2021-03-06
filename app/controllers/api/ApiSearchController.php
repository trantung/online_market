<?php

class ApiSearchController extends ApiController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id)
	{
		$input = Input::all();
		$data = CommonSearch::searchFormData($id);
		return Common::returnData(200, SUCCESS, $input['user_id'], $input['session_id'], $data);
	}

	public function action()
	{
		$input = Input::all();
		$data = CommonSearch::getSearch($input);
		return Common::returnData(200, SUCCESS, $input['user_id'], $input['session_id'], $data);
	}

	public function saved()
	{
		$input = Input::all();
		$sessionId = Common::checkSessionLogin($input);
		$inputSearch = [
				'name' => $input['name'],
				'user_id' => $input['user_id'],
				'price_id' => $input['price_id'],
				'category_id' => $input['category_id'],
				'type_id' => $input['type_id'],
				'time_id' => $input['time_id'],
				'city_id' => $input['city_id'],
				'city' 	  => Common::getModelField($input['city_id'], 'City', 'name'),
				'lat'     => $input['lat'],
				'long'    => $input['long'],
				
			];
		Search::create($inputSearch);
		return Common::returnData(200, SUCCESS, $input['user_id'], $sessionId);
	}

	public function searchLog()
	{
		$input = Input::all();
		$sessionId = Common::checkSessionLogin($input);
		$data = Search::where('user_id', $input['user_id'])->select(listFieldSearch())->get();
		foreach ($data as $key => $value) {
			$categoryName = Category::find($value->category_id)->name;
			$value->name = $value->name . '-' . $categoryName . '-' . $value->city;
		}
		return Common::returnData(200, SUCCESS, $input['user_id'], $sessionId, $data);
	}

	public function searchLogDestroy($id)
	{
		$input = Input::all();
		$sessionId = Common::checkSessionLogin($input);
		Search::find($id)->delete();
		return Common::returnData(200, DELETE_SUCCESS, $input['user_id'], $sessionId);
	}

}
