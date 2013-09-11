<!-- Author: Ngo Anh Tuan
This file is for simulating a particular test
Date created: 09/04/2013
-->
<!-- 
CSS for the countdown timer
-->
<style>
#countdown
{
font-family: tahoma;
font-weight: bold;
font-size: 40px;
}
</style>


<script language="JavaScript" type="text/JavaScript">
<!--
//TestType, tell us the test is Fix or Unfix
testType="<?php echo $testType;?>";
forceNextIdentifier='normal';
testTimeUnfixed=<?php echo $testTime;?>*60;
BookletJSArray=Array();
numberOfQuestion=<?php echo $numberOfQuestion?>;
startDoingEachQuestion=0;
var t;
var disabledByExpired='';
var expired_time=<?php echo strtotime($expired_date)*1000?>;
var expiredDialogShowed=0;
//Get data from PHP to Javascript
<?php 
$i=0;
for($i=0;$i<$numberOfQuestion;$i++)
{
	?>
	Type="<?php echo $type[$i]?>";//field 0
	Question="<?php echo $question[$i];?>";//field 1
	Selection=new Array(
<?php 
$stringOfAvailableAnswer="";
foreach ($answer[$i] as $ans)
{
	$stringOfAvailableAnswer=$stringOfAvailableAnswer.'"'.$ans.'",';

}
$stringOfAvailableAnswer=substr($stringOfAvailableAnswer,0,-1);
echo $stringOfAvailableAnswer;
?>
			);//field 2
	Answer=Array("","","");//field 3
	multi_select=<?php echo $multi_select[$i]?>;//field 4
	each_time=<?php echo $each_time[$i]?>;//field 5
	
	BookletJSArray[<?php echo $i;?>]=new Array(Type,Question,Selection,Answer,multi_select,each_time);
	<?php 
	
}
?>
//Finish initializing Array

//Some essential function
function arrayIsEmpty(array)
{
	if(array && array.length>0)
		return false;
		return true;
}

function getTheTime()
{
	var currentdate = new Date();

	
	    var month = currentdate.getMonth() + 1;
	    var day = currentdate.getDate();
	    var dateOfString = (("" + day).length < 2 ? "0" : "") + day + "-";
	    dateOfString += (("" + month).length < 2 ? "0" : "") + month + "-";
	    dateOfString += currentdate.getFullYear()+" ";

	

	
	var datetime = "";
	datetime += dateOfString;
	datetime += + currentdate.getHours() + ":"
	            + currentdate.getMinutes() + ":"
	            + currentdate.getSeconds();
    return datetime;
}
//Format a time in second as hh:mm:ss
function format_as_time(seconds) {
	var hours=parseInt(seconds/3600);
	var minutes = parseInt((seconds-hours*3600)/60);
	var seconds = seconds -hours*3600- (minutes*60);

	 if(hours<10)
	 hours="0"+hours;
	 if (minutes < 10) {
	 minutes = "0"+minutes;
	 }

	 if (seconds < 10) {
	 seconds = "0"+seconds;
	 }

	 var return_var = hours+':'+minutes+':'+seconds;

	 return return_var;
	 }
//countdown essential function
function countDown(timeInSecond,functionWhenTimeout)
{
		clearTimeout(t);
	 var countdown_output = document.getElementById('countdown');
	 countdown_output.innerHTML = format_as_time(timeInSecond);
	 t=setTimeout("update_clock(\"countdown\", "+timeInSecond+","+functionWhenTimeout+")", 1000);

}

