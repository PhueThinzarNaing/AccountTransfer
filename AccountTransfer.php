<!doctype html>
<html>
<head>
<style>


        
input[type=text] {
            padding: 10px 10px;
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
<?php include "AccountMenu.php"?>


</div><br><br>
<h2  style='margin-left:20px;'>Transfer Balance</h2>

<div>
<form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<div class="form-group">
    <label for="fAccount"  style='margin-left:20px;'>From Account</label><br>
    <select class="form-control" name="fAcc"  style="width:20%;height:70%;padding:10px 10px;margin-left:20px;">
        <option selected="selected"  style='margin-left:20px;'>Select choose</option>
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
<div class="form-group">
    <label for="tAccount"  style='margin-left:20px;'>To Account</label><br>
    <select class="form-control" name="tAcc" style="width:20%;padding:10px 10px;margin-left:20px;">
    <option selected="selected" >Select choose</option>
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

                        ?>
    
          </select>

   </div><br>
    <label for="amount" style='margin-left:20px;'>Amount :</label><br>
    <input type="text" id="amt" name="amount" placeholder="Enter amount" style="width:20%;height:70%;"><br>

     <input type="submit" name="transacc" value="trasfer" style="width:20%">
     </form>
     </div>
     <?php

          include 'Account.php';

          if(isset($_POST['transacc'])){
           
           $facc=$_POST['fAcc'];
           $tacc=$_POST['tAcc'];
           $amt=$_POST['amount'];
           $a=array();
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
            $at=array();
                if(count($arr)>0)
                  {
                            foreach($arr as $arrs){
                            if($arrs['name']==$tacc){
                             $Acc=$arrs['name'];
                             $bal=$arrs['balance'];
                             $taccObj=new Account($Acc,$bal);
                             echo "Account1 created!!<br>";
                            }
                             else if($arrs['name']==$facc){
                             $fAcc=$arrs['name'];
                             $bal1=$arrs['balance'];
                             $faccObj=new Account($fAcc,$bal1);
                             echo "Account2 created!!<br>";

                      }
                    }
                      if(count($arr)>0){
                        foreach($arr as $arrs){
                            if($arrs["name"]==$tacc){
                                $res = $faccObj->transfer($taccObj,$amt);
                                echo "Acc2 Received Amount :".$res;
                                $bal = $faccObj->get_balance();
                                echo "<br>Acc1 current Amount:".$bal."<br>";
                                $arrs["balance"] =$res;
                            }
                            array_push($a,$arrs);
                        }
                        $arrb=array();
                        foreach($a as $ab){
                            
                            if($ab["name"]==$facc){
                                $ab["balance"] =$bal;
                            }
                            array_push( $arrb,$ab);
                        }
                        print_r($arrb);
                    }
    
                }
              fileClear();
              foreach($arrb as $value){
                 //print_r($val);
                 //echo "<br>";
                 $res=json_encode($value);
                 print_r($res);
                 echo "<br>";
                 $myfile = fopen("accData.txt", "a");
                 fwrite($myfile, $res."\n");
                 fclose($myfile);
             }
         }

     ?>
 </body>
 </html>