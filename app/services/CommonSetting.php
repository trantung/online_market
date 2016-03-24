<?php
class CommonSetting {

	public static function getSettingMenu()
	{
		$input = Input::all();
		if(Common::checkSessionId($input)) {
	    	$setting = self::getSettingMenu2($input);
	    } else {
	    	$setting = self::getSettingMenu1($input);
	    }
	    return $setting;
	}

	public static function getSettingMenu1($input)
	{
		$setting = array(
		  //   [
		  //   	'id' => 11,
				// 'name' => REGISTER,
				// 'link' => url('api/register'),
				// 'method' => 'GET',
				// 'quantity' => null,
				// 'image_url' => null
		  //   ],
		  //   [
		  //   	'id' => 12,
				// 'name' => LOGIN,
				// 'link' => url('api/login'),
				// 'method' => 'GET',
				// 'quantity' => null,
				// 'image_url' => null
		  //   ],
	    );
		$setting = array_merge($setting, self::getSettingMenu3());
	    return $setting;
	}

	public static function getSettingMenu2($input)
	{
		$setting = array(
			[
				'id' => 1,
				'name' => PRODUCT_LOG,
				'link' => url('api/product_log'),
				'method' => 'POST',
				'quantity' => CommonFavorite::countFavorite(array('model_name'=>'Product', 'follow_id'=>$input['user_id'])),
				'image_url' => url('images/icons/44.png')
		    ],
		    [
		    	'id' => 2,
				'name' => SEARCH_LOG,
				'link' => url('api/search_log'),
				'method' => 'POST',
				'quantity' => CommonSearch::countSearch(array('user_id'=>$input['user_id'])),
				'image_url' => url('images/icons/40.png')
		    ],
			[
				'id' => 7,
				'name' => PRODUCT_STATUS_1,
				'link' => url('api/product_status/1'),
				'method' => 'POST',
				'quantity' => CommonProduct::countProduct(array('user_id'=>$input['user_id'], 'status'=>1)),
				'image_url' => url('images/icons/47.png')
		    ],
		    [
		    	'id' => 8,
				'name' => PRODUCT_STATUS_2,
				'link' => url('api/product_status/2'),
				'method' => 'POST',
				'quantity' => CommonProduct::countProduct(array('user_id'=>$input['user_id'], 'status'=>2)),
				'image_url' => url('images/icons/46.png')
		    ],
		    [
		    	'id' => 9,
				'name' => PRODUCT_STATUS_3,
				'link' => url('api/product_status/3'),
				'method' => 'POST',
				'quantity' => CommonProduct::countProduct(array('user_id'=>$input['user_id'], 'status'=>3)),
				'image_url' => url('images/icons/48.png')
		    ],
		    [
		    	'id' => 10,
				'name' => PRODUCT_STATUS_4,
				'link' => url('api/product_hidden'),
				'method' => 'POST',
				'quantity' => CommonProduct::countProductDeleted(array('user_id'=>$input['user_id'])),
				'image_url' => url('images/icons/49.png')
		    ],
	    );
		$setting = array_merge($setting, self::getSettingMenu3());
		$setting = array_merge($setting, self::getLogoutMenu());
	    return $setting;
	}
	public static function getLogoutMenu()
	{
		return [
					// [
					// 	'id' => 13,
					// 	'name' => LOGOUT,
					// 	'link' => url('api/logout'),
					// 	'method' => 'POST',
					// 	'quantity' => null,
					// 	'image_url' => null
					// ]
				];
	}

	public static function getSettingMenu3()
	{
		$setting = array(
		    [
		    	'id' => 3,
				'name' => PROMO,
				'link' => url('api/text/1'),
				'method' => 'POST',
				'quantity' => null,
				'image_url' => url('images/icons/42.png')
		    ],
		    [
		    	'id' => 4,
				'name' => HELP,
				'link' => url('api/text/2'),
				'method' => 'POST',
				'quantity' => null,
				'image_url' => url('images/icons/41.png')
		    ],
		    [
		    	'id' => 5,
				'name' => SHAREAPP,
				'link' => null,
				'method' => null,
				'quantity' => null,
				'image_url' => url('images/icons/45.png')
		    ],
		    [
		    	'id' => 6,
				'name' => CONTACT,
				'link' => url('api/text/3'),
				'method' => 'POST',
				'quantity' => null,
				'image_url' => url('images/icons/43.png')
		    ],
		    [
		    	'id' => 14,
				'name' => SEETYPE,
				'link' => null,
				'method' => null,
				'quantity' => null,
				'image_url' => url('images/icons/50.png')
		    ],

	    );
	    return $setting;
	}

}