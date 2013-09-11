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

                    <table width="90%" cellpadding="2" cellspacing="2">
                          <tbody>
                          <tr>
                            <td width="15%" class="table_titile">団体 ID</td>
                            <td width="20%" class="table_titile">団体名</td>
                            <td width="20%" class="table_titile">住所</td>
                            <td width="10%" class="table_titile">規約の開始</td>
                            <td width="10%" class="table_titile">規約の終わり</td>
                            <td width="10%" class="table_titile">お金</td>
                            <td width="25%" class="table_titile">修正</td>
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
                                    echo '<td>'.$item['organization_id'].'</td>';
                                    echo '<td>'.$item['organization_name'].'</td>';
                              		echo '<td>'.$item['address'].'</td>';
									echo '<td>'.$item['started_date'].'</td>';
									echo '<td>'.$item['expired_date'].'</td>';
									echo '<td>'.$totalsum[$count-1].'</td>';
                                    echo '<td class="alt">
                                            <a href="'.base_url().'superAdmin/user/or_edit/'.$item['organization_id'].'">修正</a>
                                            <a href="'.base_url().'superAdmin/user/or_delete/'.$item['organization_id'].'" >削除</a>
                                         ' .'<a href="'.base_url().'superAdmin/user/money_reset/'.$item['organization_id'].'" >支払い</a>'.
                                         		'</td>';
                                    echo "</tr>";  
                                }
                            }
                          ?>
                    </tbody>
                   </table>
                   <form name="frmEdit" id="frmEdit" action="" method="post" enctype="multipart-formdata">
        <fieldset>
        <legend>CSVファイルの提出</legend>
        <select name="year">
				<?php for ($i=2010;$i<=2020;$i++){
				?>

				<option value="<?php echo $i?>"><?php echo $i?>
				</option>

				<?php } ?>
			</select>
		<select name="month">
				<?php for ($i=1;$i<=12;$i++){
				?>

				<option value="<?php echo $i?>"><?php echo $i?>
				</option>

				<?php } ?>
			</select>
			<br />
		
        <label>&nbsp;</label> <input type="submit" name="ok" value="提出" /><br />

        </fieldset>
    </form>
</div>
</div>