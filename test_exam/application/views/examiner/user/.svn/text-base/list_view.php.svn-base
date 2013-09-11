<div id="box_display">
<div id="list_table">
                  <!-- Paging -->
                  <div id="paging" class="pagination">
                  <?php
                    if($num_rows>0){
                        echo $link;
                        
                    }
                  ?>
                  </div>

                    <table width="75%" cellpadding="2" cellspacing="2">
                          <tbody>
                          <tr>
                            <td width="20%" class="table_titile">問題の名前</td>
                            <td width="20%" class="table_titile">主題</td>
                            <td width="10%" class="table_titile">アップロードタイム</td>
                            <td width="10%" class="table_titile">試験の開始</td>
                            <td width="10%" class="table_titile">試験の終わり</td>
                            <td width="15%" class="table_titile">作成</td>
                          </tr>
                          <?php
                          	$check_result=0;
                          	$count=0;
                          	if ($num_rows>0){
                          		foreach ( $users as $item ) {
                          			if ($marking[$count]==1){
                          				if ($item['result']!=-1){
       									$check_result=1; // Chua dc cham
       								}	
                          		}
}
                          	}
                            $count=0;
                            $count_all=0;
                            if($num_rows>0){
                                foreach ($users as $item) {
                                	$count_all++;
                                	if ($checkOrga[$count] == 1){
                                		$count++;
                                    if($count%2==0)
                                        echo "<tr class='row_chan'>";
                                    else
                                        echo "<tr>";
                                    echo '<td>'.$item['description'].'</td>';
                                    echo '<td>'.$item['subject'].'</td>';
                              		echo '<td>'.$item['upload_date'].'</td>';
                              		echo '<td>'.$item['starting_date'].'</td>';
                              		echo '<td>'.$item['expired_date'].'</td>';
                              		//$currentTime = strtotime(date('Y-m-d H:m:s'));
                              		$currentTime = time();
                              		$startTime = strtotime($item['starting_date']);
       								$expiredTime = strtotime($item['expired_date']);
                              		
                              		if ($marking[$count-1]==0){
       									$check = 0; //Khong dc cham
       									if ($currentTime > $expiredTime){
       										$check = 1; // duoc xem ket qua
       									}
       									if ($check == 0) {
       										echo '採点できない';
       									}else{
       										echo '<td class="alt">' .
                           
                              					'<a href="'.base_url().'examiner/user/marked_result/'.$item['booklet_id'].'">結果を見る</a>'.
                              					'</td>';
       									}
       								}else{
       									
                              		if ($currentTime < $startTime){
                              			echo '<td>まだ試験は始まりません</td>';
                              		}else if (($startTime <= $currentTime)&&($currentTime <= $expiredTime)){
                              			echo '<td>今、テストしているん</td>';
                              		}else{
                              			if ($check_result == 1){
                              			echo '<td class="alt">' .
                           
                              					'<a href="'.base_url().'examiner/user/marked_result/'.$item['booklet_id'].'">結果を見る</a>'.
                              					'</td>';
                              			
                              			}else {
                              			
                              				 echo '<td class="alt">
                                    	        <a href="'.base_url().'examiner/user/marking/'.$item['booklet_id'].'">採点する</a>
                                    	     
                                        	 </td>';
                              			}	
                              		}
                              		
       								}	
                                	}
                                     
                                }
                             
                            }
                          ?>
                    </tbody>
                   </table>
</div>
</div>