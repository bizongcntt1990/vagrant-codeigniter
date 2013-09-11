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
                            <td width="20%" class="table_titile">試験名</td>
                            <td width="20%" class="table_titile">解答者の名前</td>
                            <td width="20%" class="table_titile">結果</td>
                            
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
                                    echo '<td>'.$booklet_name.'</td>';
                                    echo '<td>'.$item['name'].'</td>';
                              		if ($item['result']!= -1)
                              			echo '<td>'.$item['result'].'</td>';
                              		else
                              			echo '<td>0</td>';
                              	
                                    echo "</tr>";  
                                }
                            }
                          ?>
                    </tbody>
                   </table>
                   <a href="<?php echo base_url()."examiner/user/graphic1/".$booklet_id;?>" >グラフ 1</a> 
        		   <a href="<?php echo base_url()."examiner/user/graphic2/".$booklet_id;?>" >グラフ 2</a>
                   
</div>
</div>