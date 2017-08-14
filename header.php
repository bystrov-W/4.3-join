<?php require ('init.php'); ?>
<!DOCTYPE html>
<html lang="ru">
	<head>
	    <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
		<title><?php echo $pageTitle; ?></title>
	</head>
	<body>
		<nav class="navbar navbar-default">
		  <div class="container">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <a class="navbar-brand" href="index.php">Список дел</a>
			</div>
			<div id="navbar" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
			</ul>
			</ul>
			<ul class="nav navbar-nav navbar-right">
			<?php if (isset($message)) {?>
			<p class="navbar-text">Пользователь: <?= $_SESSION['user']; ?></p>
			<?php } ?>
			<li><a href="login.php?exit">Выйти</a></li>
			</ul>
			</ul>
		  </div>
		</nav>