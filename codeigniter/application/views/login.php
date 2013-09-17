<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url()."public/frontend/css/login.css";?>" rel="stylesheet" type="text/css" />
<title>TWITTER</title>

</head>
<body>
<?=form_open(base_url().'verify/login')?>
<fieldset>
    <legend align='center'>    
      システムログイン
    </legend>
    <div>
        <label>メールアドレス</label>
        <input type="text" name="email" id="email" value="<?=set_value('email')?>" maxlength="20">
    </div>
    <div>
        <label>パスワード</label>
        <input type="password" name="password" id="password" maxlength="20">
    </div>
    <div align='center' >
        <input type="submit" name="ok" value="ログイン" />
    </div>
    <a href=<?=base_url()."login/register_new"?>>ユーザー登録はこちらから</a><br/>
    <span class='error'>
        <?=form_error('email')?>
        <?=form_error('password')?>
    </span>
</fieldset>
<?=form_close()?>
</body>
</html>