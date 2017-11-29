<!DOCTYPE html>
<html>
	<head>
		<title>Gallery</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="index.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300i,700" rel="stylesheet">
		<?php include("config.php");?>
	</head>
	<body>
		<div id="pagecontainer">
			<?php include("header.php");?>

			
			<div id="content"> 
				<h2 id="search">Gallery</h2>
				<div>
					<?php

					//https://stackoverflow.com/questions/11903289/pull-all-images-from-a-specified-directory-and-then-display-them
					
					$files = glob("uploadedfiles/*.*");
					for ($i = 0; $i < count($files); $i++) {
					    $image = $files[$i];
					     
					    echo '<img src="' . $image . '" alt="Random image" class="galleryImage" />' . "<br /><br />";

					}
					?>


				</div>

            

			</div>
			<?php include("footer.php");?>
		</div>
	</body>
</html>