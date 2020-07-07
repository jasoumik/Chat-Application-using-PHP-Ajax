<?php
include('db.php');
session_start();
if(!isset($_SESSION['user_id'])){
    header('location:login.php'); 
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat System by JAS</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
</head>
<body style="background-image:url('chat.jpg')">
    <style>
        .chat_history{
            background-image:url('chatbc.jpg');
        }
        .chat_msg_area{
            position: relative;
            width: 100%;
            height: auto;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 3px;
           

        }
        #grp_chat_msg{
            width: 100%;
            height: auto;
            min-height: 80px;
            overflow: auto;
            padding: 6px 24px 6px 12px;  
            }
            .image_upld{
                position: absolute;
                top: 3px;
                right: 3px;
            }
            .image_upld>form>input{
             display: none;
            }
            .image_upld img{
                width: 24px;
                cursor: pointer;
            }
    </style>
    <div class="container">
        <br><br><br><br><br>
        <h3 align="center">Chat System by JAS</h3>
        <br>
        <br>
        <div class="row">
            <div class="col-md-8 col-sm-6">
            <h4>Online Users</h4>
            </div>
            <div class="col-md-2 col-sm-3">
                <input type="hidden" id="actv_grp_windw" value="no">
               <button type="button" name="group_chat" id="group_chat" 
               class="btn btn-warning btn-xs">Group Chat</button>
            </div>
            <div class="col-md-2 col-sm-3">
            <p align="right">
                Welcome, <?php echo $_SESSION["username"];?> - <a class="btn btn-danger" href="logout.php">Logout</a></p>
                </div>
                <div class="table table-responsive">
                <div id="user_details"></div>
                <div id="user_model_details"></div>
                </div>
        </div>
    </div>
</body>
</html>
<div id="group_chat_dialog" title="Group Chat Window">
<div id="group_chat_history" style="height: 400px; border:1px solid #ccc;
overflow-y:scroll; margin-bottom:24px; padding:16px;">
</div>
<div class="form-group">
    <div class="chat_msg_area">
<div id="grp_chat_msg" contenteditable class="form-control"></div>
<div class="image_upld">
    <form action="upload.php" method="POST" id="upldImg">
        <label for="uploadFile"><img src="upload.png" alt="upload icon"></label>
        <input type="file" name="uploadFile" id="uploadFile" accept=".jpg, .png">
    </form>
</div>
    </div>
<!-- <textarea name="grp_chat_msg" id="grp_chat_msg" class="form-control"></textarea> -->
</div>
<div class="form-group" align="right">
<button type="button" name="send_group_chat" id="send_group_chat"
 class="btn btn-info">Send</button>
</div>
</div>


<?php
include('jquery.php');
?>