function update_clock(countdown_div, new_value,functionWhenTimeout) {
	 var countdown_output = document.getElementById(countdown_div);
	 var new_value = new_value - 1;

	 if (new_value > 0) {
	 new_formatted_value = format_as_time(new_value);
	 countdown_output.innerHTML = new_formatted_value;
	var currentDateInMilis=new Date();
	var currentTimeInMilis=currentDateInMilis.getTime();

	if (currentTimeInMilis>=expired_time)
	{
		disabledByExpired=' disabled ';
		if(expiredDialogShowed==0)
		{
			alert("このテストは有効期限がきれている。あなたはテストの残りが見えるが、他の機能ができない!");
			expiredDialogShowed=1;
			var inputs=document.getElementsByTagName("input");
			for(var k=0;k<inputs.length;k++)
				inputs[k].setAttribute("disabled","disabled");
		}
		/*if(testType=="Unfix")
		{
			displayQuestion(currentQuestionNumber);
		}
		else
			displayQuestionFixed(currentQuestionNumber);*/

		
	}
	 t=setTimeout("update_clock(\"countdown\", "+new_value+","+functionWhenTimeout+")", 1000);
	 } else {
	 functionWhenTimeout();
	 }
	 }

//When init the window, hide the questions
window.onload=function()
{
	currentQuestionNumber=0;
	document.getElementById("question").style.display="none";	
}
//Start the test after the start button is clicked
function startDoingTest()
{
	
	document.getElementById("question").style.display="block";
	document.getElementById("welcome_test").style.display="none";
	if(testType=="Unfix")
	{
		displayQuestion(currentQuestionNumber);
		countDown(testTimeUnfixed, forceSubmitByTimeOut);
	}
	else
		displayQuestionFixed(currentQuestionNumber);
}

//Display question with the number of this question
function displayQuestion(questionNumber)
{
	
	currentQuestionNumber=questionNumber;
	numberOfPossibleAnswer=BookletJSArray[questionNumber][2].length;

	document.getElementById("question").innerHTML="<strong>Question " + (questionNumber+1)+":"+ BookletJSArray[questionNumber][1]+" </strong>	";


		if(BookletJSArray[questionNumber][0]=="QS")
				{
					textForQuestionSelection="";
					var countNumberOfItemOnTheCheckedItems=0;
					doHaveToCheck="";
					for(var i=0;i<numberOfPossibleAnswer;i++)
					{
						if(arrayIsEmpty(BookletJSArray[questionNumber][3][1])==false)
						{
						//if(BookletJSArray[questionNumber][3][1][countNumberOfItemOnTheCheckedItems]==BookletJSArray[questionNumber][2][i])
					if(BookletJSArray[questionNumber][3][1][countNumberOfItemOnTheCheckedItems]=="S("+(i+1)+")")
						
						{
							doHaveToCheck="checked";
							countNumberOfItemOnTheCheckedItems=countNumberOfItemOnTheCheckedItems+1;
						}
						else
						{
							doHaveToCheck="";
						}
						}
						//Multiselect or not, checkbox or radio
						if(BookletJSArray[questionNumber][4]==1)
							textForQuestionSelection=textForQuestionSelection+"<input"+disabledByExpired+" type='checkbox' name='"+questionNumber+"' id='"+i+"' value='"+'S('+(i+1)+')'+"'"+doHaveToCheck+">"+BookletJSArray[questionNumber][2][i]+"<br>";
						if(BookletJSArray[questionNumber][4]==0)
							textForQuestionSelection=textForQuestionSelection+"<input "+disabledByExpired+"type='radio' name='"+questionNumber+"' id='"+i+"' value='"+'S('+(i+1)+')'+"'"+doHaveToCheck+">"+BookletJSArray[questionNumber][2][i]+"<br>";
					}
					document.getElementById("possible_answer").innerHTML=textForQuestionSelection;
					
					
				}

		if(BookletJSArray[questionNumber][0]=="QW")
		{
			textForQuestionSelection="";
			textEntered="";
			for(var i=0;i<numberOfPossibleAnswer;i++)
			{
				if(arrayIsEmpty(BookletJSArray[questionNumber][3][1])==false)
				{
					textEntered=BookletJSArray[questionNumber][3][1][i];
				}
				
				textForQuestionSelection=textForQuestionSelection+"<input "+disabledByExpired+"type='text' name='"+questionNumber+"' maxlength='"+BookletJSArray[questionNumber][2][i]+"' value='"+textEntered+"'><br>";
			}
			document.getElementById("possible_answer").innerHTML=textForQuestionSelection;
			
		}
		buttonToDisplay="";
		if(questionNumber==0)
		{
			buttonToDisplay="<button disabled='disabled'><< 前</button><button onclick='next("+questionNumber+")'>次 >></button>";
		}
		else
		{
			if(questionNumber+1==<?php echo $numberOfQuestion?>)
			{
				buttonToDisplay="<button onclick='prev("+questionNumber+")'><< 前</button><button disabled onclick='submit()' >>>>あなたの答えを提出<<<<</button>";
				document.getElementById("explain_simulate_test").innerHTML= "<p align='center'> これはテストのシミュレート, 提出できない!</p>";
			}
			else
				buttonToDisplay="<button onclick='prev("+questionNumber+")'><< 前</button><button onclick='next("+questionNumber+")' >次 >></button>";
		}

		document.getElementById("prev_back_button").innerHTML=buttonToDisplay;
	
}




