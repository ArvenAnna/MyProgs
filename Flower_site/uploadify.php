<?php

$targetFolder = '/uploads'; // Relative to the root

$verifyToken = md5('unique_salt' . $_POST['timestamp']);

if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	$targetFile = rtrim($targetPath,'/') . '/' .$_SERVER["REMOTE_ADDR"]."_".$_FILES['Filedata']['name'];
	
	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png','bmp'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	if($_FILES['Filedata']['size']<4000000)
	{
		if (in_array($fileParts['extension'],$fileTypes)) 
		{
			move_uploaded_file($tempFile,$targetFile);
			echo 'Файл успешно загружен';
		} 
		else {
			echo 'Неверный тип файла!!!';
			}
	}
	else echo 'Слишком большой файл';
	
}
?>
