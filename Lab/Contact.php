<!DOCTYPE html>
<html>
	<head>
		<title>Homepage</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="index.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300i,700" rel="stylesheet">
		<?php include("config.php");?>
	</head>
	<body>
		<div id="pagecontainer">
			<?php include("header.php");?>

			
			<div id="content"> 
			<h2>Contact Us</h2>
				<div class="container">
				  <form action="/action_page.php">

				    <label for="fname">First Name</label><br>
				    <input type="text" id="fname" name="firstname" placeholder="Your name.."><br>

				    <label for="lname">Last Name</label><br>
				    <input type="text" id="lname" name="lastname" placeholder="Your last name.."><br>
				   

				    <label for="subject">Subject</label><br>
				    <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea><br>

				    <input type="submit" value="Submit">

				  </form>
				</div>

			</div>
			<?php include("footer.php");?>
		</div>
	</body>
</html>