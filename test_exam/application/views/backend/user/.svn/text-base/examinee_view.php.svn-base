<div id="box_display">
<h2>テスト情報を送信られる採点者</h2>
<div id="list_table">
                  <!-- Paging -->
                  <div id="paging" class="pagination">
                  <?php
                    if($num_rows>0){
                        echo $link;
                        echo " | Number of member : ".$num_rows;
                    }
                  ?>
                  </div>

                    <table width="75%" cellpadding="2" cellspacing="2">
                          <tbody>
                          <tr>
                            <td width="20%" class="table_titile">ユーザー名</td>
                            <td width="20%" class="table_titile">氏名</td>
                            <td width="20%" class="table_titile">メール</td>
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
                                    echo '<td>'.$item['username'].'</td>';
                                    echo '<td>'.$item['name'].'</td>';
                              		
                                  	echo '<td>'.$item['email'].'</td>';
                                    echo '<td class="alt">
                                            <a href="'.base_url().'admin/user/send_email/'.$item['user_id'].'">Send</a>                                        
                                         </td>';
                                    echo "</tr>";  
                                }
                            }
                          ?>
                    </tbody>
                   </table>
</div>
</div>