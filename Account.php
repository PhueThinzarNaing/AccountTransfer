
<?php

class Account{
  public $name;
  public $balance;
  function __construct($name,$balance){
    $this->name=$name;
    $this->balance=$balance;
  }
  function set_name($name){
    $this->name=$name;

  }
  function set_balance($balance){
    $this->balance=$balance;
  }
  function get_name(){
    return $this->name;
  }
  function get_balance(){
    return $this->balance;
  }
  public function accInfo(){
    echo "Account Name is {$this->name} , Your Balance is {$this->balance} ";
  }
  function credit($amount){
    $this->balance += $amount;
    echo "New Balance:".$this->balance;
    return $this->balance;

    }
    public function debit($amount){
      if($this->balance>$amount){
        $this->balance-=$amount;
        echo "new balance:".$this->balance;
        return $this->balance;
      }else{
        echo "Amount not sufficient";
      }
    }
    public function transfer($account,$amount){
      if($amount <= $this->balance){
          $newb=$account->balance+$amount;
          echo "Amount transferred!<br>";
         // echo $newb;
          $this->balance -= $amount;
          return $newb;
      }else{
          echo "Amount exceed!!<br>";
          echo "Current Balance is ".$this->balance;
      }
      
    }
  }

  
function fileRead(){
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
}

function fileClear(){
  $handle = fopen("accData.txt", "w+");
  fwrite($handle , '');
  fclose($handle);
}



?>