<?php
function appdata($post,$email)
{//this function is mainly to put the application type as seperate item
	if ($post=="Post" && $email=="Email"){
			$appdata= "$post, $email";
		} 
	else if ($post=="Post")
	{
		$appdata = "Post";
	}
	else if ($email=="Email")
	{
		$appdata = "Email";
	}
	return $appdata;
}	

function searchtitle($jobtitle, $length,$title)
{
	if((substr($jobtitle,0,$length) == substr($title,0,$length))||(strpos($jobtitle,$title)!==false)||(strcasecmp(substr($jobtitle,0,$length),substr($title,0,$length))==0))
	{
	return true;
	}
	else 
	{
		return false;
	}
}

function validatetitle($title)
{
	if (!preg_match("/^[a-zA-Z0-9,.!? ]{1,20}$/", $title))
	{
		$err_msg = "The title only accepts the maximum of 20 character. It also only accepts spaces, commans, periods, full stop and exclamation point.<br/>";
	}
	else
	{
		$err_msg = "";
	}
	return $err_msg;
}

//this is to test that the data that its seraching isfrom the future, not from the past
function testdate($date)
{
	if (substr("$date", 6,2)> date('y'))//this is to test if the year is if future
	{
		return true;
	}
	else if (substr("$date", 6,2)== date('y'))//if it sees your in same year, it would move on to see if the month is this month or future month
	{
		if (substr("$date", 3,2)> date('m'))//it sees your from future month
		{
			return true;
		}
		else if (substr("$date", 3,2)== date('m'))//if it sees your in same month, it would move on to check if your in same day
		{
			if (substr("$date",0,2)>= date ('d'))//this is to see if your in either the same date or a future date
			{
				return true;
			} 
			else
			{
				return false; //this is if its from the previous date
			}
		}
		else 
		{
			return false; //this is if its from the previous month
		}
	} 
	else 
	{
		return false;//this is if its from previous years
	}
}

function form ($data)
{
	$posID=$data[0];
	$jobtitle = $data[1];
	$des = $data[2];
	$date = $data[3];
	$position = $data[4];
	$applyby = $data[5];
	$contact = $data[6];
	$location = $data[7];
	
	//this is to check which application is selected
	$app = explode(", ",$applyby);
	$appdata="";
	$post = $app[0];
	$email = $app[1];
	$appdata = appdata($post,$email);

	if (testdate($date) == true)//this is to print the data out easily through here
	{
		echo"<div class='jobinfo'><p>";
		echo"Position ID {$posID}<br/>";
		echo"Job Title: {$jobtitle}<br/>";
		echo"Description:". '"'."{$des}".'"<br/>';
		echo"Closing Date: {$date}<br/>";
		echo"Position:{$position}<br/>";
		echo"Application by: {$appdata}<br/>";
		echo"Contract type: {$contact}<br/>";
		echo"Location:{$location}<br/>";
		echo"</p></div>";
	}
}

function formempty($filename,$handle)//this is to be used when there is no data in use
{
	while (!feof($handle))
	{
		$line = fgets($handle);
		$data = explode("\t",$line);
		//this area is where the data from the textfile is temporary stored
		form ($data);
	}
	fclose($handle);
}

function timecompare($a,$b)//this is used to compare the date
{
	//some of it is borrowed from: https://www.geeksforgeeks.org/php-datetime-createfromformat-function/
	$timeA = DateTime::createFromFormat('d/m/Y', $a[3]);//these is transfer into a date
	$timeB = DateTime::createFromFormat('d/m/Y', $b[3]);
	if($timeA<$timeB)//this is to check if the first time is either bigger, smaller or equal in dates so that it can sort it much easier.
	{
		return 1;
	}
	else if ($timeA == $timeB)//this is to check if the first time is either bigger, smaller or equal in dates so that it can sort it much easier.
	{
		return 0;
	}
	else if ($timeA>$timeB)//this is used to switch around if one time is bigger than another
	{
		return -1;
	}
}

function sortdata($filename)//this section is used to sort the dates of the dtaabase
{
	$handle = fopen($filename, "r");//this is to start off the database
	$i=0;//this is to check which line it is
	while (!feof($handle))
	{
		$line = fgets($handle);
		$data = explode("\t",$line);
		//echo $line."<br/>";
		$date = $data[3];
		$array[$i] = $date;//this is to store it as an array
		$multiarray[$i]=array($data[0],$data[1],$data[2],$data[3],$data[4],$data[5],$data[6],$data[7]);
		$i++;//add one so each entry for array be unique
	}
	fclose($handle);
	usort($multiarray,"timecompare");
	file_put_contents($filename,"");
	
	for($y=0;$y<count($multiarray);$y++)
	{

		
		for($j=0;$j<count($multiarray[$y]);$j++)
		{
			$info[$j]=$multiarray[$y][$j];
			//echo"<br/>";
		}
		$connect = implode("\t",$info);
		$connect = str_replace(PHP_EOL,'',$connect);//the PHP_EOL was looked over here: https://phppot.com/php/php-line-breaks/


		$file =fopen($filename,'a+');
		if($y==0)
		{
			fwrite($file,$connect);
		}
		if($y<count($info)&& $y!=0)
		{
			fwrite($file,"\n".$connect);
		}
		

		fclose($file);
	}
	

	
}

function appsearch($appdata, $app, $bothapp, $app1, $app2)
{
	if ($appdata==$app||$bothapp==$appdata||$appdata==$app1||$appdata==$app2)
	{
		return true;
	}
	else
	{
		return false;
	}
}
?>
