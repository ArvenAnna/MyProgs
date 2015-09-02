<?php
include "admin/functions.php";
include "navigation.php";
?>

<html>
<head>
<title>house rose</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="js/jquery.js"></script>
<script src="lightgallery/lightgallery.min.js" type="text/javascript"></script>
<link href="css/style.css" rel="stylesheet">
<link href="css/framestyle.css" rel="stylesheet">
<link href="lightgallery/skins/snow/style.css" type="text/css" media="screen" rel="stylesheet" />
<script src="lightgallery/lang/ru_utf8.js" type="text/javascript"></script>
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
		<div class="gallery"><h2>Цветущие красавицы</h2>
			<?php
				$form_action='gallery.php';
				$i=2;
				$dir="gallery";
				$files = scandir($dir);
				$pages=0;
				$j=0;
				$items[0];
				
				while($i<count($files))
					{
						if($j==8)	
							{
								$j=0;
								$pages=$pages+1;
							}
						$files[$i]="gallery/".$files[$i];
						$items[$pages]=$items[$pages]."<div><a href=".$files[$i]." rel='lightgallery[flowers]'><img src='".$files[$i]."'/></a></div>";
						$i++;
						$j++;
					}
					
				
				navigation($form_action,$items,$pages);
		
			?>
		</div>
	</div>
</div>

<div class="footer site">
	<?php
	include "parts/footer.html";
	?>
</div>

<div class="top">vverh</div>
<div class="bottom">vniz</div>

<script type="text/javascript">

  var top_show = 150; // В каком положении полосы прокрутки начинать показ кнопки "Наверх"
  var bottom_show=500;// В каком положении полосы прокрутки начинать показ кнопки "Вниз"
  var delay_up = 1000; // Задержка прокрутки вверх
  var delay_down = 3000;  // Задержка прокрутки вниз
  $(document).ready(function() {
		$(window).scroll(function () { // При прокрутке попадаем в эту функцию
				/* В зависимости от положения полосы прокрукти и значения top_show, скрываем или открываем кнопку "Наверх" и "Вниз"*/
				if ($(this).scrollTop() > top_show) $('.top').fadeIn();
				else $('#top').fadeOut();
				if ($(this).scrollTop() < delay_down) $('.bottom').fadeIn();
				else $('#nah').fadeOut();
				});
		$('.top').click(function () { 
				/* Плавная прокрутка наверх */
				$('body, html').animate({
								scrollTop: 0
								}, delay_up);
				});
		
		$('.bottom').click(function () {
				/* Плавная прокрутка вниз */
				$('body, html').animate({
								scrollTop : 8000
								}, delay_down);
				});

  });
  
  
</script>
<script>lightgallery.init({overlayColor:"RGB(45,45,234)"});</script>
</body>
</html>
