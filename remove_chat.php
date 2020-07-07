<?php
include('db.php');
if(isset($_POST["chat_msg_id"])){
    $qry="
    UPDATE chat_msg SET status='2'
    WHERE chat_msg_id='".$_POST["chat_msg_id"]."'
    ";
    $stm=$connect->prepare($qry);
    $stm->execute();
}
?>