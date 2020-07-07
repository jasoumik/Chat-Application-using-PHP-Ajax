<?php
include('db.php');
session_start();

if($_POST["action"]=="insert_data"){
    $data=array(
        ':from_user_id' => $_SESSION["user_id"],
        ':chat_msg' => $_POST['chat_msg'],
        ':status'   => '1',
        ':to_user_id' => '0'
    );
    $qry="
    INSERT INTO chat_msg(from_user_id,chat_msg,status,to_user_id)
    VALUES(:from_user_id, :chat_msg, :status,:to_user_id)
    ";
    $stm=$connect->prepare($qry);
    if($stm->execute($data)){
        echo fetch_grp_chat_history($connect);
    }
}
if($_POST["action"]=="fetch_history"){
    echo fetch_grp_chat_history($connect);
}
?>