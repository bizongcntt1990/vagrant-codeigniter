<div id="box_entry">
<h2>プロファイルの情報</h2>
    <ul>
        <li>ユーザー名 : <?php echo $info['username'];?></li>
        <li>氏名 : <?php echo $info['name'];?></li>
        <li>メール : <?php echo $info['email'];?></li>
        <li>住所 : <?php echo $info['address'];?></li>
        <li>電話 : <?php echo $info['phone'];?></li>
        <li>タイプ : <?php echo '回答者';
                     ?></li>
        <li>年月日 : <?php echo $info['birthday']; ?></li> 
        <li><a href="<?php echo base_url()."examinee/user/edit/".$info['user_id'];?>" >変更</a></li> 
        <li><a href="<?php echo base_url()."home/verify/logout";?>" >ログアウト</a></li>                                   
    </ul>
</div>
