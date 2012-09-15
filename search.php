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
   function searchCatagory($category,$sql,$result,$num){
   $category=$_GET["category"];
   if ($category != 1){
       $sql="SELECT * FROM category
	         WHERE catagory.ID=$category";
	   $result=mysql_query($sql);
	   $num=mysql_num_rows($result);
	   
		for($i=0;$i<$num;$i++){
		  $record=mysql_fetch_array($result);
		  echo $record[name]."<br>";
		}
   }
}
?>