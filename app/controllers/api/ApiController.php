<?php 
class ApiController extends BaseController {

    public function __construct() {
    	// $this->beforeFilter('@checkSessionId', array('except'=>array('postLogin','getLogin')));
    }

    public function checkLogin($input)
    {
        //check user with db origin
        //db origin: store_managers
        // $row =  $this->checkUserLoginServe($input);
        // dd($row);
        // $check =  true;
        // if ($row) {
            // dd(55);
            // $user = User::all()->toArray();
            // dd($user);
           if (Auth::user()->attempt(Input::only('email', 'password'))){
            // dd(111);
                $userId = Auth::user()->get()->id;
                // dd($userId);
                // $sessionId = Common::getSessionId(Input::all(), $userId);
                // dd($row);
                //check database
                return Common::returnData(200, SUCCESS, $row, 12334454);
            }
            throw new Prototype\Exceptions\UserLoginException();
        // }
        //if true-> go to database client->check auth
        // if (Auth::user()->attempt(Input::only('email', 'password'))){
        //     $userId = Auth::user()->get()->id;
        //     $sessionId = Common::getSessionId(Input::all(), $userId);
        //     //check database
        //     return Common::returnData(200, SUCCESS, $userId, $sessionId);
        // }
        // throw new Prototype\Exceptions\UserLoginException();
    }


}
