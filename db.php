<?php
	//Соединение с базой данных
	$host = '127.0.0.1';
	$db = 'todo';
	$charset = 'utf8';
	$userDB = 'todo';
	$pass = '';
	
	$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
	
	$opt = array(
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
	);?>