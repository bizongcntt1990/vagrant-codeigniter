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
                        "value"=>"ログイン",
                    );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url()."public/frontend/css/login.css";?>" rel="stylesheet" type="text/css" />
<title>システムのログイン</title>

</head>
<body>
<?php
    echo form_open(base_url()."home/verify/login");
    echo form_fieldset("システムのログイン");
    echo form_label("ユーザー名 : ").form_input($username)."<br/>";
    echo form_label("パスワード : ").form_password($password)."<br/>";
    //This part is programmed by Ngo Anh Tuan
    //Doan nay code lieu, tu view-> model, ko qua controller nhe
    /*$options = array(
    		'small'  => 'Small Shirt',
    		'med'    => 'Medium Shirt',
    		'large'   => 'Large Shirt',
    		'xlarge' => 'Extra Large Shirt',
    );
    
    $shirts_on_sale = array('small', 'large');
    echo form_label("Organization : ").form_dropdown('shirts', $options, 'large')."<br/>";*/
    
    $organizationList=$this->muser->getAllOrganization();
    foreach ($organizationList as $organization)
    {
    	$options[$organization['organization_id']]=$organization['organization_name'];
    }
    $options['admin']='Super Admin';
    echo form_label("団体 : ").form_dropdown('organizations', $options)."<br/>";
    echo form_label("").form_submit($submit)."<br/>";
    
    //echo "<a href='".base_url()."home/user/register'>Register</a> | ";
    echo "<a href='".base_url()."home/login/fg_password'>パスワードの忘れ</a><br/>";
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