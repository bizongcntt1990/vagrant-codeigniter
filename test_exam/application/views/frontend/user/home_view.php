<div id="box_entry">
<h2>プロファイルの情報</h2>
    <img src="<?php echo base_url()."public/images/avata/".$info['image'];?>"  width="150px"/><br/>
    <ul>
        <li>ユーザー名 : <?php echo $info['username'];?></li>
        <li>氏名 : <?php echo $info['full_name'];?></li>
        <li>メール : <?php echo $info['email'];?></li>
        <li>住所 : <?php echo $info['address'];?></li>
        <li>電話 : <?php echo $info['phone'];?></li>
        <li>レベル : <?php if($info['level']==1) echo "Administrator";
                          if($info['level']==2) echo "Member"; ?></li>
        <li>性別 : <?php if($info['gender']==1) echo "男性";
                           if($info['gender']==2) echo "女性"; ?></li> 
        <li><a href="<?php echo base_url()."home/user/edit/".$info['userid'];?>" >変更</a></li> 
        <li><a href="<?php echo base_url()."home/verify/logout";?>" >ログアウト</a></li>                                   
    </ul>
</div>