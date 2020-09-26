$(function(){


  $('.btn-ajax').on('click', function() {


    const origin = $('#origin').val();  // 出発地
    const destination = $('#destination').val();  // 帰着地
    
    const waypoints = $('.waypoint').map(function(index, waypoint){
      return waypoint.value;
    }).get();


    // Ajaxリクエスト
    $.ajax({
      url:'backend/ajax.php',
      type:'POST',
      data:{
        origin: origin,
        destination: destination,
        waypoints: waypoints
      },
      dataType: 'json'  // 受け取るデータの型
    })  // セミコロンいるよね？


    // Ajaxリクエストが成功した時発動
    .done(json => {

      const status = json['status'];

      if (status > 0) {

        const route = json['route'];
        const copyrights = json['copyrights'];

        route.forEach((place, index) => {
          if (0 < index && index < route.length - 1) {
            $('.waypoint').eq(index - 1).val(place);
          }
        });

        $('#alert').show();

      } else {

        console.log(json['status']);
        console.log(json['log']);

      }
    })


    // Ajaxリクエストが失敗した時発動
    .fail(json => {
      console.log(json);
    });


  });
});
