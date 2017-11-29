<!DOCTYPE html>
<html>
	<head>
		<title>Log in</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="index.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300i,700" rel="stylesheet">
		<?php include("config.php");?>
	</head>
	<body>
		<div id="pagecontainer">
			
			<?php include("header.php");?>

			
			<div id="content"> 
				<h2 id="search">Log in</h2>
				<div>
					<?php  
					@ $db = new mysqli('localhost', 'root', 'root', 'testinguser');

					if ($db->connect_error) {
					    echo "could not connect: " . $db->connect_error;
					    printf("<br><a href=index.php>Return to home page </a>");
					    exit();
					}

					if (isset($_POST['username'], $_POST['userpass'])) {
		
					    $uname = mysqli_real_escape_string($db, $_POST['username']);
					    $uname = $_POST['username'];
					   	$upass = sha1($_POST['userpass']);
				
					    
					  

					    
					    $query = ("SELECT * FROM user WHERE username = '{$uname}' "."AND userpass = '{$upass}'");
					       
					    
					    $stmt = $db->prepare($query);
					    $stmt->execute();
					    $stmt->store_result(); 
					    
					    $totalcount = $stmt->num_rows();
					    
					    
					    
					}

					        if (isset($totalcount)) {
					            if ($totalcount == 0) {
					                echo "<p>You got it wrong. Can\'t break in here!</p>";
					            } else {
					                echo "<p>Correct password, welcome!</p>";
					                printf("<br><br><a  href=fileUpload.php class=upload>Upload an image here! </a>");
					               
									


					            }
					        }
					        ?>
					        <form id="loggain" method="POST" action="">
					            <input type="text" name="username" >
					            <input type="password" name="userpass">
					            <input class="upload" type="submit" value="Go" onClick="clearform();">
					        </form>

					    </body>
					</html>









				</div>

            

			</div>
			<?php include("footer.php");?>
		</div>
	</body>
</html>