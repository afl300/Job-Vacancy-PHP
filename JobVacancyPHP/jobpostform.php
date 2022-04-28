<!doctype html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<meta name="Description" content="Assignment 1: postjob"/>
	<meta name="Keywords" content="Web,programming,assignment" />
	<link rel="stylesheet" href="style/style.css"/>
	<link rel="icon" href="images/logo.png"/>
<title>Post Job</title>

</head>

<body>
	<header>
		<?php include("includes/header.inc")?>
	</header>
<main>
	<div id="intro">
		<h1>Job Vacancy Posting System</h1>
		<form action="postjobproccess.php" method="post">
			<p>
				<label for="PID">Position ID:</label>
				<input type="text" name="PID" id="PID" placeholder="P0000">
			</p>
			<p>
				<label for="title">Title:</label>
				<input type="text" name="title" id="title">
			</p>
			<p>
				<label for="descript">Description:</label>
				<br/>
				<textarea name="descript" id="descript" rows = "4" cols="25" placeholder="Please enter the description of this job" maxlength="260"></textarea>
			</p>
			<p>
				<label for="close">Closing Date:</label>
				<input type="text" name="close" id="close" placeholder="dd/mm/yy" value="<?php echo date('d/m/y');?>">
			</p>
			<p>Position:
				<label>
					<input name="position" type="radio" value="Part Time" checked="checked">Part Time
				</label>
				<label>
					<input type="radio" name="position" value="Full Time">
					Full Time
				</label>
			</p>
			<p>Contract:
				<label>
					<input name="contract" type="radio" value="On-Going Term" checked="checked">On-going
				</label>
				<label>
					<input type="radio" name="contract" value="Fixed Term">Fixed Term
				</label>
			</p>
			<p>Application by:
				<label>
					<input type="checkbox" name="applyMethodpost" value="Post">Post
				</label>
				<label>
					<input type="checkbox" name="applyMethodMail" value="Email">Email
				</label>
			</p>
			<p>
				<label for="State">Location:
				</label>
				<select name="State" id="State">
					<option selected="selected">---</option>
					<option value="VIC">VIC</option>
					<option value="NSW">NSW</option>
					<option value="QLD">QLD</option>
					<option value="NT">NT</option>
					<option value="WA">WA</option>
					<option value="SA">SA</option>
					<option value="TAS">TAS</option>
					<option value="ACT">ACT</option>
				</select>
			</p>
			<button type="submit">Post</button>
			<button type="reset">Reset</button>
			<h6>All fields are required. 
				<a href="index.php">Return to Home Page
				</a>
			</h6>
		</form>
	</div>
	</main>
	<footer>
		<?php include("includes/footer.inc")?>
	</footer>
</body>
</html>