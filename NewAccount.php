<!doctype html>
<html>
<head>
<style>
       

        
input[type=text],input[type=number] {
            width:20%;
            padding:10px 10px;
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
<h2  style='margin-left:20px;'>Create New Account</h2>
<div >
<form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            
            <label for="name"  style='margin-left:20px;'>Account Name :</label><br>
            <input type="text" id="name" name="name" placeholder="Enter Your name.."><br><br>

            <label for="balance"  style='margin-left:20px;'>Balance :</label><br>
            <input type="text" id="balance" name="balance" placeholder=" Enter Your balance.."><br><br>


<input type="submit" name="create" value="CreateAccount">


</form>
</div>
<?php include "Account.php";

if(isset($_POST['create'])){
    $name=$_POST['name'];
    $balance=$_POST['balance'];
    
    $acc=new Account($name,$balance);
    $acc->set_name($name);
    $acc->set_balance($balance);
    $arr=array("name"=>$acc->name,"balance"=>$acc->balance);
    $accData=json_encode($arr);
  
    $myfile=fopen("accData.txt","a");
    fwrite($myfile,$accData."\n");
    fclose($myfile);
  }
  

?>
</body>
</html>