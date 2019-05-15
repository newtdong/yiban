<!DOCTYPE html>
<!-- saved from url=(0036)http://proj.yiban.cn/project/40znhd/ -->
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>不忘改革初心 坚定砥砺前行</title>
    <script type="text/javascript" src="/js/jquery-3.4.1.js"></script>
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- 可选的 Bootstrap 主题文件（一般不用引入） -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/index/main.css">
    <link rel="stylesheet" href="index/index.css">

    <script type="text/javascript" src="/index/Mtool.js"></script>
    <script type="text/javascript" src="/index/hm_popBox.js"></script>
    <script type="text/javascript" src="/index/login.js"></script>
    <script type="text/javascript" src="/index/index.js" id="welfare" data-name="jieshao"></script>
    <script type="text/javascript" src="/index/slide.js"></script>
    <link rel="stylesheet" href="/index/jplayer.blue.monday.css">
    <script type="text/javascript" src="/index/jquery.jplayer.min.js"></script>
</head>
<body>
<div id="head">
    <div class="head_img">
        <img src="/index/topbg.jpg" style="width: 100%;height: 100%" alt="">
    </div>
    <div class="nav bigspace">
        <ul>
            <li><a href="{{url('/')}}" class="jieshaoO">大赛介绍</a></li>
            <li><a href="{{url('/dati')}}" class="baomingO act">在线答题</a></li>
            <li><a href="{{url('rank')}}" class="zuopinO">排行榜</a></li>
        </ul>
    </div>
</div>

<div id="main">
    <div id="main">
        <form action="" style="text-align: center">
            <div style="text-align: center">恭喜你完成第{{$lev}}关，您的第{{$lev}}关分数是{{$score}}，点击按钮进入下一关</div>
            <input type="button" value="进入第{{$lev_n}}关" style="text-align: center" class="btn btn-info" onclick="javascrtpt:window.location.href='{{url($next)}}'">
        </form>
    </div>
</div>
