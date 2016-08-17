<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}
	public function checkUserLoginServe($input)
	{
		//email, pass
		// dd(444);
		// $this->query = DB::connection('main_store');
		// $pdo = DB::connection('main_store')->getPdo();
		$conn = new mysqli('localhost', 'root', 'root', 'main_store');
		// Check connection
		// dd(555);
		if ($conn->connect_error) {
		    dd(5666);
		}
		
		$email = $input['email'];
		$password = $input['password'];
		$sql = "SELECT id, url, session_id FROM users WHERE email = '$email' and password ='$password' ";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			// dd($row['url']);
			//
			$conn->close();
			// dd(11);
			return $row['url'];
			// dd($result->fetch_assoc());
		}
		$conn->close();
		// // dd(123);
		// throw new Prototype\Exceptions\UserLoginException();
		// if (Auth::user()->attempt(Input::only('email', 'password'))){
  //           $userId = Auth::user()->get()->id;
  //           $sessionId = Common::getSessionId(Input::all(), $userId);
  //           //check database
  //           return Common::returnData(200, SUCCESS, $userId, $sessionId);
  //       }
	}
}
