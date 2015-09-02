<?php
include "functions.php";

$db_table=$_POST['db'];
$i=$_POST['number'];

	$flower=new Flower();
	$rows=num_of_rows($db_table);
	$flower->set_fields($db_table,$_POST["color$i"],$_POST["height$i"],$_POST["width$i"],$_POST["description$i"],$_POST["price$i"],$_FILES["img"]["name"],$_POST["availability$i"]);
	$err_logs=$flower->get_validate_logs();
	
		
if($err_logs['err_color']==1)
	{
		echo "Цвет менее, чем из 4 букв не существует, также не используйте цифры в названии цвета";
	}
	
if($err_logs['err_float']==1)
	{
		echo "Указывайте высоту, ширину и цену целым или числом с плавающей точкой, например, 20.5";
	}
	
if(!empty($_FILES) and $_FILES['img']['size']>4000000)
	{
		echo "Администраторы, пожалейте сервер - уменьшите размер файла";
	}

else 
	{
		if($err_logs['err_color']==0 and $err_logs['err_float']==0)
			{
		
				if($i!=$rows)
					{
						$flower->update_bd($i+1);												
					}
											
				if($i==$rows)
					{
						$flower->insert_to_bd();
					}
					
				if(!empty($_FILES))
					{
						$uploaddir = '../foto/roses/';								
						$uploadfile = $uploaddir.$_FILES["img"]["name"];
						move_uploaded_file($_FILES["img"]['tmp_name'], $uploadfile);
					}
				echo "Данные успешно внесены.";
			}
	}


?>
