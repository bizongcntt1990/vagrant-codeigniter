<div id="box_display">
<div id="list_table">
                  <!-- Paging -->
                  <div id="paging" class="pagination">
                  <?php
                    if($num_rows>0){
                        echo $link;
                        echo " |　人数 : ".$num_rows;
                    }
                  ?>
                  </div>

                    <table width="75%" cellpadding="2" cellspacing="2">
                          <tbody>
                          <tr>
                            <td width="20%" class="table_titile">ユーザー名</td>
                            <td width="20%" class="table_titile">名前</td>
                            <td width="20%" class="table_titile">タイプ</td>
                            <td width="20%" class="table_titile">メール</td>
                            <td width="20%" class="table_titile">修正</td>
                          </tr>
                          <?php
                            $count=0;
                            if($num_rows>0){
                                foreach ($users as $item) {
                                	if ($item['type']!="10000" && $item['user_id']!=$id){
                                		
                                	
                                    $count++;
                                    if($count%2==0)
                                        echo "<tr class='row_chan'>";
                                    else
                                        echo "<tr>";
                                    echo '<td>'.$item['username'].'</td>';
                                    echo '<td>'.$item['name'].'</td>';
                              		if ($item['type']=="01000"){
                              			echo '<td>団体管理者</td>';
                              		}else if ($item['type']=="00100"){
                              			echo '<td>出題者</td>';
                              		}else if ($item['type']=="00010"){
                              			echo '<td>採点者</td>';
                              		}else if ($item['type']=="00001"){
                              			echo '<td>回答者</td>';
                              		}
                                  	echo '<td>'.$item['email'].'</td>';
                                  	if ($item['type']!="01000"){
                                  		if ($item['type']=="00001"){
											echo '<td class="alt">
                                             <a href="'.base_url().'admin/user/delete/'.$item['user_id'].'" >削除</a>
                                         	</td>';	
											                                  			
                                  		}else{
                                  			echo '<td class="alt">
                                            <a href="'.base_url().'admin/user/edit/'.$item['user_id'].'">修正</a>
                                            <a href="'.base_url().'admin/user/delete/'.$item['user_id'].'" >削除</a>
                                         	</td>';	
                                  		}
                                  			
                                  	}else{
                                  		echo '<b><td class="alt">許可がない！ </td></b>';
                                  	}
                                    
                                    echo "</tr>";  
                                }
                                }
                            }
                          ?>
                    </tbody>
                   </table>
</div>
</div>