//When the test is Unfix and the next button is pressed
function next(current)
{
	currentSelectionArray=document.getElementsByName(current);
	time=getTheTime();
	tempAnswer=Array();
	for(var intLoop=0;intLoop<currentSelectionArray.length;intLoop++)
	{	
		//Validate that what the system get is the checked box or the text box
		if(currentSelectionArray[intLoop].checked==true||currentSelectionArray[intLoop].type=='text')
		{
			tempAnswer.push(currentSelectionArray[intLoop].value);
		}
	}
	typeMultiSelect="";

	//get the multiselect attribute of question. If it is multiqs, it has a "true" multi_select attribute at the field [4].
	//If the Answer array has multi value(length>1) and the type of question is text, it must be the multiqw question
	if(BookletJSArray[current][4]==1)
		typeMultiSelect="multiqs";
	if(BookletJSArray[current][4]==0)
		typeMultiSelect="monoqs";
	if(tempAnswer.length==1&&currentSelectionArray[0].type=='text')
		typeMultiSelect="monoqw";
	if(tempAnswer.length>1&&currentSelectionArray[0].type=='text')
		typeMultiSelect="multiqw";

	
	tempArray=Array(time,tempAnswer,typeMultiSelect);
	BookletJSArray[current][3]=tempArray;
	displayQuestion(current+1);
}


//When the test is unfix and the previous button is pressed
function prev(current)
{
	currentSelectionArray=document.getElementsByName(current);
	time=getTheTime();
	tempAnswer=Array();
	typeMultiSelect="";
	for(var intLoop=0;intLoop<currentSelectionArray.length;intLoop++)
	{	
		if(currentSelectionArray[intLoop].checked==true||currentSelectionArray[intLoop].type=='text')
		{
			tempAnswer.push(currentSelectionArray[intLoop].value);
		}
	}

	//copy from next()
	if(BookletJSArray[current][4]==1)
		typeMultiSelect="multiqs";
	if(BookletJSArray[current][4]==0)
		typeMultiSelect="monoqs";
	if(tempAnswer.length==1&&currentSelectionArray[0].type=='text')
		typeMultiSelect="monoqw";
	if(tempAnswer.length>1&&currentSelectionArray[0].type=='text')
		typeMultiSelect="multiqw";
	tempArray=Array(time,tempAnswer,typeMultiSelect);
	BookletJSArray[current][3]=tempArray;
	displayQuestion(current-1);
}

//This is the necessary function, it's used to get the answered array which is written in the next or prev fuction
function getAnswerArray()
{
	answerArray=Array();
	for(var intLoop=0;intLoop<numberOfQuestion;intLoop++)
	{
		//Answer array is the string, not an array -  requested by Nam
		var time=BookletJSArray[intLoop][3][0];
		var type=BookletJSArray[intLoop][3][2];
		var stringArray="";
		for(var i=0;i<BookletJSArray[intLoop][3][1].length;i++)
			stringArray=stringArray+BookletJSArray[intLoop][3][1][i]+',';
		stringArray=stringArray.slice(0,-1);
		answerArray[intLoop]=Array(time,stringArray,type);
	}

	return answerArray;
}

