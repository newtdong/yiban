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
@isset($status)
@if($status=="success")

    　　<div class="alert alert-success alert-dismissable" role="alert">
        <button type="button" class="close" data-dismiss="alert"
                aria-hidden="true">
            &times;
        </button>
        　　　　题目保存成功，可在本页继续添加！
        　　</div>
@else
    　　<div class="alert alert-success alert-dismissable" role="alert">
        <button type="button" class="close" data-dismiss="alert"
                aria-hidden="true">
            &times;
        </button>
        　　　　保存失败！请联系网站管理员!
        　　</div>
@endif
@endisset
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-1 col-lg-6 col-lg-offset-1" >
            <form action="{{url('/input_save')}}" class="form-horizontal" role="form" method="post">
                <div class="form-group">
                    <label for="name">说明：</label>
                   <p>填空题需填写的部分用4个下划线代替，或光标刚在需要填空位置，点击”插入“按钮</p>
                </div>
                <div class="form-group">
                    <label for="name">问题</label>
                    <button class="btn btn-default" id="but" style="float: right" type="button">插入</button><br><br>
                    <textarea class="form-control" type="text" placeholder="请输入题面" name="que" id="tex1" rows="5"></textarea>
                </div>
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
                <div class="form-group">
                    <label for="ans">答案5</label>
                    <input class="form-control" type="text" name="ans4">
                </div>
                <input type="submit" value="提交" class="btn btn-default">


            </form>
        </div>
    </div>

</div>

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
            $("#tex1").insertContent("____");
        });
    });
</script>

</body>
