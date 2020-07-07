<?php
include('db.php');
session_start();
echo fetch_chat_hist($_SESSION['user_id'],$_POST["to_user_id"],$connect);
?>