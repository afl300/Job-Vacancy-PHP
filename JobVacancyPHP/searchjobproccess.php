<!doctype html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<meta name="Description" content="Assignment 1: searchjob"/>
	<meta name="Keywords" content="Web,programming,assignment" />
	<link rel="stylesheet" href="style/style.css"/>
	<link rel="icon" href="images/logo.png"/>
<title>Search Job</title>

</head>

<body>
	<header>
		<?php include("includes/header.inc");?>
	</header>
<main>
	<div id="intro">
		<?php include("functionssearchproccess.php");?>
		<h1>Job Vacancy Posting System</h1>

		<?php
	$filename="../../data/jobposts/jobs.txt";
				

		//this is to validate stuff mainly and if the first bit is selected
		$err_msg ="";
		if (isset($_GET["submit"]))//this is so if the form is not selected, it would come up as an error
		{
			
			if (file_exists($filename))//this is mainly to check if the file exists
			{
				sortdata($filename);
				$handle = fopen($filename, "r");
				$fail="";
				$title ="";
				$title = $_GET["jobTitle"];
				$poschose=$_GET["position"];
				$contract=$_GET["contract"];
				$app=$_GET["app"];
				$location=$_GET["State"];
				$result = false;
				$length = strlen($title);//this is to get the length of the strign

				if(empty($title)){
					$err_msg .= "Please enter a value into Title.<br/>";
				} 
				else
				{
					$err_msg.=validatetitle($title);
					if($err_msg=="")
					{
						$result = true;
					}
					else
					{
						$result = false;
					}					
				}
				
				
				if ($result==false)
				{
					echo "<p>".$err_msg."</p>";
				}
				else
				{
					//this is if all is empty
					if($poschose=="---"&&$contract=="---"&&$app=="---"&&$location=="---")
					{
						while (!feof($handle))
						{
							$line = fgets($handle);
							$data = explode("\t",$line);
							//this area is where the data from the textfile is temporary stored
							$jobtitle = $data[1];
							$date = $data[3];
							if(searchtitle($jobtitle, $length,$title)==true &&testdate($date) == true)
							{
								form ($data);
							} 
							else 
							{
								$fail .="fail";
							}
							if(strpos($jobtitle,$title)==false)
							{
								$fail.="fail ";
							}
						}
						if ($fail != "")
						{
							echo "This data: $title is not found in the rest or all the system.<br/>";
						}
						fclose($handle);
					}
				
					//this is when searching position
					if ($poschose!="---"&&$contract=="---"&&$app=="---"&&$location=="---")
					{
						while (!feof($handle))
						{
							$line = fgets($handle);
							$data = explode("\t",$line);
							//this area is where the data from the textfile is temporary stored
							$jobtitle = $data[1];
							$des = $data[2];
							$date = $data[3];
							$position = $data[4];
							if(($poschose==$position)&& (searchtitle($jobtitle,$length,$title)==true)&&(testdate($date) == true))
							{
								form ($data);
							}
							else 
							{
							$fail .="fail";
							}
							if(strpos($jobtitle,$title)==false)
							{
								$fail.="fail ";
							}
						}
						if ($fail != "")
						{
							echo "This data: $title is not found in the rest or all the system.<br/>";
						}
						fclose($handle);
					}
					
					//this it to search contract
					if($poschose=="---"&&$contract!="---"&&$app=="---"&&$location=="---")
					{
						while (!feof($handle))
						{
							$line = fgets($handle);
							$data = explode("\t",$line);
							$datacontact = $data[6];
							$date = $data[3];
							$jobtitle = $data[1];
							if (searchtitle($jobtitle, $length,$title)==true &&$datacontact==$contract&&testdate($date) == true)
							{
								form($data);
							}
							else 
							{
								$fail .="fail";
							}
							
						}
					
						if (!empty($fail))
						{
							echo "There is no more $contract contract found in the rest or all the system.<br/>";
						}
						fclose($handle);
					}
			
					//this is to search application method
					if($poschose=="---"&&$contract=="---"&&$app!="---"&&$location=="---")
					{
						while (!feof($handle))
						{
							$line = fgets($handle);
							$data = explode("\t",$line);
							$date = $data[3];
							$jobtitle = $data[1];
							//this is to check which application is selected
							$applyby = $data[5];		
							$apps = explode(", ",$applyby);
							$appdata="";
							$post = $apps[0];
							$email = $apps[1];
							$appdata = appdata($post,$email);
							
							$bothapp="";
							$app1="";
							$app2="";
							if($app=="Post, Email")
							{
								$apply =explode(", ", $app);
								$app1=$apply[0];
								$app2=$apply[1];
							}
							else
							if($app=="Post"||$app=="Email")
							{
								$bothapp = "Post, Email";
							}
							if(searchtitle($jobtitle, $length,$title)==true &&(appsearch($appdata, $app, $bothapp, $app1, $app2)==true)&&testdate($date) == true&&testdate($date) == true)
							{
								form($data);
							} 
							
							else 
							{
								$fail .="fail";
							}
						}
						if (!empty($fail))
						{
							echo "There is no more $appdata jobs found in the rest or all the system.<br/>";
						}
						fclose($handle);
					}
				
					//this is to search the locations
					if($poschose=="---"&&$contract=="---"&&$app=="---"&&$location!="---")
					{
						while (!feof($handle))
						{
							$line = fgets($handle);
							$data = explode("\t",$line);
							$jobtitle = $data[1];
							$state = $data[7];							
							$state = str_replace(PHP_EOL,'',$state);
							$date = $data[3];
							//echo "<br/>". $state . "<br/>".$location. "<br/>";
							if(searchtitle($jobtitle, $length,$title)==true &&$state==$location&&testdate($date) == true)
							{
								form($data);
							}
							else 
							{
								$fail .="fail";
							}
						}
						if (!empty($fail))
						{
							echo "The location: $location is not found in the rest or all the system.<br/>";
						}
						fclose($handle);
					}
					
					
					
					//to search position and contract
					if ($poschose!="---"&&$contract!="---"&&$app=="---"&&$location=="---")
					{
						while(!feof($handle))
						{
							$line = fgets($handle);
							$data = explode("\t",$line);
							//this area is where the data from the textfile is temporary stored
							$jobtitle = $data[1];
							$des = $data[2];
							$datacontact = $data[6];
							$date = $data[3];
							$position = $data[4];
							if(($poschose==$position)&& (searchtitle($jobtitle,$length,$title)==true)&&(testdate($date) == true)&&$datacontact==$contract)
							{
								form ($data);
							}
							else 
							{
							$fail .="fail";
							}
							if(strpos($jobtitle,$title)==false)
							{
								$fail.="fail ";
							}
						}
						if ($fail != "")
						{
							echo "These data: $title, $contract and $poschose is not found in the rest or all the system.<br/>";
						}
						fclose($handle);
					}
					
					//to test contract and app
					if($poschose=="---"&&$contract!="---"&&$app!="---"&&$location=="---")
					{
						while (!feof($handle))
						{
							$line = fgets($handle);
							$data = explode("\t",$line);
							$datacontact = $data[6];
							$date = $data[3];
							$jobtitle = $data[1];
							//this is to check which application is selected
							$applyby = $data[5];		
							$apps = explode(", ",$applyby);
							$appdata="";
							$post = $apps[0];
							$email = $apps[1];
							$appdata = appdata($post,$email);
							$bothapp="";
							$app1="";
							$app2="";
							if($app=="Post, Email")
							{
								$apply =explode(", ", $app);
								$app1=$apply[0];
								$app2=$apply[1];
							}
							else
							if($app=="Post"||$app=="Email")
							{
								$bothapp = "Post, Email";
							}
							if (searchtitle($jobtitle, $length,$title)==true &&$datacontact==$contract&&testdate($date) == true&&(appsearch($appdata, $app, $bothapp, $app1, $app2)==true))
							{
								form($data);
							}
							else 
							{
								$fail .="fail";
							}
							
						}
					
						if (!empty($fail))
						{
							echo "There is no more $contract contract found in the rest or all the system.<br/>";
						}
						fclose($handle);
					}
					
					//to search position and app
					if ($poschose!="---"&&$contract=="---"&&$app!="---"&&$location=="---")
					{
						while(!feof($handle))
						{
							$line = fgets($handle);
							$data = explode("\t",$line);
							//this area is where the data from the textfile is temporary stored
							$jobtitle = $data[1];
							$date = $data[3];
							$position = $data[4];
							//this is to check which application is selected
							$applyby = $data[5];		
							$apps = explode(", ",$applyby);
							$appdata="";
							$post = $apps[0];
							$email = $apps[1];
							$appdata = appdata($post,$email);
							$bothapp="";
							$app1="";
							$app2="";
							if($app=="Post, Email")
							{
								$apply =explode(", ", $app);
								$app1=$apply[0];
								$app2=$apply[1];
							}
							else
							if($app=="Post"||$app=="Email")
							{
								$bothapp = "Post, Email";
							}
							if(($poschose==$position)&& (searchtitle($jobtitle,$length,$title)==true)&&(testdate($date) == true)&&(appsearch($appdata, $app, $bothapp, $app1, $app2)==true))
							{
								form ($data);
							}
							else 
							{
							$fail .="fail";
							}
							if(strpos($jobtitle,$title)==false)
							{
								$fail.="fail ";
							}
						}
						if ($fail != "")
						{
							echo "These data: $title, $poschose and $app is not found in the rest or all the system.<br/>";
						}
						fclose($handle);
					}
					
					//this it to search contract and location
					if($poschose=="---"&&$contract!="---"&&$app=="---"&&$location!="---")
					{
						while (!feof($handle))
						{
							$line = fgets($handle);
							$data = explode("\t",$line);
							$datacontact = $data[6];
							$date = $data[3];
							$jobtitle = $data[1];
							$state = $data[7];							
							$state = str_replace(PHP_EOL,'',$state);
							if (searchtitle($jobtitle, $length,$title)==true &&$datacontact==$contract&&testdate($date) == true&&$state==$location)
							{
								form($data);
							}
							else 
							{
								$fail .="fail";
							}
							
						}
					
						if (!empty($fail))
						{
							echo "There is no more $contract contract found in the rest or all the system.<br/>";
						}
						fclose($handle);
					}

					//to search position contract and app
					if ($poschose!="---"&&$contract!="---"&&$app!="---"&&$location=="---")
					{
						while(!feof($handle))
						{
							$line = fgets($handle);
							$data = explode("\t",$line);
							//this area is where the data from the textfile is temporary stored
							$jobtitle = $data[1];
							$des = $data[2];
							$datacontact = $data[6];
							$date = $data[3];
							$position = $data[4];
							//this is to check which application is selected
							$applyby = $data[5];		
							$apps = explode(", ",$applyby);
							$appdata="";
							$post = $apps[0];
							$email = $apps[1];
							$appdata = appdata($post,$email);
							$bothapp="";
							$app1="";
							$app2="";
							if($app=="Post, Email")
							{
								$apply =explode(", ", $app);
								$app1=$apply[0];
								$app2=$apply[1];
							}
							else
							if($app=="Post"||$app=="Email")
							{
								$bothapp = "Post, Email";
							}
							if(($poschose==$position)&& (searchtitle($jobtitle,$length,$title)==true)&&
							   (testdate($date) == true)&&
							   $datacontact==$contract&&
							   (appsearch($appdata, $app, $bothapp, $app1, $app2)==true))
							{
								form ($data);
							}
							else 
							{
							$fail .="fail";
							}
							if(strpos($jobtitle,$title)==false)
							{
								$fail.="fail ";
							}
						}
						if ($fail != "")
						{
							echo "These data: $title, $contract, $poschose and $app is not found in the rest or all the system.<br/>";
						}
						fclose($handle);
					}
					
					//this is to search application and location
					if($poschose=="---"&&$contract=="---"&&$app!="---"&&$location!="---")
					{
						while (!feof($handle))
						{
							$line = fgets($handle);
							$data = explode("\t",$line);
							$date = $data[3];
							$jobtitle = $data[1];
							//this is to check which application is selected
							$applyby = $data[5];		
							$apps = explode(", ",$applyby);
							$appdata="";
							$post = $apps[0];
							$email = $apps[1];
							$appdata = appdata($post,$email);
							$state = $data[7];							
							$state = str_replace(PHP_EOL,'',$state);
							$bothapp="";
							$app1="";
							$app2="";
							if($app=="Post, Email")
							{
								$apply =explode(", ", $app);
								$app1=$apply[0];
								$app2=$apply[1];
							}
							else
							if($app=="Post"||$app=="Email")
							{
								$bothapp = "Post, Email";
							}
							if(searchtitle($jobtitle, $length,$title)==true &&(appsearch($appdata, $app, $bothapp, $app1, $app2)==true)&&testdate($date) == true&&testdate($date) == true&&$state==$location)
							{
								form($data);
							} 
							
							else 
							{
								$fail .="fail";
							}
						}
						if (!empty($fail))
						{
							echo "There is no more $appdata jobs found in the rest or all the system.<br/>";
						}
						fclose($handle);
					}
										
					//to search position and location
					if ($poschose!="---"&&$contract=="---"&&$app=="---"&&$location!="---")
					{
						while(!feof($handle))
						{
							$line = fgets($handle);
							$data = explode("\t",$line);
							//this area is where the data from the textfile is temporary stored
							$jobtitle = $data[1];
							$des = $data[2];
							$date = $data[3];
							$position = $data[4];
							$state = $data[7];
							$state = str_replace(PHP_EOL,'',$state);
							if(($poschose==$position)&& (searchtitle($jobtitle,$length,$title)==true)&&
							   (testdate($date) == true)&&($state==$location)
							  )
							{
								form ($data);
							}
							else 
							{
							$fail .="fail";
							}
							if(strpos($jobtitle,$title)==false)
							{
								$fail.="fail ";
							}
						}
						if ($fail != "")
						{
							echo "These data: $title, $location and $poschose is not found in the rest or all the system.<br/>";
						}
						fclose($handle);
					}
					
					//to search position and location and app
					if ($poschose!="---"&&$contract=="---"&&$app!="---"&&$location!="---")
					{
						while(!feof($handle))
						{
							$line = fgets($handle);
							$data = explode("\t",$line);
							//this area is where the data from the textfile is temporary stored
							$jobtitle = $data[1];
							$des = $data[2];
							$date = $data[3];
							$position = $data[4];
							$state = $data[7];
							$state = str_replace(PHP_EOL,'',$state);
							//this is to check which application is selected
							$applyby = $data[5];		
							$apps = explode(", ",$applyby);
							$appdata="";
							$post = $apps[0];
							$email = $apps[1];
							$appdata = appdata($post,$email);
							$bothapp="";
							$app1="";
							$app2="";
							if($app=="Post, Email")
							{
								$apply =explode(", ", $app);
								$app1=$apply[0];
								$app2=$apply[1];
							}
							else
							if($app=="Post"||$app=="Email")
							{
								$bothapp = "Post, Email";
							}
							if(($poschose==$position)&& (searchtitle($jobtitle,$length,$title)==true)&&
							   (testdate($date) == true)&&
							   ($state==$location)&&							   ((appsearch($appdata, $app, $bothapp, $app1, $app2)==true)&&testdate($date)==true)
							  )
							{
								form ($data);
							}
							else 
							{
							$fail .="fail";
							}
							if(strpos($jobtitle,$title)==false)
							{
								$fail.="fail ";
							}
						}
						if ($fail != "")
						{
							echo "These data: $title, $app, $location and $poschose is not found in the rest or all the system.<br/>";
						}
						fclose($handle);
					}
					
					//to position and contract and location
					if ($poschose!="---"&&$contract!="---"&&$app=="---"&&$location!="---")
					{
						while(!feof($handle))
						{
							$line = fgets($handle);
							$data = explode("\t",$line);
							//this area is where the data from the textfile is temporary stored
							$jobtitle = $data[1];
							$des = $data[2];
							$datacontact = $data[6];
							$state = $data[7];
							$state = str_replace(PHP_EOL,'',$state);
							$date = $data[3];
							$position = $data[4];
							if(($poschose==$position)&& (searchtitle($jobtitle,$length,$title)==true)&&(testdate($date) == true)&&$datacontact==$contract&&$state==$location)
							{
								form ($data);
							}
							else 
							{
							$fail .="fail";
							}
							if(strpos($jobtitle,$title)==false)
							{
								$fail.="fail ";
							}
						}
						if ($fail != "")
						{
							echo "These data: $title, $contract and $poschose is not found in the rest or all the system.<br/>";
						}
						fclose($handle);
					}
					
					//to search by contract and app and location
					if($poschose=="---"&&$contract!="---"&&$app!="---"&&$location!="---")
					{
						while (!feof($handle))
						{
							$line = fgets($handle);
							$data = explode("\t",$line);
							$datacontact = $data[6];
							$date = $data[3];
							$jobtitle = $data[1];
							//this is to check which application is selected
							$applyby = $data[5];		
							$apps = explode(", ",$applyby);
							$appdata="";
							$post = $apps[0];
							$email = $apps[1];
							$appdata = appdata($post,$email);
							$bothapp="";
							$state = $data[7];							
							$state = str_replace(PHP_EOL,'',$state);
							$app1="";
							$app2="";
							if($app=="Post, Email")
							{
								$apply =explode(", ", $app);
								$app1=$apply[0];
								$app2=$apply[1];
							}
							else
							if($app=="Post"||$app=="Email")
							{
								$bothapp = "Post, Email";
							}
							if (searchtitle($jobtitle, $length,$title)==true &&$datacontact==$contract&&testdate($date) == true&&(appsearch($appdata, $app, $bothapp, $app1, $app2)==true)&&$state==$location)
							{
								form($data);
							}
							else 
							{
								$fail .="fail";
							}
							
						}
					
						if (!empty($fail))
						{
							echo "There is no more $contract contract found in the rest or all the system.<br/>";
						}
						fclose($handle);
					}
					
					//to search position and contract and app and location
					if ($poschose!="---"&&$contract!="---"&&$app!="---"&&$location!="---")
					{
						while(!feof($handle))
						{
							$line = fgets($handle);
							$data = explode("\t",$line);
							//this area is where the data from the textfile is temporary stored
							$jobtitle = $data[1];
							$des = $data[2];
							$datacontact = $data[6];
							$date = $data[3];
							$position = $data[4];
							//this is to check which application is selected
							$applyby = $data[5];		
							$apps = explode(", ",$applyby);
							$appdata="";
							$post = $apps[0];
							$email = $apps[1];
							$appdata = appdata($post,$email);
							$state = $data[7];
							$state = str_replace(PHP_EOL,'',$state);
							$bothapp="";
							$app1="";
							$app2="";
							if($app=="Post, Email")
							{
								$apply =explode(", ", $app);
								$app1=$apply[0];
								$app2=$apply[1];
							}
							else
							if($app=="Post"||$app=="Email")
							{
								$bothapp = "Post, Email";
							}
							if(($poschose==$position)&&( $state==$location)&& (searchtitle($jobtitle,$length,$title)==true)&&(testdate($date) == true)&&($datacontact==$contract)&&(appsearch($appdata, $app, $bothapp, $app1, $app2)==true))
							{
								form ($data);
							}
							else 
							{
							$fail .="fail";
							}
							if(strpos($jobtitle,$title)==false)
							{
								$fail.="fail ";
							}
						}
						if ($fail != "")
						{
							echo "These data: $title, $contract and $poschose is not found in the rest or all the system.<br/>";
						}
						fclose($handle);
					}
									

				
					
				}
			}
			else
			{
				echo "<p>The file is not created, please wait or go to make a job vacancy post</p>";
			}
		} 
		else 
		{
			echo "<p>Please go to </p>";
		}
		?>
		<p id="search">
			<a href='searchjobform.php'>Search for another job vacancy</a>
		</p>
		<p>
			<a href='index.php'>Return to Home Page</a>
		</p>
	</div>
	</main>
	<footer>
		<?php include("includes/footer.inc")?>
	</footer>
</body>
</html>