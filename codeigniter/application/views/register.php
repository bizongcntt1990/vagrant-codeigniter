<?php
    $name = array(
                        "name"  => "name",
                        "id"    => "name",
                        "size"  => "20",
                    );
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

    $repassword = array(
                        'name'        => 'repassword',
                        'id'          => 'lname',
                        'size'        => '20',
                    );
    $submit = array(
                        "name"=>"ok",
                        "value"=>"登録",
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
    echo form_open(base_url()."login/register_new");
    echo form_fieldset("");
    echo form_label("名前 : ").form_input($name)."<br/>";
    echo form_label("メールアドレス : ").form_input($email)."<br/>";
    echo form_label("パスワード : ").form_password($password)."<br/>";
    echo form_label("再パスワード : ").form_password($repassword)."<br/>";
    echo form_label("").form_submit($submit)."<br/>";
    
    //echo "<a href='".base_url()."register/add'>ユーザー登録はこちらから</a><br/>";
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