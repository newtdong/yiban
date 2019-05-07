<!DOCTYPE html>
<!-- saved from url=(0036)http://proj.yiban.cn/project/40znhd/ -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>不忘改革初心 坚定砥砺前行</title>
    <link rel="stylesheet" href="/index/main.css">
    <link rel="stylesheet" href="index/index.css">
    <script type="text/javascript" src="/index/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="/index/Mtool.js"></script>
    <script type="text/javascript" src="/index/hm_popBox.js"></script>
    <script type="text/javascript" src="/index/login.js"></script>
    <script type="text/javascript" src="/index/index.js" id="welfare" data-name="jieshao"></script>
    <script type="text/javascript" src="/index/slide.js"></script>
    <link rel="stylesheet" href="/index/jplayer.blue.monday.css">
    <script type="text/javascript" src="/index/jquery.jplayer.min.js"></script>
    <script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
    <script>
        function page(name, value) {
            var keyValue = name + "=" + value;
            var search = location.search;
            if (search.length > 0) {
                var arr = search.slice(1).split("&");
                for (var i in arr) {
                    var pair = arr[i].split("=");
                    if (pair[0] == name) {
                        arr[i] = keyValue;
                        keyValue = "";
                        break;
                    }
                }
                if (keyValue != "") {
                    arr[arr.length] = keyValue;
                }
                search = arr.join("&");
            } else {
                search = keyValue;
            }
            location.href = "?" + search + "#xinwen";
        }
    </script>
</head>
<body>
<div id="head">
    <div class="head_img">
        <img src="/index/topbg.jpg" style="width: 100%;height: 100%" alt="">
    </div>
    <div class="nav bigspace">
        <ul>
            <li><a href="{{url('/')}}" class="jieshaoO">大赛介绍</a></li>
            <li><a href="{{url('/dati')}}" class="baomingO">在线答题</a></li>
            <li><a href="{{url('rank')}}" class="zuopinO act">排行榜</a></li>
        </ul>
    </div>
</div>
<!-- <div id="main" style="font-size: 22px;text-align: center">
    此功能正在开发中，敬请期待！
</div> -->
<div id="container" style="width: 600px; height:1000px ; margin: 0 auto;margin-top: 120px"></div>
<script language="JavaScript">
$(document).ready(function() {  
   var chart = {
      type: 'bar'
   };
   var title = {
      text: '平均成绩TOP20'   
   };
   var subtitle = {
      text: null  
   };
   var xAxis = {
      categories: [
      @foreach($rank as $item)
      '{{$item->name}}',
    @endforeach
      ],
      title: {
         text: null
      }
   };
   var yAxis = {
      min: 0,
      title: {
         text: '平均成绩',
         align: 'high'
      },
      labels: {
         overflow: 'justify'
      },
      max:100
   };
   var tooltip = {
      valueSuffix: ' 分'
   };
   var plotOptions = {
      bar: {
         dataLabels: {
            enabled: true
         }
      }
   };
   var legend = {
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'top',
      x: -40,
      y: 100,
      floating: true,
      borderWidth: 1,
      backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
      shadow: true
   };
   var credits = {
      enabled: false
   };
   
   var series= [{
         name: '平均成绩',
            data: [
        @foreach($rank as $item)
      {{$item->avage}},
      @endforeach
      ]
        }
   ];     
      
   var json = {};   
   json.chart = chart; 
   json.title = title;   
   json.subtitle = subtitle; 
   json.tooltip = tooltip;
   json.xAxis = xAxis;
   json.yAxis = yAxis;  
   json.series = series;
   json.plotOptions = plotOptions;
   json.legend = legend;
   json.credits = credits;
   $('#container').highcharts(json);
  
});
</script>
</body>
</html>

    
   
    


