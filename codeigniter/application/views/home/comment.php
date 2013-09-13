<?php
    //--- create textarea's form
    $comment_area = array(
                        'name'        => 'comment_area',
                        'id'          => 'comment_area',
                        'value'       => '',
                        'rows'        => '5',
                        'cols'        => '10',
                        'style'       => 'width:50%',
                       
                    );

?>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
  <script type="text/javascript">
  var click_sent = 0;
  var click_continue = 1;
  $(document).ready(function(){
    
    $("#ok").click(function(e){
    e.preventDefault();
    click_sent++;
    var all_curr_record = click_sent + Number("<?php echo $all_record; ?>");
    if ( all_curr_record <= click_continue*10 ){
        document.getElementById("continue").style.visibility = 'hidden';
    } else {
        document.getElementById("continue").style.visibility = 'visible';
    } 
    var data_send = $("#comment_area").val();    

     $.ajax({   
        type : "POST",
        url : "<?php echo base_url(); ?>home/save", 
        data : "data_send= " + data_send,
        dataType: "json",
        success:function(x){
           var all_string = "<div id='box_display'>";
            $.each(x.data, function(index, value) {
                all_string += "<div id='list_table'>";
                var cm_string = value.twitter; 
                all_string += value.name + "&nbsp;&nbsp;&nbsp;" + value.sent_time +
                            "<br/>" + cm_string + "<br/>";
                all_string +="</div>";
            });
            all_string +="</div>";
            document.getElementById("twitter_insert").innerHTML = all_string.replace(/[\n\r]/g, "<br />");
        }     
    });
    return false;
    });
    
   
    $("#continue").click(function(){ 
    click_continue++;
    var all_curr_record = click_sent + Number("<?php echo $all_record; ?>");
    if ( all_curr_record < click_continue*10 ){
        document.getElementById("continue").style.visibility = 'hidden';
        //$("#continue").hide('fast');
    }
    $.ajax({
        type : "POST",
        url : "<?php echo base_url(); ?>home/get", // get comment
        data: "", //
        dataType: "json", 
        success:function(x){ 
            var all_string = "<div id='box_display'>";
            $.each(x.data, function(index, value) {
                all_string += "<div id='list_table'>"; 
                all_string += value.name + "&nbsp;&nbsp;&nbsp;" + value.sent_time +
                            "<br/>" + value.twitter + "<br/>";
                all_string +="</div>";
            });
            all_string +="</div>";
            document.getElementById("detail").innerHTML = all_string.replace(/[\n\r]/g, "<br />");
        }
    }); 
   });
    function auto_check_button()
    {
        var all_curr_record = Number("<?php echo $all_record; ?>");
        if ( all_curr_record <= 10 ){
            document.getElementById("continue").style.visibility = 'hidden';
            //alert("auto hide");
        //$("#continue").hide('fast');
        } else {
            document.getElementById("continue").style.visibility = 'visible';
        }
    }
    window.onload = auto_check_button();
});

</script>

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

        <?php echo form_textarea($comment_area); ?><br />
		<br/>
        
        <label>&nbsp;</label> <input type="button" name="ok" id="ok" value="ツィート" onclick=/><br />

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
        <div id="detail">

        </div>
        <label>&nbsp;</label> <input type="button" name="continue" id="continue" value="もっと見る" onclick=/><br />
    </div>

</div>