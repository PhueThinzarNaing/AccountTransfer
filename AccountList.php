<!doctype html>
<html>
<head>
<style>
 
</style>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<?php include "AccountMenu.php" ?>

<h2  style='margin-left:20px;'>Account Information List</h2>
<body>
<?php 

    $myfile = fopen("accData.txt", "r");

    echo "<table style='width:50%;border-collapse: collapse;margin-left:20px;'>";
    echo "<tr>";
    echo "<td style='border:2px solid'>AccountName</td>";
    echo "<td style='border:2px solid'>AccountBalance</td>";
    
    
    echo "</tr>";

    while(!feof($myfile)) {
        $newAcc=fgets($myfile);
        if($newAcc!=""){
            $obj=json_decode($newAcc,true);
            echo "<tr>";
            $a=array_walk($obj,"myfunction");
            
            echo "</tr>";
        }
    }
    fclose($myfile);
    echo "</table>";
    
    function myfunction($value,$key)

            {             
              
                echo "<td style='border:2px solid'>".$value."</td>";
            }

?>
</body>
</html>