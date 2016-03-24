<?php

class FeedbackTableSeeder extends Seeder {

	public function run()
	{
		Feedback::create([
			'product_id'=> '1',
			'user_id'=> '2',
			'message' => 'message test 1',
			'status' => '1'
		]);
		Feedback::create([
			'product_id'=> '1',
			'user_id'=> '3',
			'message' => 'message test 2',
			'status' => '1'
		]);
		Feedback::create([
			'product_id'=> '2',
			'user_id'=> '2',
			'message' => 'message test 3',
			'status' => '1'
		]);
		Feedback::create([
			'product_id'=> '2',
			'user_id'=> '3',
			'message' => 'message test 4',
			'status' => '1'
		]);
		Feedback::create([
			'product_id'=> '3',
			'user_id'=> '2',
			'message' => 'message test 5',
			'status' => '1'
		]);
		Feedback::create([
			'product_id'=> '1',
			'user_id'=> '3',
			'message' => 'message test 6',
			'status' => '1'
		]);
		
	}

}