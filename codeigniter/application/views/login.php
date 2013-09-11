<?php
    $email = array(
                        'name'        => 'email',
                        'id'          => 'email',
                        'size'        => '20',
                    );
    $password = array(
                        'name'        => 'password',
                        'id'          => 'password',
                        'size'        => '20',
                    );
    $submit = array(
                        "name"=>"ok",
                        "value"=>"ログイン",
                    );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url()."public/frontend/css/login.css";?>" rel="stylesheet" type="text/css" />
<title>TWITTER</title>

</head>
<body>
<?php
    echo form_open(base_url()."verify/login");
    echo form_fieldset("");
    echo form_label("メールアドレス : ").form_input($email)."<br/>";
    echo form_label("パスワード : ").form_password($password)."<br/>";
    echo form_label("").form_submit($submit)."<br/>";
    
    echo "<a href='".base_url()."login/register_new'>ユーザー登録はこちらから</a><br/>";
    //--------------- ERROR
    echo "<span class=error>";
        echo validation_errors();
        if($error!="")
         echo $error;
    echo "</span>";
    //-----------------------
    echo form_fieldset_close();
    echo form_close();
    
?>
</body>
</html>