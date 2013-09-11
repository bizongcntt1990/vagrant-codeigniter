<div id="box_entry">
  	  <h2>CSV</h2>
      <div class="error">
        <ul>
            <?php
                echo validation_errors('<li>','</li>');
                if(isset($error) && $error!="" && !empty($error))
                    echo $error;
            ?>
        </ul>
      </div>
      
              <form method="POST" enctype="multipart/form-data" action="">
          <input type="hidden" name="MAX_FILE_SIZE" value="30000">
          <input type="file" name="file_upload" >
          <input type="submit" name="ok" value="アップロード　ファイル">
     </form>

</div>