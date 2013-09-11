<div id="box_entry">
<h2>プロファイルの情報</h2>
    <ul>
        <li>ユーザー名 : <?php echo $info['username'];?></li>
        <li>氏名 : <?php echo $info['name'];?></li>
        <li>メール : <?php echo $info['email'];?></li>
        <li>住所 : <?php echo $info['address'];?></li>
        <li>電話 : <?php echo $info['phone'];?></li>
        <li>タイプ : <?php if ($info['type']=="01000"){
                              			echo '団体管理者';
                              		}else if ($info['type']=="00100"){
                              			echo '出題者';
                              		}else if ($info['type']=="00010"){
                              			echo '採点者';
                              		}else if ($info['type']=="00001"){
                              			echo '回答者';
                              		}
                     ?></li>
        <li>生年月日 : <?php echo $info['birthday']; ?></li> 
        <li><a href="<?php echo base_url()."examiner/user/edit/".$info['user_id'];?>" >変更</a></li> 
        <li><a href="<?php echo base_url()."home/verify/logout";?>" >ログアウト</a></li>                                   
    </ul>
</div>
