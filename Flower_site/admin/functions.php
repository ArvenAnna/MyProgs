<?php

function num_of_rows($db_table)
{
	$db = mysql_connect('localhost','root','');
	mysql_select_db("flowers" ,$db);
	$query="select * from $db_table;";
	$result=mysql_query($query);
	mysql_close($db);
	$num=0;
		while($row=mysql_fetch_array($result))
		{
			$num++;
		}
	return $num;
}

function error_bd($error_number)
{
	if($error_number==1)
	{
		echo "База данных упала и лежит безвозвратно - то бишь нет подключения и все тут";
	}
	
	if($error_number==2)
	{
		echo "Базе данных стало плохо от данных, которые вы внесли";
	}
	
	if($error_number==2)
	{
		echo "База данных не может выполнить запрос";
	}
}


class Flower
{
	public $kind;
	public $color;
	public $height;
	public $width;
	public $description;
	public $price;
	public $foto;
	public $availability;
	
	function __construct()
	{
		$this->kind="";
		$this->color="";
		$this->height=0;
		$this->width=0;
		$this->description="";
		$this->price=0;
		$this->foto="";
		$this->availability="нет";
	}
	
	function __destruct()
	{}
	
	function set_fields($kind,$color,$height,$width,$description,$price,$foto,$availability)
	{
		$this->kind=$kind;
		$this->color=$color;
		$this->height=$height;
		$this->width=$width;
		$this->description=$description;
		$this->price=$price;
		$this->foto=$foto;
		$this->availability=$availability;
	}
	
	function get_validate_logs()
	{
		$valid_logs=array("err_color"=>0,
							"err_float"=>0);
		
		$this->color=strip_tags($this->color);
		$this->description=strip_tags($this->description);
		
		$this->color=Trim($this->color);
		$this->height=Trim($this->height);
		$this->width=Trim($this->width);
		$this->price=Trim($this->price);
		
		$this->color=Strtolower($this->color);
	
		$pattern_color="/^\D{4,}$/i";
		$pattern_float="/^\d+(\.\d+|)$/i";
		
		if(!preg_match($pattern_color,$this->color))
			{
				$valid_logs["err_color"]=1;	
			}
	
		if(!preg_match($pattern_float,$this->height)or !preg_match($pattern_float,$this->width) or !preg_match($pattern_float,$this->price))
			{
				$valid_logs["err_float"]=1;
			}
		
			
		return $valid_logs;
	}
	
	function insert_to_bd()
	{
		$db = mysql_connect('localhost','root','');
		if(!db)
		{error_bd(1);}
		mysql_select_db("flowers",$db);
		$query="insert into ".$this->kind." (color,height,width,description,price,foto,availability) values(\"$this->color\",$this->height,$this->width,\"$this->description\",$this->price,\"$this->foto\",\"$this->availability\");";
		$result=mysql_query($query);
		if(!$result)
		{error_bd(2);}
		mysql_close($db);
	}
	
	function extract_from_db($db_table,$id, $height_range=array(5,60),$width_range=array(5,30),$price_range=array(20,300),$color=null,$availability="да")
	{
		$this->kind=$db_table;
		$db = mysql_connect('localhost','root','');
		if(!db)
		{error_bd(1);}
		mysql_select_db("flowers",$db);
		$query="select * from $this->kind where id=$id;";
		$result=mysql_query($query);
		if(!$result)
		{error_bd(3);}
		mysql_close($db);
		
		while($row=mysql_fetch_array($result))
		{
			$this->color=$row[0];
			$this->height=$row[1];
			$this->width=$row[2];
			$this->description=$row[3];
			$this->price=$row[4];
			$this->foto=$row[5];
			$this->availability=$row[6];
			if($color)
			{
				if($this->color!=$color)
					{return false;}
			}
			if($this->height<$height_range[0] or $this->height>$height_range[1])
				{return false;}
			if($this->width<$width_range[0] or $this->width>$width_range[1])
				{return false;}
			if($this->price<$price_range[0] or $this->price>$price_range[1])
				{return false;}
			if($this->availability!=$availability)
				{return false;}
	
			return true;
		}
		
	}
	
	function update_bd($id)
	{
		$db = mysql_connect('localhost','root','');
		if(!$db)
		{error_bd(1);}
		mysql_select_db("flowers" ,$db);
		if($this->foto=="")
		$query="update $this->kind set color=\"$this->color\", height=$this->height, width=$this->width, description=\"$this->description\", price=$this->price, availability=\"$this->availability\" where id=$id;";
		else
		$query="update $this->kind set color=\"$this->color\", height=$this->height, width=$this->width, description=\"$this->description\", price=$this->price, foto=\"$this->foto\", availability=\"$this->availability\" where id=$id;";	
		$result=mysql_query($query);
		if(!$result)
		{error_bd(2);}
		mysql_close($db);
	}
	
}

class Galery
{
	public $current_page;
	public $previous_page;
	public $content;
	
	function __construct($items)
	{
		$this->current_page=0;
		$this->previous_page=0;
		$this->content=$items[0];
	}
	
	function set_previous_page($previous_page)
	{
		$this->previous_page=$previous_page;
	}
	
	function set_current_page($current_page,$items)
	{
		$this->current_page=$current_page;
		$this->content=$items[$this->current_page];
	}
	
	function back($items)
	{
		$this->current_page=$this->previous_page-1;
		$this->content=$items[$this->current_page];
	}
	
	function forward($items)
	{
		$this->current_page=$this->previous_page+1;
		$this->content=$items[$this->current_page];
	}
}

class User
{
	public $name;
	public $email;
	public $letter;
	public $foto;
	public $datetime;
	
	function __construct()
	{
		$this->name="";
		$this->email="";
		$this->letter="";
		$this->foto="";
		$this->datetime="";
	}
	
	function set_user_information($name,$email,$letter,$ip)
	{
		$this->name=$name;
		$this->email=$email;
		$this->letter=$letter;
		$this->foto=$ip."_".date("d_m_Y H_i_s");
		$this->datetime=date("Y-m-d H:i:s");
	}
	
	function validate()
	{
		$valid_log=0;
		
		$this->name=strip_tags($this->name);
		$this->email=strip_tags($this->email);
		$this->letter=strip_tags($this->letter);
		
		$this->name=Trim($this->name);
		$this->email=Trim($this->email);
	
		$pattern_email="/^.*@.*\.\w{2,5}$/i";
		
		if(!preg_match($pattern_email,$this->email))
			{
				$valid_log=1;	
			}
			
		return $valid_log;		
	}
	
	function insert_to_bd()
	{
		$db = mysql_connect('localhost','root','');
		if(!$db)
		{error_bd(1);}
		mysql_select_db("flowers",$db);
		$query="insert into users (name,email,letter,foto,date) values(\"$this->name\",\"$this->email\",\"$this->letter\",\"$this->foto\",\"$this->datetime\");";
		$result=mysql_query($query);
		if(!$result)
		{error_bd(2);}
		mysql_close($db);
	}
	
	
	function extract_from_bd($id)
	{
		$db = mysql_connect('localhost','root','');
		if(!$db)
		{error_bd(1);}
		mysql_select_db("flowers",$db);
		$query="select * from users where id=$id;";
		$result=mysql_query($query);
		if(!$result)
		{error_bd(3);}
	
		mysql_close($db);
		
		while($row=mysql_fetch_array($result))
		{
			$this->name=$row[0];
			$this->email=$row[1];
			$this->letter=$row[2];
			$this->foto=$row[3];
			$this->datetime=$row[4];
		}
		
	}

}

?>
