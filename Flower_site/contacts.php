<?php
include "admin/functions.php";
?>

<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>house rose</title>

<script type="text/javascript" src="js/jquery.js"></script>
<script src="js/jquery.uploadify.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css/uploadify.css">
<link href="css/style.css" rel="stylesheet">
<link href="css/framestyle.css" rel="stylesheet">
</head>

<body>


<div class="header site">
	<?php
	include "parts/header.html";
	?>
</div>



<div class="menu site">
	<?php
	include "parts/menu.html";
	?>
</div>


<div class="main-content site">
	<div class="text-content">
		<div class="lokh">
		Для возможности загрузки файлов включи JS лошара!
		<a href="http://www.google.ru/support/bin/answer.py?answer=23852">Как?</a>
		</div>
		<script>
			$('.lokh').hide();
		</script>
		<?php
			if(!$_REQUEST['submitted'])
			{
				echo '
			<h2>Контактная информация</h2>
			<span>По вопросам приобретения или обмена:</span>
			<div class="contacts">
				<div class="icon icon-tel"></div>
				<span>+380974660624</span>
				<div class="icon icon-mail"></div>
				<span>LastSunsetBeam@yandex.ru</span>
			</div>
			<div class="form-connect">
				<span>Или свяжитесь со мной при помощи формы ниже:</span>
				<form action="contacts.php" method="POST" name="userconnect" enctype="multipart/form-data" accept-charset="utf-8">
					<input type="text" name="username" placeholder="Введите Ваше имя" class="field"></input><br>
					<input type="e-mail" name="usermail" required placeholder="Введите Ваш e-mail" class="field"></input><br>
					<textarea name="letter" placeholder="Напшите здесь письмо, прикрепите файл, если нужно через форму ниже" class="field fieldarea"></textarea><br>
					<input type="hidden" name="max_file_size" value=4000000></input>
				
					<input id="file_upload" name="foto" type="file"></input><br>
					<div class="file_validate_massage"></div><br>
					<input type="submit" name="submitted" value="Отправить письмо" class="button"></input>
				</form>
			</div>				
				';
		?>
	<script type="text/javascript">
		<?php $timestamp = time();?>
		$(function() {
			$('#file_upload').uploadify({
				'formData'     : {
					'timestamp' : '<?php echo $timestamp;?>',
					'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
				},
				'swf'      : 'swf/uploadify.swf',
				'uploader' : 'uploadify.php',
				'onUploadSuccess' : function(file, data, response) {
				$(".file_validate_massage").empty();
				$(".file_validate_massage").append(data);
				}

			});
		});
	</script>
		<?php
			}

			

			else
			{
							
				$user=new User();
				$user->set_user_information($_REQUEST['username'],$_REQUEST['usermail'],$_REQUEST['letter'],$_SERVER["REMOTE_ADDR"]);
				
								
				if ($user->validate()==0)
				{
					$user->insert_to_bd();
				}
				
				else
				{
					echo "Ваш мэйл гавно";
				}
				
			echo "<form action='contacts.php'><input type='submit' name='back' value='Назад' class='button'></input></form>";
								
			}		

		?>
	</div>
</div>


<div class="footer site">
	<?php
	include "parts/footer.html";
	?>
</div>


</body>
</html>
