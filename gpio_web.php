<?php

if(isset($_GET['pin'])){
  $pin = $_GET['pin'];
}
if(isset($_GET['state'])){
  $state = $_GET['state'];
}
if(isset($_GET['action'])){
  $action = $_GET['action'];
}

$pins = array("03"=>"08","05"=>"09","07"=>"07","08"=>"15","10"=>"16","11"=>"0","12"=>"01","13"=>"02","14"=>"","15"=>"03","16"=>"04","18"=>"05","19"=>"12","21"=>"13","22"=>"06","23"=>"14","24"=>"10","26"=>"11");
$pin2do = $pins[$pin];

if($action == 'state'){
  $tmp = exec("gpio read $pin2do");
  #echo "The current state of pin $pin($pin2do) is $tmp";
  $data = array("action"=>"state","header"=>$pin,"wiringpi_pin"=>$pin2do,"result"=>$tmp);
  $json = json_encode($data);
  echo $json;
}
elseif($action == 'write'){
if($state === '1'){
  $state = 1;
}

elseif($state === '0'){
  $state = 0;
}
else{
http_response_code(406);
echo"
<h1>Invalid state</h1>
Valid states are 1 and 0
";
exit();
}

$tmp = exec("gpio mode $pin2do out | gpio write $pin2do $state");
$tmp = exec("gpio read $pin2do");
#echo "Set pin $pin ($pin2do) to state $state";
$data = array("action"=>"write","header"=>$pin,"wiringpi_pin"=>$pin2do,"result"=>$tmp);
$json = json_encode($data);
echo $json;
}

elseif($action == 'read'){
  $tmp = exec("gpio mode $pin2do in | gpio read $pin2do");
  #echo "The current read of pin $pin($pin2do) is $tmp";
  $data = array("action"=>"read","header"=>$pin,"wiringpi_pin"=>$pin2do,"result"=>$tmp);
  $json = json_encode($data);
  echo $json;
}
else{
http_response_code(406);
echo"
<h1>Invalid action</h1>
Valid actions are:<br>
-Read (Reads the input of a pin)<br>
-Write (Writes a value to a pin)<br>
-State (Gets the state of a pin)<br>
";

}
?>