//When the test is unfix, and the submit button at the end of the test is pressed. 
function submit()
{
	if(confirm("いま答えを提出しますか？提出の後, 答えが修正できない. 続行しますか？"))
	{
		//get the last question
		currentSelectionArray=document.getElementsByName(numberOfQuestion-1);
		time=getTheTime();
		tempAnswer=Array();
		typeMultiSelect="";
		for(var intLoop=0;intLoop<currentSelectionArray.length;intLoop++)
		{	
			//Validate that what the system get is the checked box or the text box
			if(currentSelectionArray[intLoop].checked==true||currentSelectionArray[intLoop].type=='text')
			{
				tempAnswer.push(currentSelectionArray[intLoop].value);
			}
		}
		
		//copy from next()
		if(BookletJSArray[numberOfQuestion-1][4]==1)
			typeMultiSelect="multiqs";
		if(BookletJSArray[numberOfQuestion-1][4]==0)
			typeMultiSelect="monoqs";
		if(tempAnswer.length==1&&currentSelectionArray[0].type=='text')
			typeMultiSelect="monoqw";
		if(tempAnswer.length>1&&currentSelectionArray[0].type=='text')
			typeMultiSelect="multiqw";
		
		tempArray=Array(time,tempAnswer,typeMultiSelect);
		BookletJSArray[numberOfQuestion-1][3]=tempArray;

		
		jsonString=JSON.stringify(getAnswerArray());

		
	}
	else
	{
		
	}
	sendResult ();
}

function displayQuestionFixed(questionNumber)
{
	currentQuestionNumber=questionNumber;
	date=new Date();
	startDoingEachQuestion=date.getTime();
	numberOfPossibleAnswer=BookletJSArray[questionNumber][2].length;

	document.getElementById("question").innerHTML="<strong>質問 " + (questionNumber+1)+":"+ BookletJSArray[questionNumber][1]+" </strong>	";


		if(BookletJSArray[questionNumber][0]=="QS")
				{
					textForQuestionSelection="";
					var countNumberOfItemOnTheCheckedItems=0;
					doHaveToCheck="";
					for(var i=0;i<numberOfPossibleAnswer;i++)
					{
						if(arrayIsEmpty(BookletJSArray[questionNumber][3][1])==false)
						{
						//Fixed 10/4
						//if(BookletJSArray[questionNumber][3][1][countNumberOfItemOnTheCheckedItems]==BookletJSArray[questionNumber][2][i])
						if(BookletJSArray[questionNumber][3][1][countNumberOfItemOnTheCheckedItems]=="S("+(i+1)+")")
						
						{
							doHaveToCheck="checked";
							countNumberOfItemOnTheCheckedItems=countNumberOfItemOnTheCheckedItems+1;
						}
						else
						{
							doHaveToCheck="";
						}
						}
						if(BookletJSArray[questionNumber][4]==1)
							textForQuestionSelection=textForQuestionSelection+"<input "+disabledByExpired+"type='checkbox' name='"+questionNumber+"' id='"+i+"' value='"+'S('+(i+1)+')'+"'"+doHaveToCheck+">"+BookletJSArray[questionNumber][2][i]+"<br>";
						if(BookletJSArray[questionNumber][4]==0)
							textForQuestionSelection=textForQuestionSelection+"<input "+disabledByExpired+"type='radio' name='"+questionNumber+"' id='"+i+"' value='"+'S('+(i+1)+')'+"'"+doHaveToCheck+">"+BookletJSArray[questionNumber][2][i]+"<br>";
					}
					document.getElementById("possible_answer").innerHTML=textForQuestionSelection;
					
					
				}

		if(BookletJSArray[questionNumber][0]=="QW")
		{
			textForQuestionSelection="";
			textEntered="";
			for(var i=0;i<numberOfPossibleAnswer;i++)
			{
				if(arrayIsEmpty(BookletJSArray[questionNumber][3][1])==false)
				{
					textEntered=BookletJSArray[questionNumber][3][1][i];
				}
				
				textForQuestionSelection=textForQuestionSelection+"<input "+disabledByExpired+"type='text' name='"+questionNumber+"' maxlength='"+BookletJSArray[questionNumber][2][i]+"' value='"+textEntered+"'><br>";
			}
			document.getElementById("possible_answer").innerHTML=textForQuestionSelection;
			
		}
		buttonToDisplay="";

			buttonToDisplay="<button onclick='forceNext("+questionNumber+")'>次>></button>";
			countDown(BookletJSArray[currentQuestionNumber][5], forceNext);
			if(questionNumber+1==<?php echo $numberOfQuestion?>)
			{
				buttonToDisplay="<button disabled onclick='forceSubmit()' >>>>あなたの答えを提出<<<<</button>";
				document.getElementById("explain_simulate_test").innerHTML= "<p align='center'> これはテストのシミュレートなので、あなたの答えを提出できない!</p>";
				
				countDown(BookletJSArray[currentQuestionNumber][5], forceSubmitByTimeOut);
			}


		document.getElementById("prev_back_button").innerHTML=buttonToDisplay;
}

