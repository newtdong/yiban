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
<div id="main" style="text-align: center">
    @if($score>89)
        您答了{{$score}}分，真是太棒了！
        @elseif($score>79)
        您答了{{$score}}分，还不错呦！
        @else
        您答了{{$score}}分，谢谢参与！
        @endif
</div>

    <script>
        function baominglink(uid) {
            if (uid && uid > 0) {
                return true;
            }
            alert('请先登录！');
            return false;
        }
    </script>

    <div class="xinwen" style="display: none; padding: 20px 0px; opacity: 0;">
        <ul class="newslist">
            <p style="text-align:center;font-size:20px;color:#666;padding:50px 0;">暂无新闻速递</p>
        </ul>
        <div class="pages">
        </div>
    </div>

    <div class="clearfix" style="opacity: 0; display: none;"></div>

</div>

<script type="text/javascript">

</script>
