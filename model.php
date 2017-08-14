<?php

	header('Content-Type: text/html; charset=utf-8');
	//register
	function register ($pdo, $user, $password) {
		
		if (empty($user)) {
			return 'Введите логин';
		}
		
		else if (empty($password)) {
			return 'Введите пароль';
		}
		
		else {
		
			$action = $pdo->query("SELECT login FROM user WHERE login = '$user'");
		
			$row = $action->fetch();
		
			if ($row == true) {
				return 'Логин занят';
			}
			
			else {
				$add = $pdo->prepare('INSERT INTO user (login, password) VALUES (?, ?)');
				$add->bindParam(1, $user, PDO::PARAM_STR);
				$add->bindParam(2, $password, PDO::PARAM_STR);
				$add->execute();
				return 'Вы успешно зарегистрированы. Теперь авторизируйтесь со своими данными.';
			}
		}
	}
	
	//авторизация
	function login ($pdo, $user, $password) {
		
		if (empty($user)) {
			return 'Введите логин';
		}
		
		else if (empty($password)) {
			return 'Введите пароль';
		}
		
		else {
		
			$action = $pdo->query("SELECT id, login, password FROM user WHERE login = '$user'");
		
			$row = $action->fetch();
			
			if ($row['login'] == $user && $row['password'] == $password) {
				$_SESSION ['user'] = $row['login'];
				$_SESSION ['userId'] = $row['id'];
				return 'Вы авторизованы';
			} else {
				return 'Данные не совпадают';
			}
		}
	}
	
	//Выход/смена пользователя
	function logout ($pdo) {
		
		unset ($_SESSION['user']);
		unset ($_SESSION['userId']);
		header( 'Location: login.php' ); 
	}
	
	//Список задач с сортировкой
	function listOfTasksWithSort ($pdo, $user,$sortStyle) {
		$sortStyleOrder = isset($sortStyle) ? $sortStyle : '';
		if (empty($sortStyleOrder)) {
			return $pdo->query("SELECT id, user_id, assigned_user_id, description, is_done, date_added FROM task WHERE user_id = '$user'");
		} else {
			return $pdo->query("SELECT id, user_id, assigned_user_id, description, is_done, date_added FROM task WHERE user_id = '$user' ORDER BY $sortStyle ASC");
		}
	}
	
	//Список задач для пользователя
	function listOfTasksWithSortForUser ($pdo, $user,$sortStyle) {
		$sortStyleOrder = isset($sortStyle) ? $sortStyle : '';
		if (empty($sortStyleOrder)) {
			return $pdo->query("SELECT id, user_id, assigned_user_id, description, is_done, date_added FROM task WHERE assigned_user_id = '$user'");
		} else {
			return $pdo->query("SELECT id, user_id, assigned_user_id, description, is_done, date_added FROM task WHERE assigned_user_id = '$user' ORDER BY $sortStyle ASC");
		}
	}
	
	//Список пользователей
	function allMembers ($pdo) {
		$stmt = $pdo->query("SELECT id, login FROM user");
		$listOfUsers = array ();
		$n = 0;
		while ($row = $stmt->fetch()) {
			$listOfUsers[$n]['login'] = $row['login'];
			$listOfUsers[$n]['id'] = $row['id'];
			$n++;
		}
		return $listOfUsers;
	}
		
	
	//Добавление задачи
	function addTask ($pdo, $description, $userId) {
		$userMaster = $userId;
		$descriptionOfTask = isset($description) ? $description : '';
		$date = date('Y/m/d H:i:s');
		$isDone = 0;
		$add = $pdo->prepare('INSERT INTO task (user_id, description, is_done, date_added) VALUES (?, ?, ?, ?)');
		$add->bindParam(1, $userMaster, PDO::PARAM_STR);
		$add->bindParam(2, $descriptionOfTask, PDO::PARAM_STR);
		$add->bindParam(3, $isDone, PDO::PARAM_INT);
		$add->bindParam(4, $date, PDO::PARAM_STR);
		$add->execute();
	}
	
	//Изменение описания задачи
	function changeTaskDescription ($pdo, $description, $idForChanging) {
		$descriptionOfTask = isset($description) ? $description : '';
		$idForChangingOfTask = isset($idForChanging) ? $idForChanging : '';
		$action = $pdo->prepare('UPDATE task SET description = ? WHERE id = ?');
		$action->bindParam(1, $description, PDO::PARAM_STR);
		$action->bindParam(2, $idForChanging, PDO::PARAM_STR);
		$action->execute();
	}
	
	//Выбор задачи для изменения описания
	function change($pdo, $id) {
		$action = $pdo->query('SELECT description FROM task WHERE id = ' . $id . '');
		while ($row = $action->fetch()) {
			return $value = $row['description'];
		}
	}
	
	//Завершение задачи
	function done($pdo, $id) {
		$action = $pdo->prepare('UPDATE task SET is_done = 1 WHERE id = ?');
		$action->execute(array($id));
	}
	
	//Удаление задачи
	function delete($pdo, $id) {
		$action = $pdo->prepare('DELETE from task WHERE id = ?');
		$action->execute(array($id));
	}
	
	//Назначение ответственного
	
	function assignUser ($pdo, $user, $taskId) {
		$action = $pdo->prepare("UPDATE task SET assigned_user_id='$user' WHERE id = '$taskId'");
		$action->execute(array($id));
		
	}