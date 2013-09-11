<?php
    //--- Giu gia tri cua form
    $organization_id = array(
                        "name"  => "organization_id",
                        "id"    => "organization_id",
                        "size"  => "30",
                       
                    );
    $organization_name = array(
                        'name'        => 'organization_name',
                        'id'          => 'organization_name',
                        'size'        => '50',
                        
                    );

    $address = array(
                        'name'        => 'address',
                        'id'          => 'lname',
                        'size'        => '30',
                       
                    );
?>

<div id="box_entry">
  	  <h2>カテゴリ</h2>
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
        <legend>団体の追加</legend>

        <label>団体 ID</label><?php echo form_input($organization_id);?><br />

        <label>団体の名前</label><?php echo form_textarea($organization_name); ?><br />
		<br/>
        <label>住所</label><?php echo form_input($address);?><br />
			
        <br/>
        <label>規約の開始</label>
		<input type="text" name="started_day" id="inputfield" onfocus="loadCalendar(this.id)" />
		<br />
		<br />
		<label>規約の終わり</label>
		<input type="text" name="expired_day" id="inputfield2" onfocus="loadCalendar(this.id)"/>
		<br />
		<br />
        <label>&nbsp;</label> <input type="submit" name="ok" value="登録" onclick="return checkDate()" /><br />

        </fieldset>
    </form>
</div>