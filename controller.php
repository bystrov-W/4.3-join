<?php
	
	$pdo = new PDO($dsn, $userDB, $pass, $opt);
	
	//добавление и изменение задачи
	if (isset($_POST['add'])) {
		if (isset ($_POST['idForChanging']) && !empty ($_POST['idForChanging'])) {
			changeTaskDescription ($pdo, $_POST['description'], $_POST['idForChanging']);
		} else {
			addTask ($pdo, $_POST['description'], $_SESSION['userId']);
		}
	}	
	
	//Операции с задачей
	if (isset($_GET['action'])) {
		$id = isset($_GET['id']) ? $_GET['id'] : '';
		if ($_GET['action'] == 'done') {
			done($pdo, $id);
		} elseif ($_GET['action'] == 'delete') {
			delete($pdo, $id);
		} elseif ($_GET['action'] == 'change') {
			change($pdo, $id);
			$idForChanging = isset($_GET['id']) ? $_GET['id'] : '';
		} 
	}
	
	//Назначение ответственного
	if (isset($_POST['assignUser'])) {
		assignUser($pdo, $_POST['assignUser'],$_POST['idForChanging']);
	}
	
	//список задач
	if (isset($_POST['sortOption'])) {
		if ($_POST['sortOption'] == '1') {
			$sortStyle = 'description';
		} else if ($_POST['sortOption'] == '2') {
			$sortStyle = 'is_done';
		} else if ($_POST['sortOption'] == '3') {
			$sortStyle = 'date_added';
		}
	}
	$listOfTasks = listOfTasksWithSort ($pdo, $_SESSION['userId'],$sortStyle);
	$listOfTasksForUser = listOfTasksWithSortForUser ($pdo, $_SESSION['userId'],$sortStyle);
		
	//список пользователей
	$listOfUsers = allMembers($pdo);
	
	//Регистрация
	if (isset($_POST['registration']) && empty($_SESSION['user'])) {
		$message = register ($pdo, $_POST['login'],$_POST['password']);
	} elseif (!empty($_SESSION['user'])) {
		$message = 'Вы авторизованы';
	}
	
	//Авторизация
	if (isset($_POST['authorization']) && empty($_SESSION['user'])) {
		$message = login ($pdo, $_POST['login'],$_POST['password']);
	} elseif (!empty($_SESSION['user'])) {
		$message = 'Вы авторизованы';
	}
	
	//Выход/смена пользователя
	if (isset($_GET['exit'])) {
		logout ($pdo);
	}
	
	//Редиректы
	//если не авторизован
	if (empty($_SESSION['user']) && $_SERVER['REQUEST_URI'] == '/4.3/index.php' OR empty($_SESSION['user']) && $_SERVER['REQUEST_URI'] == '/4.3/') {
		$message = 'Необходима авторизация';
		header( 'Location: login.php' );
	}
	//если авторизован
		if (!empty($_SESSION['user']) && $_SERVER['REQUEST_URI'] == '/4.3/login.php') {
		header( 'Location: index.php' );
	}