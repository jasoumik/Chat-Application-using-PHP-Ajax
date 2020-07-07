<?php
include('db.php');
session_start();
$qry="
SELECT * FROM login
WHERE user_id !='".$_SESSION['user_id']."'
";
$stm=$connect->prepare($qry);
$stm->execute();
$result= $stm->fetchAll();
$outpt='<table class="table table-bordered table-striped">
<tr>
<td><b>Username</b></td>
<td><b>Status</b></td>
<td><b>Action</b></td>
</tr>';


foreach($result as $row){
    $status='';
    $current_timestamp = strtotime(date("Y-m-d H:i:s") . '-10 second');
    $current_timestamp = date('Y-m-d H:i:s',$current_timestamp);
    $user_last_activity = fetch_user_last_activity($row['user_id'],$connect);
    if($user_last_activity > $current_timestamp){
         $status ='<span class="label label-success">Online</span>';
    }
    else{
        $status ='<span class="label label-danger">Offline</span>';
    }
    $outpt .='<tr>
    <td>'.$row['username'].' 
    '.count_unseen_msg($row['user_id'],$_SESSION['user_id'],$connect).' 
    '.typing_status($row['user_id'],$connect).'</td>
    <td>'.$status.'</td>
    <td><button type="button" class="btn btn-info btn-xs start_chat" data-touserid=
    "'.$row['user_id'].'" data-tousername="'.$row['username'].'">Start Chat</button></td>
    </tr>';
   
}
$outpt .='</table>';
echo $outpt;
?>