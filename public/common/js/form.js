// UTF-８
$(document).ready(function () {
	// フォームのサブミット
	// $("#btn_submit").click(function(){
	//   $('#form_entry').submit();
	// });

	// 入力画面に戻る
	$("#btn_back").click(function (e) {
		e.preventDefault();
		console.log("aaa");
		$("#form_entry").attr("action", "index.php");
		$("#form_entry").submit();
	});
});
