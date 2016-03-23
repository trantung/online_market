<?php

class ProductImageTableSeeder extends Seeder {

	public function run()
	{
		ProductImage::create([
			'product_id'=> '1',
			'image_url'=> 'avatar-1.jpg',
		]);
		ProductImage::create([
			'product_id'=> '1',
			'image_url'=> 'avatar-2.jpg',
		]);
		ProductImage::create([
			'product_id'=> '1',
			'image_url'=> 'avatar-3.jpg',
		]);
		ProductImage::create([
			'product_id'=> '2',
			'image_url'=> 'avatar-4.jpg',
		]);

	}

}