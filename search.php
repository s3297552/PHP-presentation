<?php
 
    session_start();
    
	//connect to database
    define('$db_host', 'yallara.cs.rmit.edu.au');
    define('$db_port', '50644'); 
    define('$db_name', 'hunter');
    define('$db_username', 'hunter'); 
    define('$db_password', 'hunter');
	
	$db = null;
    try {
        $db = new PDO("mysql:host=" . db_host . ";port=" . db_port . ";dbname=" . db_name, db_username, db_password);
    } catch(DBOException $e) {
        echo $e->getMessage();
        exit;
    }
	
	function searchTitle($keyword,$sql,$result,$num){ 
	//check whether the user's input matches the result in database
	if ($_POST['search']==true){
	    $keyword=$_POST["keyword"];
		$sql="SELECT * FROM news 
		      WHERE news.CATEGORY_ID=category.ID
			  AND news.title LIKE '%$keyword'%";
		$result=mysql_query($sql);
		$num=mysql_num_rows($result);
		
		for($i=0;$i<$num;$i++){
		  $record=mysql_fetch_array($result);
		  echo $record[name]."<br>";
		}
		
		else{
		   echo "<script> alert('Sorry! No fecthed news!');</script>";
		}
	}
}
   // Show all news in a category in a <table>
    function displayNewsList($query, $categoryTitle) {
    // Run the query on the server
    if (!($result = @ mysql_query ($query))) {
      showerror();
    }
    // Find out how many rows are available
    $rowsFound = @ mysql_num_rows($result);
    // If the query has results ...
    if ($rowsFound > 0) {
      // ... print out a header
      print "news of $categoryTitle<br>";

      // and start a <table>.
      print "\n<table>\n<tr>" .
          "\n\t<th>Category ID</th>" .
          "\n\t<th>Category Title</th>" .
		  "\n\t<th>Parent ID</th>" .
          "\n\t<th>Description</th>\n</tr>";

      // Fetch each of the query rows
      while ($row = @ mysql_fetch_array($result)) {
        // Print one row of results
        print "\n<tr>\n\t<td>{$row["ID"]}</td>" .
            "\n\t<td>{$row["TITLE"]}</td>" .
            "\n\t<td>{$row["PARENT_ID"]}</td>" .
            "\n\t<td>{$row["DESCRIPTION"]}</td>\n</tr>";
      } // end while loop body

      // Finish the <table>
      print "\n</table>";
    } // end if $rowsFound body

    // Report how many rows were found
    print "{$rowsFound} records found matching your criteria<br>";
  } // end of function

  // get the user data
  $categoryTitle = $_GET['categoryTitle'];

 // Start a query ...
  $query = "SELECT ID, TITLE, DESCRIPTION
            FROM news,category
            WHERE news.CATEGORY_ID = category.ID";

  // ... then, if the user has specified a category, add the categoryTitle
  // as an AND clause ...
  if (isset($categoryTitle) && $categoryTitle != "All") {
    $query .= " AND category.TITLE = '{$categoryTitle}'";
  }

  // ... and then complete the query.
  $query .= " ORDER BY category.TITLE";

  // run the query and show the results
  displayNewsList($query, $categoryTitle);
?>