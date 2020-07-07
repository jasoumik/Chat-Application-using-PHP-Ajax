<?php
include('db.php');
session_start();
$data= array(
    ':to_user_id'  => $_POST["to_user_id"],
    ':from_user_id'  => $_SESSION["user_id"],
    ':chat_msg'  => $_POST["chat_msg"],
    ':status'    => '1'
);
$qry="
INSERT INTO chat_msg(to_user_id,from_user_id,chat_msg,status)
VALUES(:to_user_id,:from_user_id,:chat_msg,:status)
";
$stm=$connect->prepare($qry);
if($stm->execute($data)){
    echo fetch_chat_hist($_SESSION['user_id'],$_POST['to_user_id'],$connect);
}
?>