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
			<h2 id="search">Search</h2>
			

            <form action="Search.php" method="POST">
				<input type="search" name="searchtitle" placeholder="Title">
				<input type="search" name="searchauthor" placeholder="Author">
				<input class="searchButton" type="submit" name="" value="Search">

			</form>

			<div id="boklista">
			<?php
                # This is the mysqli version

                $searchtitle = "";
                $searchauthor = "";

                if (isset($_POST) && !empty($_POST)) {
                # Get data from form
                    $searchtitle= htmlentities($searchtitle);
                $searchtitle = mysqli_real_escape_string($db, $searchtitle);

                 $searchauthor= htmlentities($searchauthor);
                $searchauthor = mysqli_real_escape_string($db, $searchauthor);
                    
                    $searchtitle = trim($_POST['searchtitle']);
                    $searchauthor = trim($_POST['searchauthor']);
                }

                //  if (!$searchtitle && !$searchauthor) {
                //    echo "You must specify either a title or an author";
                //    exit();
                //  }



                $searchtitle = addslashes($searchtitle);
                $searchauthor = addslashes($searchauthor);

                # Open the database
                @ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

                if ($db->connect_error) {
                    echo "could not connect: " . $db->connect_error;
                    printf("<br><a href=index.php>Return to home page </a>");
                    exit();
                }

                # Build the query. Users are allowed to search on title, author, or both

                $query = " select * from books";
                if ($searchtitle && !$searchauthor) { // Title search only
                    $query = $query . " where title like '%" . $searchtitle . "%'";
                }
                if (!$searchtitle && $searchauthor) { // Author search only
                    $query = $query . " where author like '%" . $searchauthor . "%'";
                }
                if ($searchtitle && $searchauthor) { // Title and Author search
                    $query = $query . " where title like '%" . $searchtitle . "%' and author like '%" . $searchauthor . "%'"; // unfinished
                }

                //echo "Running the query: $query <br/>"; # For debugging


                  # Here's the query using an associative array for the results
                //$result = $db->query($query);
                //echo "<p> $result->num_rows matching books found </p>";
                //echo "<table border=1>";
                //while($row = $result->fetch_assoc()) {
                //echo "<tr><td>" . $row['bookid'] . "</td> <td>" . $row['title'] . "</td><td>" . $row['author'] . "</td></tr>";
                //}
                //echo "</table>";
                 

                # Here's the query using bound result parameters
                    // echo "we are now using bound result parameters <br/>";
                    $stmt = $db->prepare($query);
                    $stmt->bind_result($Author, $Title, $BookID, $Reserved);
                    $stmt->execute();

                    echo '<table cellpadding="6">';
                    echo '<tr><b><td>BookID</td><td>Title</td> <td>Author</td> <td>Reserved?</td><td></td> </b> </tr>';
                    while ($stmt->fetch()) {
                        if($Reserved==1)
                            $Reserved="Yes";
                        else $Reserved ="No";

                       
                        echo "<tr>";
                        echo "<td> $BookID </td><td> $Title </td><td> $Author </td><td> $Reserved </td>";

                        echo '<td><a href="reserveBook.php?bookid=' . urlencode($BookID) . '"> Reserve </a></td>';
                        echo "</tr>";
                    }
                    echo "</table>";


            ?>
            </div>

			</div>
			<?php include("footer.php");?>
		</div>
	</body>
</html>