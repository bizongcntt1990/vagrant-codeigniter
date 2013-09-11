<?php
//--- Giu gia tri cua form
$full_name = array("name" => "full_name", "id" => "full_name", "size" => "30", "value" => set_value("name"));
$username = array('name' => 'username', 'id' => 'fname', 'size' => '30', 'value' => set_value('username'), );

$password = array('name' => 'password', 'id' => 'lname', 'size' => '30', 'value' => set_value('password'), );

$repassword = array('name' => 'repassword', 'id' => 'lname', 'size' => '30', 'value' => set_value('repassword'), );
$address = array('name' => 'address', 'id' => 'address', 'size' => '30', 'value' => set_value('address'), );
$phone = array('name' => 'phone', 'id' => 'phone', 'size' => '30', 'value' => set_value('phone'), );
$email = array('name' => 'email', 'id' => 'email', 'size' => '30', 'value' => set_value('email'), );
$organization = array('name' => 'organization', 'id' => 'organization', 'size' => '30', 'value' => set_value('organization'), );
?>

<div id="box_entry">
	<h2><span></span></h2>
	<div class="error">
		<ul>
			<?php
			echo validation_errors('<li>', '</li>');
			if ($error != "" && !empty($error))
				echo $error;
			?>
		</ul>
	</div>
	<form name="frmEdit" id="frmEdit" action="" method="post" enctype="multipart-formdata">
		<fieldset>
			<legend>
				団体管理者の追加
			</legend>

			<label>フールネーム</label><?php echo form_input($full_name); ?><br />

			<label>ユーザネーム</label><?php echo form_input($username); ?><br />

			<label>パスワード</label><?php echo form_password($password); ?><br />

			<label>再パスワード</label><?php echo form_password($repassword); ?><br />

			<label>誕生日</label>
			<select name="day">
				<?php for ($i=1;$i<=31;$i++){
				?>

				<option value="<?php echo $i?>"><?php echo $i?>
				</option>

				<?php } ?>
			</select>
			<select name="month">
				<?php for ($i=1;$i<=12;$i++){
				?>

				<option value="<?php echo $i?>"><?php echo $i?>
				</option>

				<?php } ?>
			</select>
			<select name="year">
				<?php for ($i=1980;$i<=2010;$i++){
				?>

				<option value="<?php echo $i?>"><?php echo $i?>
				</option>

				<?php } ?>
			</select>
			<br />

			<label>団体名</label><?php echo form_input($organization); ?>
			<br />
			<label>規約の開始</label>
			<input type="text" name="started_day" id="inputfield" onfocus="loadCalendar(this.id)" />

			<br />
			<label>規約の終わり</label>
			<input type="text" name="expired_day" id="inputfield2" onfocus="loadCalendar(this.id)"/>
			<br />

			<label>メール</label><?php echo form_input($email); ?><br />

			<label>住所</label><?php echo form_input($address); ?><br />

			<label>電話番号</label><?php echo form_input($phone); ?><br />

			<label>&nbsp;</label>
			<input type="submit" name="ok" value="登録" onclick="return checkDate()" />
			<br />

		</fieldset>
	</form>
</div>