<?php
    //--- Giu gia tri cua form
    $full_name = array(
                        "name"  => "full_name",
                        "id"    => "full_name",
                        "size"  => "30",
                        "value" => $info["name"]
                    );
    $username = array(
                        'name'        => 'username',
                        'id'          => 'fname',
                        'size'        => '30',
                        'value'       => $info["username"]
                    );

    $password = array(
                        'name'        => 'password',
                        'id'          => 'lname',
                        'size'        => '30',
                        'value'       => set_value('password'),
                    );

    $repassword = array(
                        'name'        => 'repassword',
                        'id'          => 'lname',
                        'size'        => '30',
                        'value'       => set_value('repassword'),
                    );
    $address = array(
                        'name'        => 'address',
                        'id'          => 'address',
                        'size'        => '30',
                        'value'       => $info["address"],
                    );
    $phone = array(
                        'name'        => 'phone',
                        'id'          => 'phone',
                        'size'        => '30',
                        'value'       => $info["phone"],
                    );
    $email = array(
                        'name'        => 'email',
                        'id'          => 'email',
                        'size'        => '30',
                        'value'       => $info["email"],
                    );
    $birthday = array(
                        'name'        => 'birthday',
                        'id'          => 'birthday',
                        'size'        => '30',
                        'value'       => $info["birthday"],
                    );
    $s_day 		= date('d',strtotime($info['birthday']));
	$s_month 	= date('m',strtotime($info['birthday']));
	$s_year 	= date('Y',strtotime($info['birthday']));
?>

<div id="box_entry">
  	  <h2><span></span></h2>
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
        <legend>メンバーの変更</legend>

        <label>氏名</label><?php echo form_input($full_name);?><br />

        <label>ユーザー名</label><?php echo form_input($username);?><br />

        <label>パスワード</label><?php echo form_password($password);?><br />

        <label>再度パスワード</label><?php echo form_password($repassword);?><br />

        <label>レベル</label>
        	<select name="type">
                    <option value="00100">　出題者 </option>
				     <option value="00010">採点者</option>
                    <option value="00001">回答者</option>
                </select><br />

                
		<label>年月日</label>
        <select name="day">
        <?php for ($i=1;$i<=31;$i++){ ?>
        	
                    <option value="<?php echo $i?>" <?php if ($i== $s_day) echo "selected"; ?> > <?php echo $i?> </option>
                
         <?php }?>
         </select>
         <select name="month">
        <?php for ($i=1;$i<=12;$i++){ ?>
        	
                    <option value="<?php echo $i?>" <?php if ($i== $s_month) echo "selected"; ?> > <?php echo $i?> </option>
                
         <?php }?>
         </select>
         <select name="year">
        <?php for ($i=1960;$i<=2010;$i++){ ?>
        	
                    <option value="<?php echo $i?>" <?php if ($i== $s_year) echo "selected"; ?> > <?php echo $i?> </option>
                
         <?php }?>
         </select><br />
         
        <label>メール</label><?php echo form_input($email);?><br />

        <label>住所</label><?php echo form_input($address);?><br />

        <label>電話</label><?php echo form_input($phone);?><br />

        <!--<label>Birthday</label>
            <?php echo form_input($phone);?>
            -->
        <br/>

        <label>&nbsp;</label> <input type="submit" name="ok" value="Update" /><br />

        </fieldset>
    </form>
</div>