<?php
function store_submit($name , $email){
    $fp =fopen(submit_file,"a");
    if ($fp){
$input =date("Y-m-d H:i:s").";".$_SERVER['REMOTE_ADDR'].";"."$name ; $email".PHP_EOL;
if (fwrite($fp,$input)){
    fclose($fp);
    return true;
}else {
return false; 
}
}else {
return false;
}
}

function display_submit(){
$lines = file(submit_file);
foreach($lines as $line){
    echo "<h3> New user details</h3>";
    $words = explode(";",$line);
    $i=0;
    foreach($words as $word){
        if ($i == 0){
            echo "<h4>Date: $word</h4>";
        } elseif ($i == 1){
            echo "<h4>IP: $word</h4>";
        } elseif ($i == 2){
            echo "<h4>Name: $word</h4>";
        } elseif ($i == 3){
            echo "<h4>Email: $word</h4>";
        }
        $i++;
    }
}

}
?>