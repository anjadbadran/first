<?php
/**
 * Created by PhpStorm.
 * User: Trainer-PC
 * Date: 12/10/2016
 * Time: 12:16 PM
 */


$mysqli = new mysqli('localhost','root','root');
if(0 !== $mysqli->connect_errno){
    echo '<br/>Cannot connect to DB ', $mysqli->connect_error;
    exit();
}

$mysqli->select_db('training'); // $mysqli->query('`training`');
//$mysqli->select_db('`training`'); // $mysqli->query('``training``');
$nameValue = "' or ''='";
//$nameValue = "'; drop table `user`; select '' from dual where '' = '";
$emailValue = time()."@gma'il.com";
echo '<br/>',$nameValue;
echo '<br/>',$emailValue;

$nameValue = $mysqli->real_escape_string($nameValue);
$emailValue = $mysqli->real_escape_string($emailValue);

echo '<br/>',$nameValue;
echo '<br/>',$emailValue;

//$insertQuery = "insert into `user`(`name`,`email`) values('%s','%s')";
//$insertQuery = sprintf($insertQuery, $nameValue, $emailValue);
//echo '<br/>',$insertQuery;

$selectQuery = "select * from `user` where `name` = '%s'";
$selectQuery = sprintf($selectQuery, $nameValue, $emailValue);
echo '<br/>',$selectQuery;
$resultSet = $mysqli->query($selectQuery);
echo $mysqli->error;
while(($data = $resultSet->fetch_array(MYSQLI_ASSOC))){
    //while(($data = $mysqliResult->fetch_array(MYSQLI_NUM))){
    //while(($data = $mysqliResult->fetch_array(MYSQLI_BOTH))){
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}
exit();

$executed = $mysqli->query($insertQuery);
if(!$executed){
    echo '<br/> Error: ',$mysqli->error;
}else{
    echo $mysqli->affected_rows,' rows are affected';
    $lastInsertId = $mysqli->insert_id;
}

$updateQuery = "update `user` set `name` = '".time().$nameValue."' where `id` = ".$lastInsertId;
$updated = $mysqli->query($updateQuery);
if($updated){
    echo '<br/> Update. Affected row: '.$mysqli->affected_rows;
}else{
    echo '<br/> Failed to update '.$mysqli->error;
}


$query = 'select * from `user` /* where `id` = 0*/';
$mysqliResult =  $mysqli->query($query);
if(false != $mysqliResult){
    echo '<br/>Query has been executed, returned row: ',$mysqliResult->num_rows;
    echo '<br/>Affected rows: ',$mysqli->affected_rows;
    while(($data = $mysqliResult->fetch_array(MYSQLI_ASSOC))){
    //while(($data = $mysqliResult->fetch_array(MYSQLI_NUM))){
    //while(($data = $mysqliResult->fetch_array(MYSQLI_BOTH))){
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }


}else{
    echo '<br/>',$mysqli->errno,'::',$mysqli->error;
}








