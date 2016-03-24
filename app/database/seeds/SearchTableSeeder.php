<?php

class SearchTableSeeder extends Seeder {

	public function run()
	{
		Search::create([
			'name' => 'Xe máy Yamaha',
			'user_id' => '1',
			'price_id' => '3',
			'category_id' => '3',
			'type_id' => '1',
			'time_id' => '1',
			'lat' => '21.00296184',
			'long' => '105.85202157',
		]);
		Search::create([
			'name' => 'Máy ảnh',
			'user_id' => '1',
			'price_id' => '2',
			'category_id' => '5',
			'type_id' => '1',
			'time_id' => '1',
			'lat' => '21.00296184',
			'long' => '105.85202157',
		]);
		
	}

}