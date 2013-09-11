<div id="box_display">
<div id="list_table">
                  <!-- Paging -->
                  <div id="paging" class="pagination">
                  <?php
                    if($num_rows>0){
                        echo $link;
                        echo " | 団体数 : ".$num_rows;
                    }
                  ?>
                  </div>

                    <table width="75%" cellpadding="2" cellspacing="2">
                          <tbody>
                          <tr>
                            <td width="20%" class="table_titile">ユーザネーム</td>
                            <td width="20%" class="table_titile">名前</td>
                            <td width="10%" class="table_titile">種類</td>
                            <td width="20%" class="table_titile">メール</td>
                            <td width="10%" class="table_titile">規約の開始</td>
                            <td width="10%" class="table_titile">規約の終わり</td>
                            <td width="20%" class="table_titile">修正</td>
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
                                    echo '<td>'.$item['username'].'</td>';
                                    echo '<td>'.$item['name'].'</td>';
                              		if ($item['type']=="01000"){
                              			echo '<td>団体管理者</td>';
                              		}else if ($item['type']=="00100"){
                              			echo '<td>出題者</td>';
                              		}else if ($item['type']=="00010"){
                              			echo '<td>採点者</td>';
                              		}else if ($item['type']=="00001"){
                              			echo '<td>解答者</td>';
                              		}
                                  	echo '<td>'.$item['email'].'</td>';
                                  	echo '<td>'.$item['started_date'].'</td>';
									echo '<td>'.$item['expired_date'].'</td>';
                                    echo '<td class="alt">
                                            <a href="'.base_url().'superAdmin/user/edit/'.$item['user_id'].'">修正</a>
                                            <a href="'.base_url().'superAdmin/user/delete/'.$item['user_id'].'" >削除</a>
                                         </td>';
                                    echo "</tr>";  
                                }
                            }
                          ?>
                    </tbody>
                   </table>
</div>
</div>