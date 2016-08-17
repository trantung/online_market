<?php

class RegisterController extends ApiController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Common::returnData(200, SUCCESS);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function getDefault($input)
	{
		return "<?php

					return array(

						/*
						|--------------------------------------------------------------------------
						| Database Connections
						|--------------------------------------------------------------------------
						|
						| Here are each of the database connections setup for your application.
						| Of course, examples of configuring each database platform that is
						| supported by Laravel is shown below to make development simple.
						|
						|
						| All database work in Laravel is done through the PHP PDO facilities
						| so make sure you have the driver for your particular database of
						| choice installed on your machine before you begin development.
						|
						*/

						'connections' => array(

							'mysql' => array(
								'driver'    => 'mysql',
								'host'      => 'localhost',
								'database'  => '".$input['username']."',
								'username'  => 'root',
								'password'  => 'root',
								'charset'   => 'utf8',
								'collation' => 'utf8_unicode_ci',
								'prefix'    => '',
							),

							'pgsql' => array(
								'driver'   => 'pgsql',
								'host'     => 'localhost',
								'database' => 'homestead',
								'username' => 'homestead',
								'password' => 'secret',
								'charset'  => 'utf8',
								'prefix'   => '',
								'schema'   => 'public',
							),

						),

					);
					";

	}
	public function store()
	{


		// luu vao db
		$input = Input::all();
		// dd(User::all());
		$array = ['email' => $input['email'], 'url' => $input['username']];
		// dd(User::all()->toArray());
		// User::create(array(
		// 			'email'=>'trantunghn196@gmail.com',
		// 			// 'password'=>Hash::make('123456'),
		// 			'url' => 'trantung',)
		// 	);
					
			
		// User::create($array);
		//tao folder trung ten $Input['username']
		// dd('../'.__DIR__	);
		$url = app_path();
		// dd($url);
		if (!file_exists($url . $input['username'])) {
		    mkdir($url . '/config/' . $input['username'], 0777, true);
		}
		$msg = $this->getDefault($input);
		$path = $url . '/config/' . $input['username'] . '/database.php';
		$f = fopen($path, "a+");
		fwrite($f, $msg);
		fclose($f);
		chmod($path, 0777);
		//import db
		$conn = new mysqli('localhost', 'root', 'root');
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

		// Create database
		$sql = "CREATE DATABASE ".$input['username'] . " CHARACTER SET utf8 COLLATE utf8_unicode_ci";
		if ($conn->query($sql) === TRUE) {
			$conn->query('
				CREATE TABLE `users` (
				  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
				  `email` varchar(256) DEFAULT NULL,
				  `password` varchar(256) DEFAULT NULL,
				  `url` varchar(256) DEFAULT NULL,
				  `session_id` varchar(256) DEFAULT NULL,
				  `username` varchar(256) DEFAULT NULL,
				  `remember_token` varchar(256) DEFAULT NULL,
				  `created_at` datetime DEFAULT NULL,
				  `updated_at` datetime DEFAULT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8;
				');
		    echo "Database created successfully";
		} else {
		    echo "Error creating database: " . $conn->error;
		}
		$conn->close();
		// dd(file_get_contents($url .'/main_store_2016-08-07.sql'));
		$conn = new mysqli('localhost', 'root', 'root', 'tunglaso2');
		// $conn = new PDO("mysql:host='localhost';dbname='tunglaso2'", 
	 //        'root', 'root',
	 //        array(
	 //            PDO::MYSQL_ATTR_LOCAL_INFILE => true,
	 //            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
	 //        )
	 //    );
		$sql = file_get_contents($url .'/main_store_2016-08-07.sql');
		// $sql = explode(";", $sql);
		// dd($sql);
		// $sql = 'DROP TABLE IF EXISTS users4; CREATE TABLE users4 ( id int(11) unsigned NOT NULL AUTO_INCREMENT, email varchar(256) DEFAULT NULL, password varchar(256) DEFAULT NULL, url varchar(256) DEFAULT NULL, session_id varchar(256) DEFAULT NULL, username varchar(256) DEFAULT NULL, remember_token varchar(256) DEFAULT NULL, created_at datetime DEFAULT NULL, updated_at datetime DEFAULT NULL, PRIMARY KEY (id) ) ENGINE=InnoDB DEFAULT CHARSET=utf8; DROP TABLE IF EXISTS users6; CREATE TABLE users6 ( id int(11) unsigned NOT NULL AUTO_INCREMENT, email varchar(256) DEFAULT NULL, password varchar(256) DEFAULT NULL, url varchar(256) DEFAULT NULL, session_id varchar(256) DEFAULT NULL, username varchar(256) DEFAULT NULL, remember_token varchar(256) DEFAULT NULL, created_at datetime DEFAULT NULL, updated_at datetime DEFAULT NULL, PRIMARY KEY (id) ) ENGINE=InnoDB DEFAULT CHARSET=utf8;';
		// foreach ($sql as $key => $value) {
		// 	if ($conn->query($value) === TRUE) {

		// 	    echo "Table MyGuests created successfully";
		// 	} else {
		// 	    echo "Error creating table: " . $key;
		// 	}
		// }
			if ($conn->query($sql) === TRUE) {

			    echo "Table MyGuests created successfully";
			} else {
			    echo "Error creating table: ";
			}

		$conn->close();
		// $db = DB::connection("tunglaso2");
		// dd(133);
		// dd($db);
// 		$test = $conn->query('
// CREATE TABLE `users` (
//   `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
//   `email` varchar(256) DEFAULT NULL,
//   `password` varchar(256) DEFAULT NULL,
//   `url` varchar(256) DEFAULT NULL,
//   `session_id` varchar(256) DEFAULT NULL,
//   `username` varchar(256) DEFAULT NULL,
//   `remember_token` varchar(256) DEFAULT NULL,
//   `created_at` datetime DEFAULT NULL,
//   `updated_at` datetime DEFAULT NULL,
//   PRIMARY KEY (`id`)
// ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
// ');
		// dd($test);
		// DB::unprepared(file_get_contents($url .'/main_store_2016-08-07.sql'));
		// DB::unprepared(file_get_contents($url .'/main_store_2016-08-07.sql'));
		dd(1);
		// dd(1);

		// $rules = array(
  //           'email'      => 'required|email|unique:users',
  //           'password'   => 'required',
  //       );
  //       $input = Input::all();
  //       $validator = Validator::make($input, $rules);
  //       if ($validator->fails()) {
  //           throw new Prototype\Exceptions\UserRegisterException();
  //       } else {
  //       	$input['password'] = Hash::make($input['password']);
  //       	$input['status'] = INACTIVE;
  //       	$input['type'] = 1;
		// 	$userId = User::create($input)->id;
		// 	$sessionId = Common::getSessionId($input, $userId);
		// 	return Common::returnData(200, SUCCESS, $userId, $sessionId);
  //       }
	}

}
