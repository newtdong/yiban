<!DOCTYPE html>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>不忘改革初心 坚定砥砺前行</title>
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

{{--    <!-- 可选的 Bootstrap 主题文件（一般不用引入） -->--}}
{{--    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"--}}
{{--          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">--}}

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

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    模态框（Modal）标题
                </h4>
            </div>
            <div class="modal-body">
                点击关闭按钮检查事件功能。
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    关闭
                </button>
                <button type="button" class="btn btn-primary">
                    提交更改
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>

        $('#myModal').modal('show');
</script>

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
    <form style="text-align: center" method="get" id="mmp">
        @foreach($sub as $item)
            <div style="text-align: left">
                <p style="text-align: left">&nbsp;&nbsp;{{$sum++}}. {{$item->title}}</p><br>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="{{$item->id}}A" value="A"
                                                      class="{{$item->id}}">{{$item->optionA}}</label><br>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="{{$item->id}}B" value="B"
                                                      class="{{$item->id}}">{{$item->optionB}}</label><br>
                <label>&nbsp;&nbsp;&nbsp;@if($item->optionC)
                        <input type="checkbox" name="{{$item->id}}C" value="C" class="{{$item->id}}">{{$item->optionC}}
                    @endif</label><br>
                <label>&nbsp;&nbsp;&nbsp;@if($item->optionD)
                        <input type="checkbox" name="{{$item->id}}D" value="D" class="{{$item->id}}">{{$item->optionD}}
                    @endif</label>

                <hr>
                </p>
            </div>

        @endforeach
        <input type="button" value="提交" class="btn btn-primary" onclick="check()">
    </form>
    <script>
        function check() {
            var flag = 0;
            var _radio = document.getElementById("mmp").getElementsByTagName("input");//获取单选框集合
            for (var i = 0; i < _radio.length - 1; i++)
                if (_radio[i].checked == true) {
                    flag = 1;
                    break;
                }
            if (!flag) {
                alert("您还未答题，无法提交");
                return false;
            } else {
                var userans = {};
                        @foreach($sub as $item)
                var data = "";
                var t = $(".{{$item->id}}").serializeArray();
                $.each(t, function () {
                    if (this.value)
                        data = data + this.value;
                });
                userans["{{$item->id}}"] = data;

                @endforeach
                $.post("{{url('/score')}}", userans, function (dat) {
                    $('*').html(dat);
                });


            }
        }
    </script>
</div>

