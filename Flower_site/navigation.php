<?php


function navigation($form_action,$items,$pages)
{
	$pagescount=$pages+1;
	$gal=new Galery($items);	
		
	if ($_REQUEST['help'])
		{
			$gal->set_previous_page($_REQUEST['help']);
		}
	$i=0;
	while($i<$pagescount)
		{
			if($_REQUEST["flower$i"])
			{
				$gal->set_current_page($i,$items);
			}
			$i++;
		}
	if ($_REQUEST['back'])
		{
			$gal->back($items);
		}
	if ($_REQUEST['forward'])
		{
			$gal->forward($items);
		}

	echo $gal->content;
	echo "<form action=$form_action name='navigation'><input type='hidden' name='help' value=$gal->current_page></input>";
	if($gal->current_page!=0)
		{
			echo "<input type='submit' name='back' value='Назад'></input>";
		}

	$i=0;
	while ($i<$pagescount)
		{
			echo "<input type='submit' name='flower".$i."' value='".($i+1)."'></input>";
			$i++;
		}
		
	if($gal->current_page!=$pages)
		{
			echo "<input type='submit' name='forward' value='Вперед'></input>";
		}
	echo "</form>";
	echo "Это вставить где надо - текущая страница ".($gal->current_page+1);
}


?>