//function Next for the Fixed question

function forceNext(current)
{
	current=currentQuestionNumber;
	date=new Date();
	endDoingEachQuestion=date.getTime();
	currentSelectionArray=document.getElementsByName(current);
	time=(endDoingEachQuestion-startDoingEachQuestion)/1000;
	tempAnswer=Array();
	for(var intLoop=0;intLoop<currentSelectionArray.length;intLoop++)
	{	
		//Validate that what the system get is the checked box or the text box
		if(currentSelectionArray[intLoop].checked==true||currentSelectionArray[intLoop].type=='text')
		{
			tempAnswer.push(currentSelectionArray[intLoop].value);
		}
	}
	typeMultiSelect="";

	//get the multiselect attribute of question. If it is multiqs, it has a "true" multi_select attribute at the field [4].
	//If the Answer array has multi value(length>1) and the type of question is text, it must be the multiqw question
	if(BookletJSArray[current][4]==1)
		typeMultiSelect="multiqs";
	if(BookletJSArray[current][4]==0)
		typeMultiSelect="monoqs";
	if(tempAnswer.length==1&&currentSelectionArray[0].type=='text')
		typeMultiSelect="monoqw";
	if(tempAnswer.length>1&&currentSelectionArray[0].type=='text')
		typeMultiSelect="multiqw";

	
	tempArray=Array(time,tempAnswer,typeMultiSelect);
	BookletJSArray[current][3]=tempArray;
	displayQuestionFixed(current+1);
}

function forceSubmit()
{
	if(confirm("いま答えを提出しますか？提出の後, 答えが修正できない. 続行しますか？"))
	{
		date=new Date();
		endDoingEachQuestion=date.getTime();
		//get the last question
		currentSelectionArray=document.getElementsByName(numberOfQuestion-1);
		time=(endDoingEachQuestion-startDoingEachQuestion)/1000;
		tempAnswer=Array();
		typeMultiSelect="";
		for(var intLoop=0;intLoop<currentSelectionArray.length;intLoop++)
		{	
			//Validate that what the system get is the checked box or the text box
			if(currentSelectionArray[intLoop].checked==true||currentSelectionArray[intLoop].type=='text')
			{
				tempAnswer.push(currentSelectionArray[intLoop].value);
			}
		}
		
		//copy from next()
		if(BookletJSArray[numberOfQuestion-1][4]==1)
			typeMultiSelect="multiqs";
		if(BookletJSArray[numberOfQuestion-1][4]==0)
			typeMultiSelect="monoqs";
		if(tempAnswer.length==1&&currentSelectionArray[0].type=='text')
			typeMultiSelect="monoqw";
		if(tempAnswer.length>1&&currentSelectionArray[0].type=='text')
			typeMultiSelect="multiqw";
		
		tempArray=Array(time,tempAnswer,typeMultiSelect);
		BookletJSArray[numberOfQuestion-1][3]=tempArray;

		
		jsonString=JSON.stringify(getAnswerArray());
	}
	else
	{
		
	}
	


	sendResult ();
}

