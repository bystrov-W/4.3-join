<?php
	$pageTitle = 'Авторизация и регистрация';
	require ('header.php');
?>
<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Список дел — авторизация</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	</head>
	<body>
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>Регистрация и авторизация</h1>
					<form role="form" method="post">
						<div class="form-group">
							<label for="login">Логин</label>
							<input type="login" class="form-control" id="login" name="login" placeholder="login">
						</div>
						<div class="form-group">
							<label for="password">Пароль</label>
							<input type="password" class="form-control" id="password" name="password" placeholder="password">
						</div>
						<button type="submit" class="btn btn-success" name="authorization">Авторизироваться</button>
						<button type="submit" class="btn btn-info" name="registration">Зарегистрироваться</button>
					</form>
					<?php if (isset($message)) {?>
					<p class="bg-primary"><?= $message; ?></p>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
    <footer class="footer">
      <div class="container">
        <p class="text-muted"><br/><br/><br/><br/></p>
      </div>
    </footer>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</body>
</html>