<div id="box_display">
<div id="list_table">
                  <!-- Paging -->
                  <div id="paging" class="pagination">
                  <?php
                    if($num_rows>0){
                        echo $link;
                        echo " | メンバーの数 : ".$num_rows;
                    }
                  ?>
                  </div>

                    <table width="75%" cellpadding="2" cellspacing="2">
                          <tbody>
                          <tr>
                            <td width="20%" class="table_titile">問題の名前 ID</td>
                            <td width="20%" class="table_titile">主題</td>
                            <td width="20%" class="table_titile">アップロードタイム</td>
                            <td width="10%" class="table_titile">試験の開始</td>
                            <td width="10%" class="table_titile">試験の終わり</td>
                            <td width="20%" class="table_titile">選択</td>
                          </tr>
                          <?php
                            $count=0;
                            if($num_rows>0){
                                foreach ($users as $item) {
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
                              		$currentTime = time();
                              		$startTime = strtotime($item['starting_date']);
       								$expiredTime = strtotime($item['expired_date']);
       								if ($currentTime <=$expiredTime){
       									echo "試験が終わりません";
       								}else{
       									echo '<td class="alt">
                                            <a href="'.base_url().'examiner/user/send_email/'.$item['booklet_id'].'">送信</a>
                                         
                                         </td>';
                              	
                                    	echo "</tr>";  
       								}
                        			
                                }
                            }
                          ?>
                    </tbody>
                   </table>
</div>
</div>