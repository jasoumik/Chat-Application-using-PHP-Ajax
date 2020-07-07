<?php
$connect = new PDO("mysql:host=localhost;dbname=chat;charset=utf8mb4","root","root");
date_default_timezone_set('Asia/Dhaka');
function fetch_user_last_activity($user_id,$connect){
    $qry="
    SELECT * FROM login_details
    WHERE user_id ='$user_id'
    ORDER BY last_activity DESC
    LIMIT 1
    ";
    $stm = $connect->prepare($qry);
    $stm->execute();
    $result = $stm->fetchAll();
    foreach($result as $row){
       return $row['last_activity']; 
    }
   }
   function fetch_chat_hist($from_user_id,$to_user_id,$connect){
       $qry="
       SELECT * FROM chat_msg
       WHERE(from_user_id='".$from_user_id."'
       AND to_user_id='".$to_user_id."')
       OR(from_user_id='".$to_user_id."'
       AND to_user_id='".$from_user_id."')
       ORDER BY timestamp DESC
       ";
       $stm = $connect->prepare($qry);
       $stm->execute();
       $result = $stm->fetchAll();
       $output='<ul class="list-unstyled">';
       foreach($result as $row){
           $user_name='';
           $chat_msg='';
           if($row["from_user_id"]==$from_user_id){
             if($row["status"]=='2'){
               $chat_msg ='<em>Message Removed</em>';
               $user_name ='<b class="text-success">You</b>';
             }
             else{
               $chat_msg=$row["chat_msg"];
               $user_name ='<button
               type="button" class="btn btn-danger btn-xs remove_chat"
               id="'.$row['chat_msg_id'].'"
               >x</button>&nbsp;<b class="text-success">You</b>';
             }
               
           }else{
            if($row["status"]=='2'){
              $chat_msg ='<em>Message Removed</em>';
            }
            else{
              $chat_msg=$row["chat_msg"];
              $user_name ='<b class="text-danger">'.get_user_name($row['from_user_id'],$connect).'</b>';
            }
           
           }
           $output .= '<li style="border-bottom:1px dotted #ccc">
            <p>'.$user_name.'-'.$chat_msg.'
            <div align="right">
            - <small><em>'.$row['timestamp'].'</em></small>
            </div>
            </p>
           </li>';
       }
       $output .='</ul>';
       $qry="
       UPDATE chat_msg SET status='0'
       WHERE from_user_id='".$to_user_id."'
       AND to_user_id='".$from_user_id."'
       AND status='1'
       ";
       $stm = $connect->prepare($qry);
       $stm->execute();
       return $output;
   }
   function get_user_name($user_id,$connect){
     $qry="
     SELECT username FROM login WHERE user_id ='$user_id'
     ";
     $stm = $connect->prepare($qry);
     $stm->execute();
     $result = $stm->fetchAll();
     foreach($result as $row){
        return $row['username']; 
     }
   }
   function count_unseen_msg($from_user_id,$to_user_id,$connect){
    $qry="
    SELECT * FROM chat_msg
       WHERE from_user_id='$from_user_id'
       AND to_user_id='$to_user_id'
       AND status='1'
    ";
    $stm = $connect->prepare($qry);
    $stm->execute();
    $count = $stm->rowCount();
    $output ='';
    if($count>0){
       $output ='<span class="label label-success">'.$count.'</span>'; 
    }
    return $output;
  }
  function typing_status($user_id,$connect){
    $qry="
    SELECT is_type FROM login_details
       WHERE user_id='$user_id'
      ORDER BY last_activity DESC
      LIMIT 1
    ";
    $stm = $connect->prepare($qry);
    $stm->execute();
    $result = $stm->fetchAll();
    $output ='';
    foreach($result as $row){
        if($row["is_type"]=='yes'){
            $output ='- <small><em><span class="text-muted">Typing..</span></em></small>';  
        }
     }
     return $output;
  }
  function fetch_grp_chat_history($connect){
     $qry="SELECT * FROM chat_msg
     WHERE to_user_id=0
     ORDER BY timestamp DESC";
     $stm = $connect->prepare($qry);
     $stm->execute();
     $result = $stm->fetchAll();
     $output='<ul class="list-unstyled">';
       foreach($result as $row){
           $user_name='';
           $chat_msg='';

           if($row["from_user_id"]==$_SESSION['user_id']){
            if($row["status"]=='2'){
              $chat_msg ='<em>Message Removed</em>';
              $user_name ='<b class="text-success">You</b>';
            }
            else{
              $chat_msg=$row["chat_msg"];
              $user_name ='<button
              type="button" class="btn btn-danger btn-xs remove_chat"
              id="'.$row['chat_msg_id'].'"
              >x</button>&nbsp;<b class="text-success">You</b>';
            }
              
           }else{
            if($row["status"]=='2'){
              $chat_msg ='<em>Message Removed</em>';
            }
            else{
              $chat_msg=$row["chat_msg"];
              $user_name ='<b class="text-danger">'.get_user_name($row['from_user_id'],$connect).'</b>';
            }
  
           }
           $output .= '<li style="border-bottom:1px dotted #ccc">
            <p>'.$user_name.'-'.$chat_msg.'
            <div align="right">
            - <small><em>'.$row['timestamp'].'</em></small>
            </div>
            </p>
           </li>';
       }
       $output .='</ul>';
       return $output;
  }
?>