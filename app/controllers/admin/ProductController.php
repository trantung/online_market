<?php

class ProductController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = Product::whereIn('status', [ACTIVE, INACTIVE])
					->orderBy('id', 'desc')->paginate(PAGINATE);
		return View::make('admin.product.index')->with(compact('data'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data = Product::find($id);
		return View::make('admin.product.edit')->with(compact('data'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = array(
			'name'   => 'required',
			'description'   => 'required',
			'price'   => 'required|integer|min:1000',
			'category_id'   => 'required',
			'type_id'   => 'required',
			'address'   => 'required',
		);
		$input = Input::except('_token');
		$validator = Validator::make($input, $rules);
		if($validator->fails()) {
			return Redirect::action('ProductController@edit', $id)
	            ->withErrors($validator);
        } else {
        	$input['price_id'] = CommonProduct::getPriceId($input['price']);
			CommonNormal::update($id, $input);
			return Redirect::action('ProductController@index')->with('message', 'Đã sửa');
    	}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		CommonNormal::delete($id);
        return Redirect::action('ProductController@index')->with('message', 'Đã xóa');
	}

	public function check($id)
	{
		$status = Product::find($id)->status;
		if($status == ACTIVE) {
			$input = ['status' => INACTIVE, 'start_time' => Carbon\Carbon::now()];
		} else {
			$input = ['status' => ACTIVE, 'start_time' => Carbon\Carbon::now()];
		}
		CommonNormal::update($id, $input);
		return Redirect::action('ProductController@index');
	}

	public function refuse($id)
	{
		CommonNormal::update($id, ['status' => REFUSE, 'start_time' => Carbon\Carbon::now()]);
		return Redirect::action('ProductController@index');
	}

}
