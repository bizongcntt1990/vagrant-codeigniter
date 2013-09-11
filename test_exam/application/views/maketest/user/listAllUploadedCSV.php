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
                    if($numberOfAllBooklets>0){
                        echo $link;
                        echo " | アップロードしたCSVの回数 : ".$numberOfAllBooklets;
                    }
       
                  ?>
                  </div>

                    <table width="75%" cellpadding="2" cellspacing="2">
                          <tbody>
                          <tr>
                            <td width="10%" class="table_titile">数.</td>
                            <td width="15%" class="table_titile">アップロードしたデート</td>
                            <td width="40%" class="table_titile">件名</td>
                            <td width="20%" class="table_titile">記述</td>
                            <td width="20%" class="table_titile"> </td>
                          </tr>
                          <?php
                            $count=0;
                            if($numberOfAllBooklets>0){
                                foreach ($allbooklets as $item) {
                                    $count++;
                                    if($count%2==0)
                                        echo "<tr class='row_chan'>";
                                    else
                                        echo "<tr>";
                                    echo '<td>'.$count.'</td>';

 									echo '<td>'.$item['upload_date'].'</td>';
 									echo '<td>'.$item['subject'].'</td>';
 								 echo '<td>'.$item['description'].'</td>';
//  									echo '<td>'.$item['starting_date'].'</td>';
//                                   	echo '<td>'.$item['expired_date'].'</td>';
//                                   	//Display "Finished", "Expired", "Do" status 
// 									$phpCurrentTime=time();
// 									$sqlExpiredTime=strtotime($item['expired_date']);
// 									$sqlStartingTime=strtotime($item['starting_date']);
// 									$phpExpiredTime=$sqlExpiredTime;
									

									
// 									if($this->doingTestModel->isDoneByExaminee($item['booklet_id'],$this->my_auth->user_id)==0)
// 									{
// 										if($phpCurrentTime<=$phpExpiredTime && $phpCurrentTime>=$sqlStartingTime)
// 										{

											
									echo '<td> <a href="'.base_url()."maketest/user/getCSVForViewing/".$item['booklet_id'].'">CSVを表示</a></td>';
// 										}
// 										else
// 										{
// 											if($phpCurrentTime<$sqlStartingTime)
// 											{
// 												echo '<td>Not yet available</td>';
// 											}
// 											else
// 											{
// 												echo '<td>Expired</td>';
// 											}
// 										}
// 									}
// 									else
// 									{
// 										echo '<td>Finished <a href="'.base_url()."examinee/dotest/getresultview/".$item['booklet_id'].'">View Result</a></td>';
// 									}
//                                     echo "</tr>";  
                                }
                            }
                          ?>
                    </tbody>
                   </table>
</div>
</div>