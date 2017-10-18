<?php
session_start();
class Base 
{
	public $dlink;
	public $ERROR;//Ошибки в БД
	function __construct()
	{
		// Old connection to database
		$user='root';
		$host='127.0.0.1';
		$pas='';
		$name_db = "Econom";
        $this->dlink = mysqli_connect($host, $user, $pas, $name_db);

        if (!$this->dlink) {
            echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
            echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }

	   // mysqli_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
	}


    function __destruct ()
	{
        mysqli_close($this->dlink);
	}
	
	function view_eror()
	{
	echo ($this->ERROR);
	}
}
?>