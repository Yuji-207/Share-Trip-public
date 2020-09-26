$(function() {


  // button
  var btn_clone = $('.btn-clone');
  var btn_remove = $('.btn-remove');


  // btn_remove
  if ($('.waypoint').length >= 2) {
    $(btn_remove).show();  // waypointが2つ以上あるときにbtn_removeを表示
  }


  // clone
  btn_clone.click(function() {

    var waypoint = $('.waypoint').last();

    waypoint
      .clone()
      .val('')
      .insertAfter(waypoint);
    
    if ($('.waypoint').length >= 2) {
      $(btn_remove).show();  // waypointが2つ以上あるときにbtn_removeを表示
    }

  });


  // remove
	btn_remove.click(function() {

    $('.waypoint')
      .last()
      .remove();

    if ($('.waypoint').length < 2) {
      btn_remove.hide();  // waypointが2つ未満のときにbtn_removeを非表示
    }
    
  });
});