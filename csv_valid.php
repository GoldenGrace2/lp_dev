<?php

require 'config.inc.php';

$bdd = connexionBD();

 if(isset($_POST["Import"])){
    $row = 1;

    $filename=$_FILES["file"]["tmp_name"];    
     if($_FILES["file"]["size"] > 0)
     {
        $file = fopen($filename, "r");
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			$num = count($data);
			echo "<p> $num fields in line $row: <br /></p>\n";
			$row++;
			for ($c=0; $c < $num; $c++) {
				echo $data[$c] . "<br />\n";
			}
		}
		fclose($handle);
           fclose($file);  
     }
  }   
 ?>