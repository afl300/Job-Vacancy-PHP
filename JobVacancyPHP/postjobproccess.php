<!doctype html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<meta name="Description" content="Assignment 1: Proccessed Posting"/>
	<meta name="Keywords" content="Web,programming,assignment" />
	<link rel="stylesheet" href="style/style.css"/>
	<link rel="icon" href="images/logo.png"/>
<title>Proccessing Post</title>

</head>

<body>
	<header><?php include("includes/header.inc")?></header>
<main><div id="intro">
	<h1>Job Vacancy Posting System</h1>
	<?php
	if(isset($_POST["title"])){
		//this part is to validate the information that is passing through
		$err_msg="";
		$posID=$_POST["PID"];
		$title = $_POST["title"];
		$descript=$_POST["descript"];
		$closeDate=$_POST["close"];
		$state=$_POST["State"];
		$contract = $_POST["contract"];
		$position=$_POST["position"];
		
		$letterSpacePatten = "/^[A-Za-z ]+$/";
		
		if (!isset($posID) || empty($posID))
		{
			$err_msg .= "Please enter the Position ID<br/>";
		} 
		else if (!preg_match("/^P{1}+[0-9]{4}$/",$posID))
		{
			$err_msg .= "Please eneter the Position ID correctly like 'P0000'<br/>";
		}
		
		if(empty($title))
		{
			$err_msg .= "Please enter the title of this position<br/>";
		}
		else if (!preg_match("/^[a-zA-Z0-9,.!? ]{1,20}$/", $title))
		{
			$err_msg .= "The title only accepts the maximum of 20 character. It also only accepts spaces, commans, periods, full stop and exclamation point.<br/>";
		}
		
		if(empty($descript))
		{
			$err_msg .= "Please enter the description of this position<br/>";
		} /*else if(!preg_match('/^[^"]{1,260}*$/',$descript)){
		 $err_msg.="Please enter less than 260 characters";
		 }*/
		
		if(empty($closeDate))
		{
			$err_msg.= "Please enter the closing date of this position<br/>";
		} 
		else if(!preg_match("/^((([0-2]{1})([0-9]{1}))|(([3]{1})([0-1]{1})))\/((([0]{1})([0-9]{1}))|(([1]{1})([0-2]{1})))\/([0-9]{2})$/",$closeDate))
		{
			$err_msg.="Please enter the closing date like dd/mm/yy layout<br/>";
		}
		
		//this part is to validate application post
		if (isset($_POST["applyMethodpost"]) ||isset($_POST["applyMethodMail"]))
		{
			$post="";
			$email="";
			if (isset($_POST["applyMethodpost"]))
			{
				$post = "Post";
			}
			
			if (isset($_POST["applyMethodMail"]))
			{
				$email = "Email";
			}
		}
		else
		{
			$err_msg .= "Please select an application method. <br/>";
		}
				
		if(empty($state)|| $state =="---")
		{
			$err_msg.= "Please select a state.<br/>";
		}
		
		if($err_msg!="")
		{
			echo "<p>".$err_msg."</p>";
			echo "<p><a href='jobpostform.php'>Return to Post Job Vacancy page</a></p><p><a href='index.php'>Return to Home Page</a></p>";
			$result = false;
		} 
		else 
		{
			$result = true;
		}
		
		$filename="data/jobposts/jobs.txt";
		if($result == "true" && file_exists($filename)==false)
		{
			//this part is mainly to check if there is a file for this
			umask(0007);
			$dir = "data/jobposts";
			if (!is_dir($dir))
			{
				mkdir($dir,02770);
			}
			if($file=fopen($filename, 'a'))
			{
				$data="$posID\t$title\t$descript\t$closeDate\t$position\t$post, $email\t$contract\t$state";
				if(fwrite($file,$data))
				{
			 		echo"<p>The vacancy positition have successfully been recorded and stored.</p><br>
			 		<p><a href='index.php'>Return to Home Page</a></p>"; 
				}
			}
			fclose($file);
		}
		else if ($result == true && file_exists($filename)==true)//this is to test if there is any duplicate data
		{
			$isused="";
			if($file =fopen($filename,'r'))
			{
				$alldata=array();
				$postIDarray=array();
				while (!feof($file))
				{
					$line=fgets($file);
					$data=explode("\t",$line);
					$alldata[]=$data;
					$posIDarray[]=$data[0];
				}
			}
			fclose($file);
			$newdata="";
			$newdata =!(in_array($posID,$posIDarray));
		 
			
		 if ($newdata)
			{
				//this is the main aera where information would ber inputed
				if($file=fopen($filename, 'a'))
				{
					$data="\n$posID\t$title\t$descript\t$closeDate\t$position\t$post, $email\t$contract\t$state";
					if(fwrite($file,$data))
					{
						echo"<p>The vacancy positition have successfully been recorded and stored.</p><br>
						<p><a href='index.php'>Return to Home Page</a></p>";
					}
				fclose($file);
				}
			} 
			else
			{
				echo "<p>This position ID been used, please choose another one.</p><p><a href='jobpostform.php'>Return to Post Job Vacancy page</a></p><p><a href='index.php'>Return to Home Page</a></p>";
			}
		 
			
		}
	 }
 
		else
		{ 
			echo "<p>Please fill out the form</p><p><a href='index.php'>Return to Home Page</a></p>";
 }
   
	?>

	
	
	</div></main>
	<footer><?php include("includes/footer.inc")?></footer>
</body>
</html>