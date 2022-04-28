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
	<header><?php include("includes/header.inc")?></header>
<main><div id="intro">
	<h1>Job Vacancy Posting System</h1>
	<form action="searchjobproccess.php" method="get">
		<p>
			<label for="jobTitle">Job Title:</label><input type="text" name="jobTitle" id="jobTitle">
		</p>
		<p>
			<label for="position">Position:</label>
			<select name="position" id="position">
				<option value="---">Please Select</option>
				<option value="Part Time">Part Time</option>
				<option value="Full Time">Full Time</option>
			</select>
		</p>
		<p>
			<label for="contract">Contract:</label>
			<select name="contract" id="contract">
				<option value="---">Please Select</option>
				<option value="On-Going Term">On-Going Term</option>
				<option value="Fixed Term">Fixed Term</option>
			</select>
		</p>
		<p>
			<label for="app">Application By:</label>
			<select name="app" id="app">
				<option value="---">Please Select</option>
				<option value="Post">Post</option>
				<option value="Email">Email</option>
				<option value="Post, Email">Both Email and Post</option>
			</select>
		</p>
			<p>
				<label for="State">Location:
				</label>
				<select name="State" id="State">
					<option selected="selected" value="---">---</option>
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
		<p>
			<button type="submit" name="submit" id="submit">Submit</button>
		</p>
	</form>
	<h6>All fields are required. <a href="index.php">Return to Home Page</a></h6>
	</div></main>
	<footer><?php include("includes/footer.inc")?></footer>
</body>
</html>