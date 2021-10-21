<?php 
	//database connection
	$con = mysqli_connect("localhost", "root", "", "mytechlearn");

	$counter = mysqli_real_escape_string($con, stripslashes(trim($_POST['row-counter'])));
	$name_counter = mysqli_real_escape_string($con, stripslashes(trim($_POST['row-name-counter'])));

	for ($i=1; $i <= $name_counter; $i++)
 	{
 
 		if($_POST['name'.$i])
 		{
			$name = mysqli_real_escape_string($con, stripslashes(trim($_POST['name'.$i])));
				
	    	$insert_into_database = "INSERT INTO `dynamically_insert_data_insert` 
                         ( 
                          `name`
                         ) 
                    VALUES 
                         ( 
                          '$name'
                         )";

		    mysqli_query($con, $insert_into_database) or die(mysqli_error($con));
		    
		    if(mysqli_affected_rows($con) <> 1)
		    {
		        $result = "Data Not Insert";
		        exit();
		    }
		    else
		    {
		    	$result = "Data Insert Successfully";
		    	
		    }
			
		}
	}

	echo $result;

?>