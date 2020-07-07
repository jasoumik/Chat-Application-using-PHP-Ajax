<?php
include('db.php');
session_start();

$query = "DELETE FROM login_details WHERE login_details_id='".$_SESSION['login_details_id']."'";

$statement = $connect->prepare($query);
$statement->execute();

session_destroy();

header('location:login.php');
?>