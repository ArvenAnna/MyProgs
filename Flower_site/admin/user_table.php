<?php
include "functions.php";
session_start();
?>

<html>
<head>
<title>user table</title>
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
			if($_SESSION['auth']!='admin')
				{
					echo "Доступ запрещён";
				}
			else
				{				
					$i=0;
					
					$rows=num_of_rows("users");					
					$user=new User();
					
					echo "
						<table>
							<thead>
								<td>Имя</td>
								<td>email</td>
								<td>Письмо</td>
								<td>Дата</td>
							</thead>
						";

					while($i<$rows)
						{
						
							$user->extract_from_bd($i+1);
									
							echo "
							<tr>";
							
							echo "
								<td>$user->name</td>
								<td>$user->email</td>
								<td>$user->letter</td>
								<td>$user->datetime</td>";
							
								
							echo "</tr>";
							
							$i++;
						}
						

					echo "
					</table>";
						
					echo "Просмотреть другие таблицы БД можно по ссылкам:
					<a href='roses_table.php'>Розы</a>
					<a href='balsamin_table.php'>Бальзамины</a>
					<a href='zigo_table.php'>Зигокактусы</a>
					";

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
