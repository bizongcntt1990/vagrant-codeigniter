<?php
    //print_r("\nquestion".$manual[0]['data'][6]['question']->question);
//     print_r("\nscore".$manual[0]['score']);
//     print_r("\nexaminee_id".$manual[0]['examinee_id']);
    //print_r($manual[0]['data'][6]['answer']);
?>

<script language="JavaScript" type="text/JavaScript">
var markArray=Array();
function markEachExaminee(firstScore,name)
{
	newScore=0;
	var object=document.getElementsByName(name);
	for(var i=0;i<object.length;i++)
	{
		newScore=newScore+parseInt(object[i].value);
	}
	return firstScore+newScore;
	
}
function mark()
{
	<?php foreach ($manual as $examinee)
	{
		?>

		examinee_id=<?php echo $examinee['examinee_id'];?>;
		booklet_id=<?php echo $examinee['booklet_id'];?>;
		score=markEachExaminee(<?php echo $examinee['score']?>, <?php echo $examinee['examinee_id']?>);
		markArray.push(Array(examinee_id,score,booklet_id));
		<?php 
	}
	?>
	jsonString=JSON.stringify(markArray);
	
	sendResult();
	
}

function sendResult()
{
	  var theForm, newInput1;
	  // Start by creating a <form>
	  theForm = document.createElement('form');
	  theForm.method = 'post';
	  theForm.action = '<?php echo base_url()."maketest/user/updateNewScore/"?>'+booklet_id;
	  
	  // Next create the <input>s in the form and give them names and values
	  newInput1 = document.createElement('input');
	  newInput1.type = 'hidden';
	  /*for(var i=0;i<markArray.length;i++)
	  {
	  	newInput1.name = markArray[i][0];
	  	newInput1.value =markArray[i][1];
		  theForm.appendChild(newInput1);
		  // ...and it to the DOM...
		  document.getElementById('hidden_form_container').appendChild(theForm);
		  alert(newInput1.value);
	  }*/

	  newInput1.name='jsonString';
	  newInput1.value=jsonString;
	 
	  // Now put everything together
	  // ...and submit it
	    theForm.appendChild(newInput1);
  // ...and it to the DOM...
  document.getElementById('hidden_form_container').appendChild(theForm);
	  theForm.submit();
}
</script>

<!-- 
Author: Ngo Anh Tuan
This file is for manual marking
Date created: 18/03/2013
-->
<div id="box_display">
<div id="list_table">
                  <!-- Paging -->
                  <div id="paging" class="pagination">
                  <?php

                  ?>
                  </div>

                    <table width="75%" cellpadding="2" cellspacing="2">
                          <tbody>
                          <tr>
                            <td width="45%" class="table_titile">質問</td>
                            <td width="45%" class="table_titile">採点者の答え</td>
                            <td width="10%" class="table_titile">点</td>
      
                            
                          </tr>
                          <?php
								$count=1;
                                foreach ($manual as $examinee) {
                                	if(is_array($examinee['data']))
                                	foreach($examinee['data'] as $eachQuestion)
                                	{
                                    $count++;
                                    if($count%2==0)
                                        echo "<tr class='row_chan'>";
                                    else
                                        echo "<tr>";
                                    echo '<td>'.$eachQuestion['question']->question.'</td>';
                                    echo '<td>'.$eachQuestion['answer'][1].'</td>';
 									echo '<td><input type="text" name="'.$examinee['examinee_id'].'"</td>';
                      
                                  	
                                    echo "</tr>";  
                                }
                                }
                            
                          ?>
                          
                    </tbody>
                   </table>
                   <br><br>
                   <div id="submit_botton" align="center"> <button onclick="mark()"> 採点したのをコミット >></button> </div>
                   <div id="hidden_form_container"></div>
</div>
</div>