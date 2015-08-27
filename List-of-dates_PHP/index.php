<input type="submit" name="calendar_to" value="#"/>

<select name='week'>
<option value="1" <?php if ($_GET['week']==1) {echo "selected";}?>>понедельник</option>
<option value="2" <?php if ($_GET['week']==2) {echo "selected";}?>>вторник</option>
<option value="3" <?php if ($_GET['week']==3) {echo "selected";}?>>среда</option>
<option value="4" <?php if ($_GET['week']==4) {echo "selected";}?>>четверг</option>
<option value="5" <?php if ($_GET['week']==5) {echo "selected";}?>>пятница</option>
<option value="6" <?php if ($_GET['week']==6) {echo "selected";}?>>суббота</option>
<option value="0" <?php if ($_GET['week']==0) {echo "selected";}?>>воскресенье</option>
</select><br>
<input type="submit" name="submitted" value="submit"/>
</form>
<?php
if($_GET["calendar_from"])
{calendar('fields','from');}

if($_GET["calendar_to"])
{
	calendar('fields','to');
}
if($_GET["submitted"])
{
	
	$range=new Range($_GET['from'],$_GET['to']);
	if(!$range->get_validation_logs())
	{
		echo "
		<table class='table table-hover'><thead><td><div>Список дат:</div></td></thead>";
		$list=$range->create_list($_GET['week']);
		for($i=0;$i<count($list);$i++)
		{
			$list[$i]=explode("-", $list[$i]);
			$newlist[$i]=$list[$i][0].".".$list[$i][1].".".$list[$i][2].' '.$list[$i][3];
			echo "<tr><td>$newlist[$i]</td></tr>";
		}
		echo "</table>";
	}
 	
}

?>

</body>

</html>

