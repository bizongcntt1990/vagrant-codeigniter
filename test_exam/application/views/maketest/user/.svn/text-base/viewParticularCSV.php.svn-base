<div id="box_display">
<div id="list_table">
                  <!-- Paging -->
                  <div id="paging" class="pagination">
                  <?php
//                     if($num_rows>0){
//                         echo $link;
//                         echo " | メンバーの数 : ".$num_rows;
//                     }
                  ?>
                  </div>

                    <table width="75%" cellpadding="2" cellspacing="2">
                          <tbody>
                          <tr>
                            <td width="5%" class="table_titile">数</td>
                            <td width="5%" class="table_titile">タイプ</td>
                            <td width="5%" class="table_titile">複数タイプ</td>
                            <td width="5%" class="table_titile">タイム</td>
                            <td width="40%" class="table_titile">質問</td>
                            <td width="40%" class="table_titile">キー</td>
                            
                          </tr>
                          <?php
                            $count=0;
                            while($count<count($type)){
                                    
                                    if($count%2==0)
                                        echo "<tr class='row_chan'>";
                                    else
                                        echo "<tr>";
                                    echo '<td>'.($count+1).'</td>';
                                    echo '<td>'.$type[$count].'</td>';
                                    
                                    
                                    if($multi_select[$count]==0)
                                    	echo '<td>'."No".'</td>';
                                    else
                                    	echo '<td>'."Yes".'</td>';
                                    
                                    if($each_time[$count]==0)
                                    	echo '<td>'."Unfixed".'</td>';
                                    else
                                    	echo '<td>'.$each_time[$count].'</td>';
                                    
                                    echo '<td>'.$question[$count].'</td>';
                                    echo '<td>'.$key[$count].'</td>';
                                    $count++;
                                }
                            
                          ?>
                    </tbody>
                   </table>
</div>
</div>