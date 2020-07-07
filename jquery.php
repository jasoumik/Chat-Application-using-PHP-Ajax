<script>
    $(document).ready(function(){
        fetch_user();
        
        setInterval(function(){
            update_last_actv();
            fetch_user();
            update_chat_data();
            fetch_grp_chat_hist();
        },5000)

        function fetch_user(){
            $.ajax({
                url: "fetch_user.php",
                method :"POST",
                success : function(data){
                    $('#user_details').html(data);
                }
            })
        }

        function update_last_actv(){
            $.ajax({
                url: "update_last_activity.php",
                success : function(){
            
                }
            }) 
        }

        function chat_dialog_box(to_user_id,to_user_name){
            var modal_content = '<div id="user_dialog_'+to_user_id+'" class="user_dialog" title="You have chat with '+to_user_name+'">';
            modal_content += '<div style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'">';
            modal_content += fetch_chat_hist(to_user_id);
            modal_content += '</div>';
            modal_content += '<div class="form-group">';
            modal_content += '<textarea name="chat_msg_'+to_user_id+'" id="chat_msg_'+to_user_id+'" class="form-control chat_msg"></textarea>';
            modal_content += '</div><div class="form-group" align="right">';
            modal_content += '<button type="button" name="send_chat" id="'+to_user_id+'" class="btn btn-info send_chat">Send</button></div></div>';
            $('#user_model_details').html(modal_content);
        }
        $(document).on('click','.start_chat',function(){
            var to_user_id = $(this).data('touserid');
            var to_user_name=$(this).data('tousername');
            chat_dialog_box(to_user_id,to_user_name);
            $("#user_dialog_"+to_user_id).dialog({
                autoOpen:false,
                width:400

            });
            $("#user_dialog_"+to_user_id).dialog('open');
            $('#chat_msg_'+to_user_id).emojioneArea({
               pickerPosition : "top",
               toneStyle:"bullet"

            });

        });
        $(document).on('click','.send_chat',function(){
            var to_user_id =$(this).attr('id');
            var chat_msg = $('#chat_msg_'+to_user_id).val();
            $.ajax({
                url:"insert_chat.php",
                method:"POST",
                data:{to_user_id:to_user_id,chat_msg:chat_msg},
                success:function(data){
                    //$('#chat_msg_'+to_user_id).val('');
                    var elem = $('#chat_msg_'+to_user_id).emojioneArea();
                    elem[0].emojioneArea.setText('');
                    $('#chat_history_'+to_user_id).html(data);
                   

                }
            })
        });

        function fetch_chat_hist(to_user_id){
            $.ajax({
                url:"fetch_chat_hist.php",
                method:"POST",
                data:{to_user_id:to_user_id},
                success:function(data){
                    $('#chat_history_'+to_user_id).html(data);

                }
            })
        }

        function update_chat_data(){
            $('.chat_history').each(function(){
                var to_user_id = $(this).data('touserid');
                fetch_chat_hist(to_user_id);
            });
        }
        
        $(document).on('focus','.chat_msg',function(){
         var type='yes';
         $.ajax({
             url:"update_typing_status.php",
             method:"POST",
             data : {type:type},
             success:function(data){
                

                }
         });
        });
        $(document).on('click','.ui-button-icon',function(){
                $('.user_dialog').dialog('destroy').remove();
                });
        $('#group_chat_dialog').dialog({
            autoOpen:false,
            width:400
        })
        $('#group_chat').click(function(){
            $('#group_chat_dialog').dialog('open');
            $('#actv_grp_windw').val('yes');
            fetch_grp_chat_hist();
        });
        $('#send_group_chat').click(function(){ 
            var chat_msg =$('#grp_chat_msg').html();
            var action ='insert_data';
            if(chat_msg !=''){
            $.ajax({
             url:"grp_chat.php",
             method:"POST",
             data : {chat_msg:chat_msg,action:action},
             success:function(data){
                $('#grp_chat_msg').html('');
                $('#group_chat_history').html(data);
                }
           }); 
            }
        });
        function fetch_grp_chat_hist(){
            var grp_chat_actv_dialog =$('#actv_grp_windw').val();
            var action= 'fetch_history';
            if(grp_chat_actv_dialog=='yes'){
                $.ajax({
             url:"grp_chat.php",
             method:"POST",
             data : {action:action},
             success:function(data){
                $('#group_chat_history').html(data);
                }
           });   
            }
        }
        $('#uploadFile').on('change',function(){
            $('#upldImg').ajaxSubmit({
              target:"#grp_chat_msg",
              resetForm :true
            });
        });
        $(document).on('click','.remove_chat',function(){
           var chat_msg_id = $(this).attr('id');
           if(confirm("Are You sure?")){
               $.ajax({
                    url: "remove_chat.php",
                    method:"POST",
                    data : {chat_msg_id:chat_msg_id},
                    success:function(data){
                        update_chat_data() ;
                    }
               })
           }
        });
    });
</script>