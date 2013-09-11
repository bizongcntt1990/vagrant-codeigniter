
<div id="box_entry">
  	  <h2>テストの選択</h2>
      
     <form name="frmEdit" id="frmEdit" action="" method="post" enctype="multipart-formdata">
        <fieldset>
        <legend>Booklet ID</legend>
	
         <select name="booklet">
        <?php foreach ($exams as $item){ ?>
        	
                    <option value="<?php echo $item['booklet_id']?>"> <?php echo $item['booklet_id']?> </option>
                
         <?php }?>
         </select><br />
        <label>&nbsp;</label> <input type="submit" name="ok" value="選択" /><br />
        
        </fieldset>
    </form>
</div>