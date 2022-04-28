<!doctype html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<meta name="Description" content="Assignment 1: About Page"/>
	<meta name="Keywords" content="Web,programming,assignment" />
	<link rel="stylesheet" href="style/style.css"/>
		<link rel="icon" href="images/logo.png"/>
<title>About Page</title>
</head>

<body>
	<header>
		<?php include("includes/header.inc")?>
	</header>
	<main>
		<div id="intro">
			<h1>About Page</h1>
			<p>Name: CC<br/>
			Student ID: 103076376
			<br/>Email: 
				<a href="mailto:103076376@student.vic.edu.au">103076376@student.swin.edu.au</a>
			</p>
			<h2>
				<?php echo "Q&A";?>
			</h2>
			<ul>
				<li>
					<h4>What is the PHP version installed in Mercury?</h4>
				</li>
				<ul>
					<li>PHP Version: <?php echo phpversion();?></li>
				</ul>
				<li>
					<h4>What tasks have you completed?</h4>
				</li>
				<ul>
					<li>Task 1: Home Page : Completed</li>
					<li>Task 2: Post Job Vanacy Page : Completed</li>
					<li>Task 3: Proccess Post Job Vacany Page : Completed</li>
					<li>Task 4: Search Job Vacancy Page : Completed</li>
					<li>Task 5: Search Job Vacancy Result Page : Completed</li>
					<li>Task 6: About Page : Not so completed</li>
					<li>Task 7: Search Job Vacancy Page : Completed</li>
					<ul>
						<li>Completed:</li>
						<ul>
							<li>By Position</li>
							<li>By Contract</li>
							<li>By application type</li>
							<li>By location</li>
							<li>Allow no criteria</li>
						</ul>
						
					</ul>
					<li>Task 8: Search Job Vacancy result Page : Completed</li>
					<ul>
						<li>Completed:</li>
						<ul>
							<li>Display only those job vacancies that had not close today</li>
							<li>Properly sort the result</li>
						</ul>
					</ul>
				</ul>
				<li>
					<h4>What special features have you done, or attempted, inc reating the site thta we should know about?</h4>
				</li>
				<ul>
					<li>N/A</li>
				</ul>
				<li>
					<h4>What sites have you used to assist in this assignment?</h4>
				</li>
				<ul>
					<li>To help me fix some issues when trying to search things which is end of the line, in this case State in searchjobproccess.php</li>
					<ul>
					<li><a href="https://phppot.com/php/php-line-breaks/">https://phppot.com/php/php-line-breaks/</a></li>
					</ul>
					<li>To learn more about usort method. used in searchjobproccess.php to help sort items</li>
					<ul>
					<li><a href="https://www.php.net/manual/en/function.usort.php">https://www.php.net/manual/en/function.usort.php</a></li>
					</ul>
					<li>This is used to find a way to have the dates data to be easily grabbed since it is in a unique layout</li>
					<ul>
					<li><a href="https://www.geeksforgeeks.org/php-datetime-createfromformat-function/">https://www.geeksforgeeks.org/php-datetime-createfromformat-function/</a></li>
					</ul>
					
				</ul>
			</ul>
			
			<h4>What discussion point did you participated on the unit's discussion board for Assignmenet 1?</h4>
			<img src="images/Assign1Screenshot.png" alt="A Discussion on CSS" width= "800">
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