<?php
class RelationBox
{
	public static function getNameBoxAbove($input)
	{
		$className = $input->model_name;
		$name = $className::find($input->model_id)->name;
		return $name;
	}

	public static function insertRelationship($data, $relation, $input)
	{
		if($input && $data && $relation) {
			$data->$relation()->attach($input);
		}
	}

	public static function updateRelationship($data, $relation, $input)
	{
		if($input && $data && $relation) {
			$data->$relation()->sync($input);
		}
	}

	public static function deleteRelationship($data, $relation)
	{
		if($data && $relation) {
			$data->$relation()->detach();
		}
	}

}