
$(function() {

  //セレクトボックスが切り替わったら発動
  $('#departure').change(function() {

    //選択したvalue値を変数に格納
    var depdate = $(this).val();

    //選択したvalue値をp要素に出力
    $('#arrival').attr('min', depdate);
  });

  $("#abiko").hide() ;

// function myfunc(value) {
//  var abiko = document.getElementById("abiko");
//
// 	if(abiko.style.display=="block"){
// 		// noneで非表示
// 		abiko.style.display ="none";
// 	}else{
// 		// blockで表示
// 		abiko.style.display ="block";
// 	}
// }

});



// var depdate = $('#departure').attr('value');
// $('#arrival').attr('min', depdate);
