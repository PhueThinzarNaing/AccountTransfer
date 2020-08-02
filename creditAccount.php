<!doctype html>
<html>
<head>
<style>
input[type=text] {
            padding: 10px 10px;
            width:20%;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-left:20px;
        }
        input[type=submit],input[type=button]  {
          
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-left:20px;
        }
</style>
</head>
<body>

<div>
<?php include "AccountMenu.php" ?>
</div><br><br>
<h2 style='margin-left:20px;'>Create New Account</h2>
<div >
<form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            
<div class="form-group"> 
    <label for="fAccount" style='margin-left:20px;'>Account</label><br>
    <select class="form-control" name="aname"  style="width:20%;height:70%;padding:10px 10px;margin-left:20px;">
        <option selected="selected">Select choose</option>
        <?php
            $myfile = fopen("accData.txt", "r");
            
                            
            while(!feof($myfile)) {
                $newAcc=fgets($myfile);
                if($newAcc!=""){
                    $obj=json_decode($newAcc,true);
                   
                    
                    ?>
                    <option><?php echo $obj["name"]; ?></option>
                  
                        <?php
                        }

                       
                         }
                         fclose($myfile);

                        ?>

    
    </select>
</div><br>

            <label for="amount" style='margin-left:20px;'>Amount :</label><br>
            <input type="text" id="balance" name="amt" placeholder=" Enter Your Amount.." style="width:20%;padding:10px 10px";><br><br>


<input type="submit" name="credit" value="Credit">
<input type="submit" name="debit" value="debit">


</form>
</div>
<?php

include "Account.php";

        if(isset($_POST['credit'])){
            $acc=$_POST['aname'];
            $amt=$_POST['amt'];

            $myfile=fopen("accData.txt","r");
  $arr=array();
  while(!feof($myfile)){
    $string=fgets($myfile);
    if($string!=""){
      $obj=json_decode($string,true);
      array_push($arr,$obj);
    }
  }
  fclose($myfile);
        
            $aAcc=array();
            if(count($arr)>0){
                foreach($arr as $val){
                    
                    if($val["name"]==$acc){
                        $aName=$val["name"];
                        $aBalance=$val["balance"];
                        echo "Current balance:".$aBalance."<br>";
                        $accObj=new Account($aName,$aBalance);
                        $creditAmt=$accObj->credit($amt);
                        $val["balance"]=$creditAmt;
                    }
                    array_push($aAcc,$val);
                }
                //print_r($aAcc);
            }
            fileClear();
            foreach($aAcc as $value){
            $resObj=json_encode($value);
            //print_r($resObj);
            echo "<br>";
            $myfile=fopen("accData.txt","a");
            fwrite($myfile,$resObj."\n");
            fclose($myfile);

        }
    
    }
    if(isset($_POST['debit'])){
        $acc=$_POST['aname'];
        $amt=$_POST['amt'];

        $myfile=fopen("accData.txt","r");
        $arr=array();
        while(!feof($myfile)){
        $string=fgets($myfile);
          if($string!=""){
          $obj=json_decode($string,true);
          array_push($arr,$obj);
            }
          }
  fclose($myfile);
        $aAcc=array();
            if(count($arr)>0){
                foreach($arr as $val){
                    
                    if($val["name"]==$acc){
                        $aName=$val["name"];
                        $aBalance=$val["balance"];

                        echo "Current Balance:".$aBalance."<br>";

                        $accObj=new Account($aName,$aBalance);
                        $creditAmt=$accObj->debit($amt);
                        $val["balance"]=$creditAmt;
                    }
                    array_push($aAcc,$val);
                }
                //print_r($aAcc);
            }
            fileClear();
        
        foreach($aAcc as $value){
            $resObj=json_encode($value);
            //print_r($value);
            echo "<br>";
            $myfile=fopen("accData.txt","a");
            fwrite($myfile,$resObj."\n");
            fclose($myfile);

        }


    }





?>
</body>
</html>