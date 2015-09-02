<?php
session_start();
?>

<html>
<head>
<title>authorization</title>
</head>
<body>
<link href="../css/style.css" rel="stylesheet">
<link href="../css/framestyle.css" rel="stylesheet">

	<div class="header site">
		<?php
		include "../parts/header.html";
		?>
	</div>

	<div class="menu site">
		<?php
		include "../parts/menu.html";
		?>
	</div>

	<div class="main-content site">
		<div class="text-content">
			<?php
	
				if($_SESSION['auth']=='admin' and !$_REQUEST['check_pas'])
					{
						echo "
							Можете посетить страницы ниже
							<a href='user_table.php'>Пользователи</a><br>
							<a href='roses_table.php'>Список роз</a><br>
							<a href='balsamin_table.php'>Список бальзаминов</a><br>
							<a href='zigo_table.php'>Список зигокактусов</a>
							";
					}

				if(!$_REQUEST['check_pas'] and !$_SESSION['auth'])
					{
						echo"<form action='authorization.php' method='POST' name='auth'>
						<input type='text' name='adminname' required placeholder='Введите имя администратора' class='field'></input><br>
						<input type='password' name='adminpas' required placeholder='Введите пароль администратора' class='field'></input><br>
						<input type='submit' name='check_pas' value='Войти' class='button'></input>
	</form>";
					}

				if($_REQUEST['check_pas'])
					{
						if($_REQUEST['adminname']=='ArvenAnna' and $_REQUEST['adminpas']=='cjkmdfnj1')
							{
								$_SESSION['auth']='admin';
								echo "Спасибо за авторизацию
								Можете посетить страницы ниже
								<a href='user_table.php'>Пользователи</a><br>
								<a href='roses_table.php'>Список роз</a><br>
								<a href='balsamin_table.php'>Список бальзаминов</a><br>
								<a href='zigo_table.php'>Список зигокактусов</a>";
							}	
						else
							{
								echo "Неправильная пара логин-пароль";
								echo "<form action='authorization.php' method='POST' name='back'>
							<input type='submit' name='back' value='Назад' class='button'></input>
							</form>";
							}

					}

?>
		</div>
	</div>

	<div class="footer site">
		<?php
		include "../parts/footer.html";
		?>
	</div>
				
</body>

</html>
