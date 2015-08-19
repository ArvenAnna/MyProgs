<?php
include "functions.php";
session_start();
?>

<html>
<head>
<title>roses table</title>
<script type="text/javascript" src="../js/jquery.js"></script>
</head>
<body>


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
					$form_action='roses_table.php';
					$db_table='roses';
	
						
					echo "
						<table>
							<thead>
								<td>Цвет</td>
								<td>Высота</td>
								<td>Ширина</td>
								<td>Описание</td>
								<td>Цена</td>
								<td>Фото</td>
								<td>Доступность</td>
								<td>Поменять доступность</td>
							</thead>
						<form name='bd' enctype='multipart/form-data'>
						";

					$i=0;
					$rows=num_of_rows($db_table);
					$flower=new Flower();
					
					while($i<=$rows)
						{
						
							$flower->extract_from_db($db_table,$i+1);
									
							echo "
							<tr>";
								
							if($i!=$rows)
							{
								echo "
								<td><input type='text' id='color".$i."' name='color".$i."' value='".$flower->color."'></input></td>
								<td><input type='text'  id='height".$i."' name='height".$i."' value='".$flower->height."'></input></td>
								<td><input type='text' id='width".$i."' name='width".$i."' value='".$flower->width."'></input></td>
								<td><textarea id='description".$i."' name='description".$i."'>{$flower->description}</textarea></td>
								<td><input type='text' id='price".$i."' name='price".$i."' value='".$flower->price."'></input></td>
								<td><input type='file' id='foto".$i."' name='foto".$i."' value=''>".$flower->foto."</input></td>";
								
								if($flower->availability=="да")
								{
									echo "<td><select id='availability".$i."' name='availability".$i."'>
								<option value='да' selected>yes</option>
								<option value='нет'>no</option>
								</select></td>";
								}
								else
								{
									echo "<td><select id='availability".$i."' name='availability".$i."'>
								<option value='да'>yes</option>
								<option value='нет' selected>no</option>
								</select></td>";
								}
								echo "
								<td><button id='alt".$i."' name='alt".$i."' class='button'>Изменить</button></td>
								<input type='hidden' id='".$i."' value='".$i."'></input>";
							}
							else
							{
								echo "
								<td><input type='text' id='color".$i."' name='color".$i."' value=''></input></td>
								<td><input type='text' id='height".$i."' name='height".$i."' value=''></input></td>
								<td><input type='text' id='width".$i."' name='width".$i."' value=''></input></td>
								<td><textarea id='description".$i."' name='description".$i."'></textarea></td>
								<td><input type='text' id='price".$i."' name='price".$i."' value=''></input></td>
								<td><input type='file' id='foto".$i."' name='foto".$i."'></input></td>
								<td><select id='availability".$i."' name='availability".$i."'>
								<option value='да'>yes</option>
								<option value='нет'>no</option>
								</select></td>
								<td><button id='alt".$i."' name='alt".$i."' class='button'>Создать</button></td>
								<input type='hidden' id='alt".$i."' value='".$i."'></input>";
							}								
							echo "</tr>";
							
							$i++;
						}
						

					echo "
					</form>
					</table>";
						
					echo "Просмотреть другие таблицы БД можно по ссылкам:
					<a href='user_table.php'>Пользователи</a>
					<a href='balsamin_table.php'>Бальзамины</a>
					<a href='zigo_table.php'>Зигокактусы</a>
					";

					$i=0;
					$rows=num_of_rows($db_table);
					
				while($i<=$rows)
				{
					
				
?>
			
				
<script>
$(document).ready(function() {
  $("#alt"+"<?php echo $i;?>").click(function() {

  var color = $("#"+"<?php echo "color$i";?>").val();
  var height = $("#"+"<?php echo "height$i";?>").val();
  var width = $("#"+"<?php echo "width$i";?>").val();
  var description = $("#"+"<?php echo "description$i";?>").val();
  var price = $("#"+"<?php echo "price$i";?>").val();
  var foto = $("#"+"<?php echo "foto$i";?>").val();
  var availability = $("#"+"<?php echo "availability$i";?>").val();
  var rownumber = "<?php echo $i;?>";
  var input = $("#"+"<?php echo "foto$i";?>");
  
  var formData = new FormData();
  formData.append('<?php echo "color$i";?>', color);
  formData.append('<?php echo "height$i";?>', height);
  formData.append('<?php echo "width$i";?>', width);
  formData.append('<?php echo "description$i";?>', description);
  formData.append('<?php echo "price$i";?>', price);
  formData.append('<?php echo "foto$i";?>', foto);
  formData.append('<?php echo "availability$i";?>', availability);
  formData.append('number', '<?php echo $i;?>');
  formData.append('img', input.prop('files')[0]);
  formData.append('db', 'roses');
   
   $.ajax({
    url: "ajax.php",
	processData: false,
	contentType: false,
    type: "POST",
    data: formData,
    success: function(data){
    alert(data);
    }
    });
	return false;
   });
});
</script>
<?php
				$i++;
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
