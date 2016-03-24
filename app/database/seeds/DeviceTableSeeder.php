<?php

class DeviceTableSeeder extends Seeder {

	public function run()
	{
		Device::create([
				'device_id' => 'b7fd5c4d9ad9f0bd',
				'user_id'=> '1',
				'session_id' => 'CH69bMxpjXQ8sjda'
			]);
		Device::create([
				'device_id' => '94f0be083d2a20a',
				'user_id'=> '2',
				'session_id' => 'CtoQevz1i1u1f6mH'
			]);
		Device::create([
				'device_id' => '6de5427b05b10198',
				'user_id'=> '3',
				'session_id' => 'QBAz9zXaT14Bx27I'
			]);

	}

}