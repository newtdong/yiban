<!DOCTYPE html>
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>填空题录入</title>
{{--    <script type="text/javascript" src="/js/jquery-3.4.1.js"></script>--}}
    <script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

{{--    <!-- 可选的 Bootstrap 主题文件（一般不用引入） -->--}}
{{--    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">--}}

    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-1 col-lg-6 col-lg-offset-1" >
            <form action="{{url('/inputing')}}" class="form-horizontal" role="form">
                <div class="form-group">
                    <label for="name">问题</label>
                    <textarea class="form-control" type="text" placeholder="请输入题面" name="que" id="tex1"></textarea>
                </div>
                <input id="but" type="button">weweqqq</input>
                <div class="form-group">
                    <label for="ans">答案1</label>
                    <input class="form-control" type="text" name="ans1">
                </div>
                <div class="form-group">
                    <label for="ans">答案2</label>
                    <input class="form-control" type="text" name="ans2">
                </div>
                <div class="form-group">
                    <label for="ans">答案3</label>
                    <input class="form-control" type="text" name="ans3">
                </div>
                <div class="form-group">
                    <label for="ans">答案4</label>
                    <input class="form-control" type="text" name="ans4">
                </div>
                <input type="submit" value="提交" class="btn btn-default">


            </form>
        </div>
    </div>

</div>
<p>dsds</p>
<button id="ch_button" value="插入" >插入</button>
<textarea name="content" id="test_in" rows="30" cols="100"></textarea>
<script >
    $(function() {
        /* 在textarea处插入文本--Start */
        (function($) {
            $.fn.extend({
                insertContent : function(myValue, t) {
                    var $t = $(this)[0];
                    if (document.selection) { // ie
                        this.focus();
                        var sel = document.selection.createRange();
                        sel.text = myValue;
                        this.focus();
                        sel.moveStart('character', -l);
                        var wee = sel.text.length;
                        if (arguments.length == 2) {
                            var l = $t.value.length;
                            sel.moveEnd("character", wee + t);
                            t <= 0 ? sel.moveStart("character", wee - 2 * t - myValue.length) : sel.moveStart( "character", wee - t - myValue.length);
                            sel.select();
                        }
                    } else if ($t.selectionStart
                        || $t.selectionStart == '0') {
                        var startPos = $t.selectionStart;
                        var endPos = $t.selectionEnd;
                        var scrollTop = $t.scrollTop;
                        $t.value = $t.value.substring(0, startPos)
                            + myValue
                            + $t.value.substring(endPos,$t.value.length);
                        this.focus();
                        $t.selectionStart = startPos + myValue.length;
                        $t.selectionEnd = startPos + myValue.length;
                        $t.scrollTop = scrollTop;
                        if (arguments.length == 2) {
                            $t.setSelectionRange(startPos - t,
                                $t.selectionEnd + t);
                            this.focus();
                        }
                    } else {
                        this.value += myValue;
                        this.focus();
                    }
                }
            })
        })(jQuery);
        /* 在textarea处插入文本--Ending */
    });
    $(document).ready(function(){
        $("#but").click( function () {
            $("#tex1").insertContent("<upload/day_140627/201406271546349972.jpg>");
        });
    });
</script>

</body>
