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
								'database'  => '".$input['database_name']."',
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
		$input = Input::all();
		$url = app_path();
		$array = ['email' => $input['email'], 'db_name' => $input['database_name']];
		// save vào main_store
		$password = Hash::make($input['password']);
		$conn = new mysqli('localhost', 'root', 'root', 'main_store');
		if ($conn->connect_error) {
		    die("Connection failed main_store " . $conn->connect_error);
		}
		$sql = "INSERT INTO users (email, username, db_name, password, phone)
			VALUES ('".$input['email']."', '".$input['username']."', '".$input['database_name']."',
			 '".$password."', '".$input['phone']."')";
		if ($conn->query($sql) === FALSE) {
		    dd(1);
		} 
		$conn->close();
		//tạo folder mới có tên = $input['database_name']
		if (!file_exists($url . $input['database_name'])) {
		    mkdir($url . '/config/' . $input['database_name'], 0777, true);
		}
		//tạo file database.php trong folder vừa tạo
		$msg = $this->getDefault($input);
		$path = $url . '/config/' . $input['database_name'] . '/database.php';
		$f = fopen($path, "a+");
		fwrite($f, $msg);
		fclose($f);
		chmod($path, 0777);
		$conn = new mysqli('localhost', 'root', 'root');
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 
		// tao database name voi ten = $input['databasename']
		$sql = "CREATE DATABASE ".$input['database_name'] . " CHARACTER SET utf8 COLLATE utf8_unicode_ci";
		if ($conn->query($sql) === TRUE) {
			$conn->query('
				CREATE TABLE `users` (
				  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
				  `email` varchar(256) DEFAULT NULL,
				  `password` varchar(256) DEFAULT NULL,
				  `phone` varchar(256) DEFAULT NULL,
				  `db_name` varchar(256) DEFAULT NULL,
				  `session_id` varchar(256) DEFAULT NULL,
				  `username` varchar(256) DEFAULT NULL,
				  `remember_token` varchar(256) DEFAULT NULL,
				  `created_at` datetime DEFAULT NULL,
				  `updated_at` datetime DEFAULT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8;
				');
		} else {
		    echo "Error creating database: " . $conn->error;
		}
		$conn->close();
		$conn = new mysqli('localhost', 'root', 'root', $input['database_name']);
		$sql = file_get_contents($url .'/main_store_2016-08-07.sql');
		//Tao default database
		$sql = explode(";", $sql);
		foreach ($sql as $key => $value) {
			if ($conn->query($value) === FALSE) {
			    dd('sai tao moi default db');
			} 
		}
		$sql = "INSERT INTO users (email, username, password, phone)
			VALUES ('".$input['email']."', '".$input['username']."',
			 '".$password."', '".$input['phone']."')";
		$conn->close();
		
		return $this->successNoData();

	}

}
