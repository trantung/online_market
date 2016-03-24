<?php

class ProductTableSeeder extends Seeder {

	public function run()
	{
		Product::create([
			'user_id'=> '1',
			'category_id'=> '3',
			'type_id' => '1',
			'price_id' => '3',
			'price' => '30000000',
			'name' => 'Xe máy Yamaha Exciter',
			'description' => 'Xe máy Yamaha Exciter',
			'avatar' => '01.jpg',
			'city_id' => '1',
			'lat' => '21.00296184',
			'long' => '105.85202157',
			'position' => '1',
			'status' => '1',
		]);
		Product::create([
			'user_id'=> '1',
			'category_id'=> '5',
			'type_id' => '1',
			'price_id' => '2',
			'price' => '4500000',
			'name' => 'Máy ảnh Canon 600D',
			'description' => 'Máy ảnh Canon 600D',
			'avatar' => '11.jpg',
			'city_id' => '1',
			'lat' => '21.00296184',
			'long' => '105.85202157',
			'position' => '1',
			'status' => '1',
		]);
		Product::create([
			'user_id'=> '1',
			'category_id'=> '5',
			'type_id' => '1',
			'price_id' => '2',
			'price' => '7500000',
			'name' => 'Máy ảnh Canon EOS 5D',
			'description' => 'Máy ảnh Canon EOS 5D',
			'avatar' => '21.jpg',
			'city_id' => '1',
			'lat' => '21.00296184',
			'long' => '105.85202157',
			'position' => '1',
			'status' => '1',
		]);
		Product::create([
			'user_id'=> '1',
			'category_id'=> '3',
			'type_id' => '1',
			'price_id' => '4',
			'price' => '800000000',
			'name' => 'Ô tô Chevrolet',
			'description' => 'Ô tô Chevrolet',
			'avatar' => '31.jpg',
			'city_id' => '1',
			'lat' => '21.00296184',
			'long' => '105.85202157',
			'position' => '1',
			'status' => '1',
		]);
		Product::create([
			'user_id'=> '2',
			'category_id'=> '7',
			'type_id' => '1',
			'price_id' => '2',
			'price' => '1200000',
			'name' => 'Ghế FINE NDTO-CH152ASLP',
			'description' => 'Ghế FINE NDTO-CH152ASLP',
			'avatar' => '41.jpg',
			'city_id' => '1',
			'lat' => '21.00296184',
			'long' => '105.85202157',
			'position' => '1',
			'status' => '1',
		]);
		Product::create([
			'user_id'=> '2',
			'category_id'=> '8',
			'type_id' => '1',
			'price_id' => '1',
			'price' => '350000',
			'name' => 'Bếp Gas CanZy CZ-370',
			'description' => 'Bếp Gas CanZy CZ-370',
			'avatar' => '51.jpg',
			'city_id' => '1',
			'lat' => '21.00296184',
			'long' => '105.85202157',
			'position' => '1',
			'status' => '1',
		]);
		
	}

}