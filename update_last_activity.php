<?php
include('db.php');
session_start();
$qry="
UPDATE login_details
SET last_activity=now()
WHERE login_details_id ='".$_SESSION["login_details_id"]."'
";
$stm=$connect->prepare($qry);
$stm->execute();

?>