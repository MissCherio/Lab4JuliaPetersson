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
			<h2>My Books</h2>



			<h3>Search our Book Catalog</h3>

				<form action="MyBooks.php" method="POST">
					<input type="search" name="searchtitle" placeholder="Title">
					<input type="search" name="searchauthor" placeholder="Author">
					<input class="searchButton" type="submit" name="" value="Search">

				</form>
             


<?php
# This is the mysqli version

$searchtitle = "";
$searchauthor = "";

if (isset($_POST) && !empty($_POST)) {
# Get data from form
    $searchtitle = trim($_POST['searchtitle']);
    $searchauthor = trim($_POST['searchauthor']);
}

//	if (!$searchtitle && !$searchauthor) {
//	  echo "You must specify either a title or an author";
//	  exit();
//	}

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

$query = " select Title, Author, Reserved, BookID from books where Reserved is true";
if ($searchtitle && !$searchauthor) { // Title search only
    $query = $query . " and title like '%" . $searchtitle . "%'";
}
if (!$searchtitle && $searchauthor) { // Author search only
    $query = $query . " and author like '%" . $searchauthor . "%'";
}
if ($searchtitle && $searchauthor) { // Title and Author search
    $query = $query . " and title like '%" . $searchtitle . "%' and author like '%" . $searchauthor . "%'"; // unfinished
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
    $stmt->bind_result($Title, $Author, $Reserved, $BookID);
    $stmt->execute();
    
//    $stmt2 = $db->prepare("update onloan set 0 where bookid like ". $bookid);
//    $stmt2->bind_result($onloan, $bookid);
    

    echo '<table cellpadding="6">';
    echo '<tr><b><td>BookID</td><b> <td>Title</td> <td>Author</td> <td>Reserved?</td> </b> <td></td> </b></tr>';
    while ($stmt->fetch()) {
        if($Reserved==1)
            $Reserved="Yes";
       
        echo "<tr>";
        echo "<td> $BookID </td><td> $Title </td><td> $Author </td><td> $Reserved </td>";
        echo '<td><a href="returnBook.php?bookid=' . urlencode($BookID) . '">Return</a></td>';
        echo "</tr>";
        
    }
    echo "</table>";
    ?>


			</div>
			<?php include("footer.php");?>
		</div>
	</body>
</html>