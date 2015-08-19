<?php
include "admin/functions.php";
include "navigation.php";
?>

<html>
<head>
<title>house rose</title>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/loupe.js"></script>

<link href="css/style.css" rel="stylesheet">
<link href="css/framestyle.css" rel="stylesheet">

<link href="css/jquery-ui.css" rel="stylesheet">
<script src="js/jquery-ui.js"></script>
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
	<div class="text-content"><h2>Розы на продажу или обмен</h2>
		
		<?php
		$db_table='roses';
		$form_action='rose.php';
		
		$flower=new Flower();
		$i=0;
		$j=0;
		$pages=0;
		$items;
		$item[$pages]="";
		
		while($i<num_of_rows($db_table))
		{

			if((!$_REQUEST['filter'] and $flower->extract_from_db($db_table,$i+1))or($_REQUEST['filter'] and $flower->extract_from_db($db_table,$i+1,array($_REQUEST['min_cost'],$_REQUEST['max_cost']))))
			{
				echo $_POST['min_cost'];
				$items[$pages]=$items[$pages].'
				<div class="item">
					<img src='.'foto/roses/'.$flower->foto.' class="zoom" style="width: 300px;"></img>
					<div class="describe">
						<ul>
							<li><b>Цвет:</b> '.$flower->color.'</li>
							<li><b>Размеры:</b> '.$flower->height.'см в высоту, '.$flower->width.'см ширина</li>
							<li><b>Описание:</b> '.$flower->description.'</li>
							<li><b>Цена:</b> '.$flower->price.' баксов</li>
						</ul>
					</div>
				</div>
				';
				$j++;
			}

			if($j==10)	
				{
					$j=0;
					$pages=$pages+1;
				}
				
			$i++;
			
		}
		
		navigation($form_action,$items,$pages);
 
		?>
		
	</div>
</div>

<div class="filters site">
	<?php
	include "parts/filters.php";
	?>
</div>

<div class="footer site">
	<?php
	include "parts/footer.html";
	?>
</div>


<script type="text/javascript">
		$('.zoom').loupe({
		width: 200, // width of magnifier
		height: 150,// height of magnifier
		loupe: 'loupe' // css class for magnifier
		});
</script>


</body>

</html>
