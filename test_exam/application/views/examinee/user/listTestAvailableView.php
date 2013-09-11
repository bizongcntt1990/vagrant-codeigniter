<!-- 
Author: Ngo Anh Tuan
This file is for viewing the list of all available test
Date created: 14/03/2013
-->




<div id="box_display">
<div id="list_table">
                  <!-- Paging -->
                  <div id="paging" class="pagination">
                  <?php
                    if($numberOfAllTests>0){
                        echo $link;
                        echo " | 質問数 : ".$numberOfAllTests;
                    }
                  ?>
                  </div>

                    <table width="75%" cellpadding="2" cellspacing="2">
                          <tbody>
                          <tr>
                            <td width="23%" class="table_titile">主題</td>
                            <td width="9%" class="table_titile">出題者</td>
                            <td width="15%" class="table_titile">説明</td>
                            <td width="12%" class="table_titile">アップロードタイム</td>
                            <td width="15%" class="table_titile">スタットタイム</td>
                            <td width="15%" class="table_titile">締切のタイム</td>
                            <td width="22%" class="table_titile">状態</td>
                          </tr>
                          <?php
                       
                            $count=0;
                            if($numberOfAllTests>0){
                                foreach ($bookletList as $item) {
                                    $count++;
                                    if($count%2==0)
                                        echo "<tr class='row_chan'>";
                                    else
                                        echo "<tr>";
                                 
                                    echo '<td>'.$item['subject'].'</td>';
                                    foreach ( $nameMaketest[$count-1] as $value ) {
       									echo '<td>'.$value['username'].'</td>';
									}
                                    echo '<td>'.$item['description'].'</td>';
 									echo '<td>'.$item['upload_date'].'</td>';
 									echo '<td>'.$item['starting_date'].'</td>';
                                  	echo '<td>'.$item['expired_date'].'</td>';
                                  	//Display "Finished", "Expired", "Do" status 
									$phpCurrentTime=time();
									$sqlExpiredTime=strtotime($item['expired_date']);
									$sqlStartingTime=strtotime($item['starting_date']);
									$phpExpiredTime=$sqlExpiredTime;
									

									
									if($this->doingTestModel->isDoneByExaminee($item['booklet_id'],$this->my_auth->user_id)==0)
									{
										if($phpCurrentTime<=$phpExpiredTime && $phpCurrentTime>=$sqlStartingTime)
										{

											
											echo '<td> <a href="'.base_url()."examinee/dotest/gettest/".$item['booklet_id'].'">このテストをします！</a></td>';
										}
										else
										{
											if($phpCurrentTime<$sqlStartingTime)
											{
												echo '<td>まだ使用できない！</td>';
											}
											else
											{
												echo '<td>期限切れ</td>';
											}
										}
									}
									else
									{
										echo '<td>完成した <a href="'.base_url()."examinee/dotest/getresultview/".$item['booklet_id'].'">結果を見る</a></td>';
									}
                                    echo "</tr>";  
                                }
                            }
                          ?>
                    </tbody>
                   </table>
</div>
</div>