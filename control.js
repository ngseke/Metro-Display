var bl_chinese = ['忠孝復興', '忠孝新生', '善導寺', '台北車站', '西門', '龍山寺', '江子翠', '新埔'];
var bl_english = ['Zhongxiao Fuxing', 'Zhongxiao Xinsheng', 'Shandao Temple', 'Taipei Main Station', 'Ximen', 'Longshan Temple', 'Jiangzicui', 'Xinpu'];
var bl_english = ['Zhongxiao Fuxing', 'Zhongxiao Xinsheng', 'Shandao Temple', 'Taipei Main Station', 'Ximen', 'Longshan Temple', 'Jiangzicui', 'Xinpu'];
var bl_english_scale = [.8, .75, .9, .8, 1, 1, 1, 1];
var curr = 0;

$('#next').click(function () {

  $('.main_station_name').not('.d-none.eng').text(bl_chinese[curr]);
  $('.main_station_name.eng').text(bl_english[curr]);
  var c_ani = ''.concat('scale_', bl_english_scale[curr] * 100);

  $('title').html(c_ani);
  $('.main_station_name.eng').addClass(c_ani);
  $('.main_station_name.eng').text(bl_english[curr]);
  $('.main_station_name.eng').removeClass('scale_075');

  $('.main_station_name_box').removeClass('main_station_name_box').addClass('main_station_name_box');
 
  curr++;

});
