$(function(){


  $('.btn-ajax').on('click', function() {


    var origin = $('#origin').val();  // 出発地
    var destination = $('#destination').val();  // 帰着地
    var waypoints = [];  // 経由地
    
    $('.waypoint').each(function(index, waypoint){
      waypoints.push(waypoint.value);
    })


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
    })


    // Ajaxリクエストが成功した時発動
    .done(json => {

      var status = json['status'];

      if (status > 0) {

        var route = json['route'];
        var copyrights = json['copyrights'];

        route.forEach((place, index) => {
          if (0 < index && index < route.length - 1) {
            $('.waypoint').eq(index - 1).val(place);
          }
        });

        $('#alert').show();

      } else {

        console.log(json['log']);

      }
    })


    // Ajaxリクエストが失敗した時発動
    .fail( (data) => {
      console.log(data);
    })


    // Ajaxリクエストが成功・失敗どちらでも発動
    .always( (data) => {
       
    });


  });
});