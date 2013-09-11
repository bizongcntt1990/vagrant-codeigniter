<?php
//--- Giu gia tri cua form
$organization_id = array("name" => "organization_id", "id" => "organization_id", "size" => "30", "value" => $info["organization_id"], "readonly" => "readonly");
$organization_name = array('name' => 'organization_name', 'id' => 'organization_name', 'size' => '50', 'value' => $info["organization_name"]);

$address = array('name' => 'address', 'id' => 'lname', 'size' => '30', 'value' => $info["address"], );
$stared_day = date('Y-m-d', strtotime($info['started_date']));
$expired_day = date('Y-m-d', strtotime($info['expired_date']));
$s_day = date('d', strtotime($info['started_date']));
$s_month = date('m', strtotime($info['started_date']));
$s_year = date('Y', strtotime($info['started_date']));
$e_day = date('d', strtotime($info['expired_date']));
$e_month = date('m', strtotime($info['expired_date']));
$e_year = date('Y', strtotime($info['expired_date']));
?>

<div id="box_entry">
	<h2>団体の修正</h2>
	<div class="error">
		<ul>
			<?php
			echo validation_errors('<li>', '</li>');
			if (isset($error) && $error != "" && !empty($error))
				echo $error;
			?>
		</ul>
	</div>
	<form name="frmEdit" id="frmEdit" action="" method="post" enctype="multipart-formdata">
		<fieldset>
			<legend>
				団体の修正
			</legend>

			<label  >団体 ID</label><?php echo form_input($organization_id); ?>
			<br />

			<label>団体名</label><?php echo form_textarea($organization_name); ?><br />
			<br/>
			<label>住所</label><?php echo form_input($address); ?><br />

			<br/>
			<label>規約の開始</label>
			<input type="text" name="started_day" id="inputfield" value="<?php echo $stared_day; ?>" onfocus="loadCalendar(this.id)" />
			<br /><br />
			<label>規約の終わり</label>
			<input type="text" name="expired_day" id="inputfield2" value="<?php echo $expired_day; ?>" onfocus="loadCalendar(this.id)"/>
			<br /><br />

			<br />
			<label>&nbsp;</label>
			<input type="submit" name="ok" value="変更"onclick="return checkDate()"/>
			<br />

		</fieldset>
	</form>
</div>