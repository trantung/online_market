<?php
class CommonCategory
{
	public static function categoryArray()
	{
		$category = Category::all()->toArray();
		$array = [0 => ['id' => 0, 'name' => 'Danh mục', 'created_at' => '2016-03-24 16:08:58', 'updated_at' => '2016-03-24 16:08:58']];
		foreach ($category as $key => $value) {
			$array[$key+1] = $value;
		}
		return $array;	
	}
	public static function typeArray()
	{
		$type = [
			['type_id' => 0,
			'type_name' => 'Tình trạng sản phẩm'],
			['type_id' => TYPEVALUE1,
			'type_name' => TYPE1],
			['type_id' => TYPEVALUE2,
			'type_name' => TYPE2],

		];
		return $type;
	}

	public static function timeArray()
	{
		return array(
			['time_id' => 0,
			'time_name' => '-- Chọn thời gian'],
			['time_id' => TIMEVALUE1,
			'time_name' => TIME1],
			['time_id' => TIMEVALUE2,
			'time_name' => TIME2],
			['time_id' => TIMEVALUE3,
			'time_name' => TIME3],

		);
	}

}
