<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate"); 
 ?>
<title>自動採点サイト</title>
<link href="<?php echo base_url()."public/frontend/css/admin.css"; ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()."public/frontend/css/paging.css"; ?>" />


</head>
<body>
<div id="main">
  <!-- TOP -->
  <div id="top">
    <h2><span>  HEDSPI - 10チームによる開発</span></h2>
      <h2 class="line"></h2>
      <div id="login">ようこそ : <a href="<?php echo base_url();?>examiner/user/profile/<?php //echo $this->my_auth->user_id?>"><?php echo $this->my_auth->username;?></a> |

            <a href="<?php echo base_url();?>home/verify/logout">ログアウト</a></div>
  </div>
  <!-- EOF TOP -->
  <div id="navigate">
      <ul>
       <li><a href="<?php echo base_url()."examiner/user";?>">テストの採点</a></li>
       <li><a href="<?php echo base_url()."examiner/user/send_result";?>">結果へ送信</a></li>
       <li><a href="<?php echo base_url()."examiner/user/profile";?>">プロフィル</a></li>
      </ul>
  </div>
  <!--EOF Navigate-->
  <div id="containner">

        <?php echo $content_for_layout; ?>

  </div>
  <!-- EOF Containner-->
</div><!--EOF Main-->
</body>
</html>
