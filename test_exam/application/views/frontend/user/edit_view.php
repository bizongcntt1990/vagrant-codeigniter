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
                        'disabled'     => 'disabled',
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
?>

<div id="box_entry">
  	  <h2><span></span></h2>
      <div class="error">
        <ul>
            <?php
                echo validation_errors('<li>','</li>');
                if(isset($error) && $error!=NULL && !empty($error))
                    echo $error;
            ?>
        </ul>
      </div>
     <form name="frmEdit" id="frmEdit" action="" method="post" enctype="multipart-formdata">
        <fieldset>
        <legend>メンバー登録</legend>
        
        <label>氏名</label><?php echo form_input($full_name);?><br />

        <label>ユーザー名</label><?php echo form_input($username);?><br />

        <label>パスワード</label><?php echo form_password($password);?><br />

        <label>再度パスワード</label><?php echo form_password($repassword);?><br />

        <label>メール</label><?php echo form_input($email);?><br />

        <label>住所</label><?php echo form_input($address);?><br />

        <label>電話</label><?php echo form_input($phone);?><br />

        <label>年月日</label>
           <?php echo form_input($birthday);?>
        <br/>
        <br/>
       
        
        <label>&nbsp;</label> <input type="submit" name="ok" value="変更" /><br />

        </fieldset>
    </form>
</div>