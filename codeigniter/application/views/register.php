<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url()."public/frontend/css/login.css";?>" rel="stylesheet" type="text/css" />
<title>TWITTER</title>

</head>
<body>
<?=form_open(base_url().'login/register_new')?>
<fieldset>
    <legend align='center'>    
      ユーザー登録
    </legend>
    <div>
        <label>名前</label>
        <input type="text" name="name" id="name" value="<?=set_value('name')?>" maxlength="20">
    </div>
    <div>
        <label>メールアドレス</label>
        <input type="text" name="email" id="email" value="<?=set_value('email')?>" maxlength="20">
    </div>
    <div>
        <label>パスワード</label>
        <input type="password" name="password" id="password" maxlength="20">
    </div>
    <div>
        <label>再パスワード</label>
        <input type="password" name="repassword" id="lname" maxlength="20">
    </div>
    <div align='center' >
        <input type="submit" name="ok" value="登録" />
    </div>
    <span class='error'>
        <?=form_error('name')?>
        <?=form_error('email')?>
        <?=form_error('password')?>
    </span>
</fieldset>
<?=form_close()?>
</body>
</html>