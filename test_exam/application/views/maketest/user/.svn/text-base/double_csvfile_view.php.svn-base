<div id="box_entry">
  	  <h2></h2>
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
        <legend>CSVファイル</legend>
		<?php
			echo $filename.'が同じです。';
			echo "二つのCSVファイルはアップロードしたから、上書きしますか？"; 
		?>

        <br/>

        <label>&nbsp;</label> <input type="submit" name="overwrite" value="上書き" />
		<label>&nbsp;</label> <input type="submit" name="cancel" value="キャンセル" /><br />
        </fieldset>
    </form>
</div>