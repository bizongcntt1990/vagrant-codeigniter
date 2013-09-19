  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<div id="box_entry">
  	  <h2>コメント</h2>
      <div class="error">
        <ul>
            <?php
                echo validation_errors('<li>','</li>');
                if(isset($error) && $error!="" && !empty($error))
                    echo $error;
            ?>
        </ul>
      </div>
     <form name="frmEdit" id="frmEdit" action="" method="post" enctype="multipart-formdata">
        <fieldset>
        <legend>TWITTER</legend>
        <textarea name="comment_area" id= "comment_area" cols="30" rows="6"></textarea> <br/>
		<br/>
        
        <label>&nbsp;</label> <input type="button" name="ok" id="ok" value="ツィート"/><br />

        </fieldset>
    </form>

    <div id="box_display">
        <div id="twitter_insert">
        <?php 
            foreach ($data as $item) {
                echo "<div id='list_table'>";
                echo $item['name']."&nbsp;&nbsp;&nbsp;".$item['sent_time'].
                "<br/>".nl2br($item['twitter'])."<br/>";
                echo "</div>";
            }
        ?>
        </div>
        <label>&nbsp;</label> <input type="button" name="continue" id="continue" value="もっと見る"/><br />
    </div>

</div>
 <script type="text/javascript">
  var click_sent = 0;
  var click_continue = 1;
  var max_rows = Number("<?php echo element('max_rows', $this->config->item('array_const')); ?>");
  var max_cm = Number("<?php echo element('max_chars', $this->config->item('array_const')); ?>");
  var all_rd = Number("<?php echo $all_record; ?>");
  
  $(document).ready(function()
  {
    auto_check_button();

    $("#ok").click(function(e) {
        e.preventDefault();
        click_sent++;
        var all_curr_record = click_sent + all_rd;
        var data_send = $("#comment_area").val();    
        if (all_curr_record <= max_rows && click_continue == 1) {
            $("#continue").hide('fast');
        } else if (all_curr_record > max_rows && click_continue == 1) {
            $("#continue").show();
        }
        $.ajax({   
            type : "POST",
            url : "home/save", 
            data : "data_send= " + data_send,
            dataType: "json",
            beforeSend:function()
            {
                if (data_send.length ==0) {
                    click_sent--;
                    alert(" Server| Data_send is null");
                } else if (data_send.length > max_cm) {
                    click_sent--;
                    alert(" Server| Data_send is more than 200");
                }
            },
            success:function(x)
            {
                if (data_send.length >0 && data_send.length <= max_cm) {
                    var all_string = "<div id='list_table'>";
                    all_string += x.data[0].name + "&nbsp;&nbsp;&nbsp;" + x.data[0].sent_time +
                            "<br/>" + x.data[0].twitter + "<br/>";
                    all_string += "</div>";
                    $("#twitter_insert").prepend(all_string.replace(/[\n\r]/g, "<br />"));     
                }
            }     
        });
        return false;
    });
   
    $("#continue").click(function(){ 
        click_continue++;
        var all_curr_record = click_sent + all_rd;
        if (all_curr_record <= click_continue*max_rows) {
            $("#continue").hide('fast');
        }
        $.ajax({
            type : "POST",
            url : "home/get", // get comment
            data: {num_click: click_continue, asc: click_sent}, //
            dataType: "json", 
            success:function(x) {
                var all_string = "";
                $.each(x.data, function(index, value) {
                    all_string += "<div id='list_table'>"; 
                    all_string += value.name + "&nbsp;&nbsp;&nbsp;" + value.sent_time +
                                "<br/>" + value.twitter + "<br/>";
                    all_string +="</div>";
                });
                $("#twitter_insert").append(all_string.replace(/[\n\r]/g, "<br />"));
            }
        }); 
        return false;
   });
    function auto_check_button()
    {
        var all_curr_record = all_rd;
        if (all_curr_record <= max_rows) {
            $("#continue").hide('fast');
        } else {
            $("#continue").show();
        }
    }
});

</script>