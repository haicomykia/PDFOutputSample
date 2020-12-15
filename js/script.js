function getCheckedBox() {
	return $(".form-check-input:checked").map(function(){
		return $(this).val();
	}).get();
}

function showLogs(jqXHR, textStat, thrownError){
	console.log(jqXHR);
	console.log(jqXHR.status);		// HTTPステータスを取得
	console.log(textStat);				// エラー情報を取得
	console.log(thrownError);			// 例外情報を取得
}