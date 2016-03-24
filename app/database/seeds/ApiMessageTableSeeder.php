<?php

class ApiMessageTableSeeder extends Seeder {

	public function run()
	{
		ApiMessage::create([
			'sent_id'=> '1',
			'receiver_id'=> '2',
			'message' => 'message test 1',
			'status' => '1'
		]);
		ApiMessage::create([
			'sent_id'=> '1',
			'receiver_id'=> '2',
			'message' => 'message test 2',
			'status' => '1'
		]);
		ApiMessage::create([
			'sent_id'=> '2',
			'receiver_id'=> '1',
			'message' => 'message test 3',
			'status' => '1'
		]);
		ApiMessage::create([
			'sent_id'=> '2',
			'receiver_id'=> '1',
			'message' => 'message test 4',
			'status' => '1'
		]);
		ApiMessage::create([
			'sent_id'=> '2',
			'receiver_id'=> '1',
			'message' => 'message test 5',
			'status' => '1'
		]);
		ApiMessage::create([
			'sent_id'=> '1',
			'receiver_id'=> '3',
			'message' => 'message test 6',
			'status' => '1'
		]);
		
	}

}