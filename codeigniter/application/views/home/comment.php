<?php
    //--- create textarea's form
    $comment_area = array(
                        'name'        => 'comment_area',
                        'id'          => 'comment_area',
                        'value'       => 'Please input in here to comment',
                        'rows'        => '5',
                        'cols'        => '10',
                        'style'       => 'width:50%',
                       
                    );

?>
<?php
  json_encode($alldata);  
?>
<script language="JavaScript" type="text/JavaScript">
/*function getComments(){
$.ajax({                                      
  url: base_url().'home', data: "", dataType: 'json',  success: function(rows)        
  {
    for (var i in rows)
    {
      var row = rows[i];          

      var id = row[0];
      var vname = row[1];
      $('#output').append("<b>id: </b>"+id+"<b> name: </b>"+vname)
                  .append("<hr />");
    } 
  } 
});*/

/*function getComments(){
    var name = $('#name').val();
    var rno = $('#rno').val();
    $.ajax({
        type: "POST",
        url: "details.php",
        data: {fname:name, id:rno}
    }).done(function( result ) {
        $("#output").append("<b>id: </b>"+id+"<b> name: </b>"+vname)
                    .append("<hr />");
    });*/
}
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
        
        <label>&nbsp;</label> <input type="submit" name="ok" value="ツィート" /><br />

        </fieldset>
    </form>

    <form name="frmEdit" id="frmEdit" action="" method="post" enctype="multipart-formdata">
        <fieldset>
        <legend>comment</legend>
        <?php echo form_textarea($comment_area); ?><br />
        <br/>
        
        <label>&nbsp;</label> <input type="submit" name="continue" value="もっと見る" /><br />

        </fieldset>
    </form>
</div>