<?php
include('db.php');
session_start();
$qry="
UPDATE login_details
SET is_type ='".$_POST["type"]."'
WHERE login_details_id ='".$_SESSION["login_details_id"]."'
";
$stm=$connect->prepare($qry);
$stm->execute();
?>