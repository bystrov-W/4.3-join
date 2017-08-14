<?php
	$pageTitle = 'Главная';
	require ('header.php');
?>
	<div class="section">
		<div class="container">
			<div class="row">
			<h1>Список дел</h1>
				<div class="col-sm-6">
				<form role="form" action="/4.3/" method="post">
					<div class="form-group">
						<label for="text">Название</label>
						<input type="text" class="form-control" name="description" value="<?php if (isset($_GET['action']) && $_GET['action'] == 'change'){echo change($id);} ?>">
						<input type="hidden" name="idForChanging" value="<?php if (isset($_GET['action']) && $_GET['action'] == 'change'){echo $idForChanging;} ?>">
					</div>
					<button type="submit" class="btn btn-success" name="add">Сохранить</button>
				</form>
				</div>
				<div class="col-sm-6">
				<form role="form" action="/4.3/" method="post">
					<div class="form-group">
						<label for="text">Сортировать по</label>
						<select class="form-control" name="sortOption">
							<option value="1">задаче</option>
							<option value="2">статусу</option>
							<option value="3">дате добавления</option>
						</select>
					</div>
					<button type="submit" class="btn btn-info" name="sort">Сортировать</button>
				</form>
				</div>
			</div>
			<br/>
			<div class="row">
				<div class="col-sm-7">
					<h2>Задачи, поставленные вами</h2>
					<table class="table">
						<tr>
							<th>Задача</th>
							<th>Статус</th>
							<th>Дата добавления</th>
							<th>Ответственный</th>
							<th></th>
							<th>Операции</th>
						</tr>
					<?php
						while ($row = $listOfTasks->fetch())
							{
								if ($row['is_done'] == 0) {
									$status = 'Не выполнено';
								} else {
									$status = 'Выполнено';
								}
								?>
								<tr>
									<td><?php echo $row['description']; ?></td>
									<td><?php echo $status; ?></td>
									<td><?php echo $row['date_added']; ?></td>
									<td><?php foreach ($listOfUsers as $key=>$value) { if ($row['assigned_user_id'] == $value['id']) { ?>
										<?= $value['login'] ?>
									<? }}?>
									</td>
									<td>
										<form role="form" action="/4.3/" method="post" class="form-inline">
											<div class="form-group">
											<select class="form-control" name="assignUser">
											<?php foreach ($listOfUsers as $key=>$value) { if (isset($value['login']) && $value['login'] != $_SESSION['user'] ) {?>
												<option value="<?= $value['id']; ?>"><?= $value['login']; ?></option>
											<?php }} ?>
											</select>
											<input type="hidden" name="idForChanging" value="<?= $row['id']; ?>">
											<button type="submit" class="btn btn-primary btn-xs">Назначить</button>
											</div>
										</form>
									</td>
									<td>
									<span><a href="?action=change&id=<?php echo $row['id']; ?>">Изменить</a></span>
									&nbsp;&nbsp;&nbsp;
									<span><a href="?action=done&id=<?php echo $row['id']; ?>">Выполнить</a></span>
									&nbsp;&nbsp;&nbsp;
									<span><a href="?action=delete&id=<?php echo $row['id']; ?>">Удалить</a></td>
							<?php
							}
							?>
					</table>
				</div>
			<!-- вторая таблица -->
				<div class="col-sm-5">
					<h2>Задачи, поставленные для вас</h2>
					<table class="table">
						<tr>
							<th>Задача</th>
							<th>Статус</th>
							<th>Дата добавления</th>
							<th>Операции</th>
						</tr>
					<?php
						while ($row = $listOfTasksForUser->fetch())
							{
								if ($row['is_done'] == 0) {
									$status = 'Не выполнено';
								} else {
									$status = 'Выполнено';
								}
								?>
								<tr>
									<td><?php echo $row['description']; ?></td>
									<td><?php echo $status; ?></td>
									<td><?php echo $row['date_added']; ?></td>
									<td><span><a href="?action=done&id=<?php echo $row['id']; ?>">Выполнить</a></span>
							<?php
							}
							?>
					</table>
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