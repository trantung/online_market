<?php 
class ApiController extends BaseController {

	public function __construct() {
		// $this->beforeFilter('@checkSessionId', array('except'=>array('postLogin','getLogin')));
	}
	public function checkDbName()
	{
		$input = Input::all();
		$check = User::where('db_name', $input['db_name'])->first();
		if (!$check) {
			throw new Prototype\Exceptions\DbNameErrorException();
		}
		return $this->successNoData();
	}
	public function checkLogin($input)
	{
	   if (Auth::user()->attempt(Input::only('email', 'password'))){
			$userId = Auth::user()->get()->id;
			if ($userId) {
				//chua co session_id-->tao moi session_id trong bang users cua table: $input['database_name']
				$conn = new mysqli('localhost', 'root', 'root', $input['database_name']);
				//TODO
				$conn->close();
				return $this->successNoData();
			}
		}
		throw new Prototype\Exceptions\UserLoginException();
	}

}
