<?php
    $username = array(
                        'name'        => 'username',
                        'id'          => 'username',
                        'size'        => '25',
                    );
    $password = array(
                        'name'        => 'password',
                        'id'          => 'password',
                        'size'        => '25',
                    );
    $submit = array(
                        "name"=>"ok",
                        "value"=>"OK",
                    );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url()."public/frontend/css/login.css";?>" rel="stylesheet" type="text/css" />
<title>Dang nhap he thong</title>

</head>
<body>
<?php
    echo form_open(base_url()."admin/verify/login");
    echo form_fieldset("LOGIN");
    echo form_label("Username : ").form_input($username)."<br/>";
    echo form_label("Password : ").form_password($password)."<br/>";
    echo form_label("").form_submit($submit)."<br/>";
    
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