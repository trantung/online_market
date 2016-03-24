<?php

class CategoryTableSeeder extends Seeder {

	public function run()
	{
		Category::create([
			'name'=> 'Đồ công, nông nghiệp',
		]);
		Category::create([
			'name'=> 'Giải trí, thể thao, sở thích',
		]);
		Category::create([
			'name'=> 'Xe cộ',
		]);
		Category::create([
			'name'=> 'Bất động sản',
		]);
		Category::create([
			'name'=> 'Đồ điện tử',
		]);
		Category::create([
			'name'=> 'Thời trang',
		]);
		Category::create([
			'name'=> 'Nội thất',
		]);
		Category::create([
			'name'=> 'Đồ gia dụng',
		]);
		
	}

}