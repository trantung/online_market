<?php

class ProductImageTableSeeder extends Seeder {

	public function run()
	{
		ProductImage::create([
			'product_id'=> '1',
			'image_url'=> '01.jpg',
		]);
		ProductImage::create([
			'product_id'=> '1',
			'image_url'=> '02.jpg',
		]);
		ProductImage::create([
			'product_id'=> '1',
			'image_url'=> '03.jpg',
		]);
		ProductImage::create([
			'product_id'=> '2',
			'image_url'=> '11.jpg',
		]);
		ProductImage::create([
			'product_id'=> '3',
			'image_url'=> '21.jpg',
		]);
		ProductImage::create([
			'product_id'=> '4',
			'image_url'=> '31.jpg',
		]);
		ProductImage::create([
			'product_id'=> '5',
			'image_url'=> '41.jpg',
		]);
		ProductImage::create([
			'product_id'=> '6',
			'image_url'=> '51.jpg',
		]);
		
	}

}