function forceNextByTimeOut()
{
	
}

function forceSubmitByTimeOut()
{
	alert("いま答えを提出しますか？提出の後, 答えが修正できない. 続行しますか？");

	/*date=new Date();
	endDoingEachQuestion=date.getTime();
	//currentQuestionNumber is a global element
	currentSelectionArray=document.getElementsByName(currentQuestionNumber);
	time=(endDoingEachQuestion-startDoingEachQuestion)/1000;
	tempAnswer=Array();
	typeMultiSelect="";
	for(var intLoop=0;intLoop<currentSelectionArray.length;intLoop++)
	{	
		//Validate that what the system get is the checked box or the text box
		if(currentSelectionArray[intLoop].checked==true||currentSelectionArray[intLoop].type=='text')
		{
			tempAnswer.push(currentSelectionArray[intLoop].value);
		}
	}
	
	//copy from next()
	if(BookletJSArray[currentQuestionNumber][4]==1)
		typeMultiSelect="multiqs";
	if(BookletJSArray[currentQuestionNumber][4]==0)
		typeMultiSelect="monoqs";
	if(tempAnswer.length==1&&currentSelectionArray[0].type=='text')
		typeMultiSelect="monoqw";
	if(tempAnswer.length>1&&currentSelectionArray[0].type=='text')
		typeMultiSelect="multiqw";
	
	tempArray=Array(time,tempAnswer,typeMultiSelect);
	BookletJSArray[currentQuestionNumber][3]=tempArray;

	
	jsonString=JSON.stringify(getAnswerArray());
	sendResult ();*/
}



	

//Sending JSON result to controller
function sendResult () {
  var theForm, newInput1;
  // Start by creating a <form>
  theForm = document.createElement('form');
  theForm.action = '<?php echo base_url()."examinee/dotest/sendResult/".$booklet_id?>';
  theForm.method = 'post';
  // Next create the <input>s in the form and give them names and values
  newInput1 = document.createElement('input');
  newInput1.type = 'hidden';
  newInput1.name = 'jsonString';
  newInput1.value =jsonString;
  // Now put everything together...
  theForm.appendChild(newInput1);
  // ...and it to the DOM...
  document.getElementById('hidden_form_container').appendChild(theForm);
  // ...and submit it
  theForm.submit();
}
//-->
</script>

<div id="box_display">

                  <!-- Paging -->

               	 <div id="welcome_test" align="center">
                  <p align="center"><strong><big><big><big><?php echo $subject?></big></big></big></strong></p>
                  <p align="center"><strong>質問数: <?php echo $numberOfQuestion?></strong>
                  <p align="center">テストするタイム: <?php echo $testTime?> minutes.</p>  
                  <p align="center">開始のタイム: <?php echo $starting_date?>.</p>  
                  <p align="center">完了のタイム: <?php echo $expired_date?>. </p>  
                  <button onclick="startDoingTest()"> スタット >></button> 
                             
               	 </div>
               	 <br/><br>
                <div id="question_unit"align="center">
                
                
                <p id="question" ></p>
                <p id="possible_answer" align="left"></p>
                <p id="prev_back_button"></p>    
                <div id="countdown"></div> 
                <div id="explain_simulate_test"></div>         
                </div>
                <div id="hidden_form_container" style="display:none;"></div>
                
<form action="<?php echo base_url()."examinee/testlist"?>" name="question></form>
				
</div>