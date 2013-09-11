
<div id="box_display">
<div id="list_table">
<!-- Paging -->
<div id="paging" class="pagination">
<?php
echo "<h2 align='center'> このテストの中であなたの点は ".$score."です！</h2>";

?>
                  </div>

                    <table width="75%" cellpadding="2" cellspacing="2">
                          <tbody>
                          <tr>
                            <td width="5%" class="table_titile">番号</td>
                            <td width="10%" class="table_titile">答えのタイム</td>
                            <td width="25%" class="table_titile">質問</td>
                            <td width="30%" class="table_titile">あなたの答え</td>
                            <td width="10%" class="table_titile">点</td>                             
                            <td width="30%" class="table_titile">キー</td>
                          </tr>
                          <?php
                          $count=0;
                          $numberOfQuestion=count($question);
                          for($i=0;$i<$numberOfQuestion;$i++)
                          {
                          	$count++;
                          	if($count%2==0)
                          	   echo "<tr class='row_chan'>";
                            else
                               echo "<tr>";
                               
                               echo '<td>'.($i+1).'</td>';
                               echo '<td>'.$replyJSONArray[$i][0].'</td>';
                               echo '<td>'.$question[$i].'</td>';
                               if($replyJSONArray[$i][2]=="monoqs"||$replyJSONArray[$i][2]=="multiqs")
                               {
                               	preg_match_all('!\d+!', $replyJSONArray[$i][1], $matches);
                               	
                               		echo '<td>';
                               		echo "<ul>";
                               		foreach ($matches[0] as $answeredAnswer)
                               		{
                               			echo "<li>";
                               			print_r($answer[$i]->$answeredAnswer);
                               			echo "</li>";
                               		}
                               		echo "</ul>";
                               		echo '</td>';
                               }
                               else
                               {
                               	echo '<td>';
                               	echo "<ul>";
                               	$pieces = explode(",",$replyJSONArray[$i][1]);
                               	foreach ($pieces as $answeredAnswer)
                               	{
                               		echo "<li>";
                               		print_r($answeredAnswer);
                               		echo "</li>";
                               	}
                               	echo "</ul>";
                               	echo '</td>';
                               }
                               echo '<td>'.$score_item[$i].'</td>';
                               echo '<td>';
                               echo "<ul>";

                               	echo "<li>";
                               	print_r($key[$i]);
                               	echo "</li>";

                               echo "</ul>";
                               echo '</td>';
                               
                          }
//                             $count=0;
//                             if($numberOfAllTests>0){
//                                 foreach ($bookletList as $item) {
//                                     $count++;
//                                     if($count%2==0)
//                                         echo "<tr class='row_chan'>";
//                                     else
//                                         echo "<tr>";
//                                     echo '<td>'.$item['subject'].'</td>';
//                                     echo '<td>'.$item['description'].'</td>';
//  									echo '<td>'.$item['upload_date'].'</td>';
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

											
// 											echo '<td> <a href="'.base_url()."examinee/dotest/gettest/".$item['booklet_id'].'">Do this test</a></td>';
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
//                                 }
//                             }
                          ?>
                    </tbody>
                   </table>
</div>
</div>