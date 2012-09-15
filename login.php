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
	
	if ($POST['Log in']==true){
	  $email=$_POST["email"];
	  $pwd=$_POST["password"];
	  $sql="SELECT * FROM user 
	        WHERE Email='$email'";
	  $record=mysql_query($sql);
	  
	  if (mysql_num_rows($record)>0){
	     $array=mysql_fetch_array($record);
		 $pwdb=$array["password"];
		
        //varify if the password that user's input 
		//matches the password that stored in database
		if($pwd==$pwdb){
		   $_SESSION['email']=$email;//save the email in session for other useages
		   header("location:index.html");//go to index.html when login successfully
		}
        else {
		   echo "<script> alert('Login failed!Wrong password!');</script>";
		}		
	  }
	  else {
	     echo "<script> alert('Login failed!Non-exist user!');</script>";
	  }
	}
?>