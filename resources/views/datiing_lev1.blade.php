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
    <style>
        .guierziyou {
            border-radius: 5px 5px 0 0;
            outline: none;
            background-color: #ABABAB11;
            border-style: solid;
            border-width: 0 0 1px 0;
        }

    </style>
</head>
<body>
<div class="timer">
    <p>倒计时：<span id="timer"></span>秒</p>
    <script>
        var time ={{env("LEV1_TIMER")}};

        function getRandomCode() {
            if (time === 0) {
                check();
            } else {
                time--;
                $('#timer').text(time);
            }
            setTimeout(function () {
                getRandomCode();
            }, 1000);
        }

        window.onload = function () {
            getRandomCode();
        }
    </script>
</div>
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
            @if($item->flag==1)
                <div style="text-align: left" id="{{$item->id}}">
                    <p style="text-align: left">&nbsp;&nbsp;{{$sum++}}. {{$item->title}}</p><br>
                    <label>&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="{{$item->id}}" value="A"
                                                          class="{{$item->id}}">{{$item->optionA}}</label><br>
                    <label>&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="{{$item->id}}" value="B"
                                                          class="{{$item->id}}">{{$item->optionB}}</label><br>
                    <label>&nbsp;&nbsp;&nbsp;@if($item->optionC)
                            <input type="radio" name="{{$item->id}}" value="C"
                                   class="{{$item->id}}">{{$item->optionC}}
                        @endif</label><br>
                    <label>&nbsp;&nbsp;&nbsp;@if($item->optionD)
                            <input type="radio" name="{{$item->id}}" value="D"
                                   class="{{$item->id}}">{{$item->optionD}}
                        @endif</label>

                    <hr>
                </div>
            @else
                <div style="text-align: left">
                    <p style="text-align: left">&nbsp;&nbsp;{{$sum++}}. {{$item->title}}</p><br>
                    <label>&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="{{$item->id}}A" value="A"
                                                          class="{{$item->id}}">{{$item->optionA}}</label><br>
                    <label>&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="{{$item->id}}B" value="B"
                                                          class="{{$item->id}}">{{$item->optionB}}</label><br>
                    <label>&nbsp;&nbsp;&nbsp;@if($item->optionC)
                            <input type="checkbox" name="{{$item->id}}C" value="C"
                                   class="{{$item->id}}">{{$item->optionC}}
                        @endif</label><br>
                    <label>&nbsp;&nbsp;&nbsp;@if($item->optionD)
                            <input type="checkbox" name="{{$item->id}}D" value="D"
                                   class="{{$item->id}}">{{$item->optionD}}
                        @endif</label>
                    <hr>

                </div>
            @endif
        @endforeach
        @if(isset($questions))
            @foreach($questions as $item)
                <div style="text-align: left">
                    <input type="text" name="{{$item["id"]}}['id']" value="{{$item["id"]}}" readonly hidden>
                    <p style="text-align: left" class="question" id="{{$item["id"]}}">&nbsp;&nbsp;{{$sum++}}
                        . {{$item["question"]}}</p><br>
                    <hr>
                </div>
                <script>

                    $(document).ready(function () {
                        var num = 0;
                        $("#{{$item["id"]}}").each(function (num) {
                                var str = $(this).text();
                                re = new RegExp("____", "g");
                                var rep = '&nbsp;<input type="text" name="{{$item["id"]}}" class="guierziyou" size="13">&nbsp;';
                                // rep = rep + num;
                                // num++;
                                // rep = rep + '';
                                var Newstr = str.replace(re, rep);
                                //alert(num);
                                $(this).replaceWith(Newstr);
                            }
                        );

                    });
                </script>
            @endforeach
        @endif
        <br><br>
        <input type="button" value="提交" class="btn btn-primary" onclick="check()">
    </form>
    <script>
        var flag_time = 0;
        function check() {
            var flag = 0;
            var _radio = document.getElementById("mmp").getElementsByTagName("input");//获取单选框集合
            for (var i = 0; i < _radio.length - 1; i++)
                if (_radio[i].checked == true) {
                    flag = 1;
                    break;
                }
            if (!flag) {
                flag_time++;
                if (flag_time > 0) {
                    alert("亲，时间到了，您还没答题哦！");
                    window.location.reload();
                } else
                    alert("您还未答题，无法提交");
                return false;
            } else {
                var userans = {};
                        @foreach($sub as $item)
                        @if($item->flag==1||$item->flag==NULL)
                var data = "";
                var t = $(".{{$item->id}}:checked").val();

                userans["{{$item->id}}"] = t;

                        @else
                var data = "";
                var t = $(".{{$item->id}}").serializeArray();
                $.each(t, function () {
                    if (this.value)
                        data = data + this.value;
                });
                userans["{{$item->id}}"] = data;
                @endif

                @endforeach
                // userans=JSON.stringify(userans);
                var ans_blank = get_blank();
                var user_ans = {};
                //alert(ans_blank);
                user_ans.ans_select = JSON.stringify(userans);
                user_ans.ans_blank = JSON.stringify(ans_blank);
                if (standardPost("{{url("/score1")}}", user_ans)) {
                    alert("提交错误，请稍后再试");
                }


            }
        }

        function standardPost(url, args) {
            var form = $("<form method='post'></form>");
            form.attr({"action": url});
            for (arg in args) {
                var input = $("<input type='hidden'>");
                input.attr({"name": arg});
                input.val(args[arg]);
                form.append(input);
            }
            $("html").append(form);
            form.submit();
        }

        function get_blank() {
            var ans_blank = new Object();
            var temp = 0;
            $(".guierziyou").each(function () {

                ans_blank[temp++] = $(this).val();
            });
            return ans_blank;
        }
    </script>
</div>


</body>