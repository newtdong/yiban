<!DOCTYPE html>
<!-- saved from url=(0036)http://proj.yiban.cn/project/40znhd/ -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>不忘改革初心 坚定砥砺前行</title>
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- 可选的 Bootstrap 主题文件（一般不用引入） -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
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
            <li><a href="{{url('/dati')}}" class="baomingO act">在线答题</a></li>
            <li><a href="{{url('rank')}}" class="zuopinO">排行榜</a></li>
        </ul>
    </div>
</div>
<div id="main">
    <form action="" style="text-align: center">
        <input type="button" value="开始答题" style="text-align: center" class="btn btn-info" onclick="javascrtpt:window.location.href='{{url('datiing')}}'">
    </form>
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


<script type="text/javascript">

</script>
