function loadCalendar(id) {
	new JsDatePick({
		useMode : 2,
		target : id,
		dateFormat : "%Y-%m-%d",
		cellColorScheme : "aqua"
	});
}

function checkDate() {

	started_day = document.frmEdit.started_day.value;
	expired_day = document.frmEdit.expired_day.value;
	if ((new Date(started_day).getTime() >= new Date(expired_day).getTime())) {
		alert("規約の開始のタイムは規約の締切のタイムより大きいです。もう一度入力してお願いします！");
		document.frmEdit.expired_day.focus();
		return false;
	} else {
		return true;
	}
}