
<?php

include("config.php");

$BookID = trim($_GET['bookid']);
echo '<INPUT type="hidden" name="bookid" value=' . $BookID . '>';

$BookID = trim($_GET['bookid']);      // From the hidden field
$BookID = addslashes($BookID);

@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

    if ($db->connect_error) {
        echo "could not connect: " . $db->connect_error;
        printf("<br><a href=index.php>Return to home page </a>");
        exit();
    }
    
   echo $BookID;

    // Prepare an update statement and execute it
    $stmt = $db->prepare("UPDATE Books SET Reserved=0 WHERE BookID = ?");
    $stmt->bind_param('i', $BookID);
    $stmt->execute();
    printf("<br>Succesfully returned!");
    printf("<br><a href=Search.php>Search and Book more Books </a>");
    printf("<br><a href=MyBooks.php>Return to My Books </a>");
    printf("<br><a href=index.php>Return to home page </a>");
    exit;

?>

    


