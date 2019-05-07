<!DOCTYPE html>
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>{{env('APP_NAME')}}</title>
    <script type="text/javascript" src="/js/jquery-3.4.1.js"></script>

    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- 可选的 Bootstrap 主题文件（一般不用引入） -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>
<body>
<div id="main">
    <form action="{{url("/score3")}}" style="text-align: center" method="post" id="mmp">
        @foreach($questions as $item)
            <div style="text-align: left">
                <p style="text-align: left" class="question">&nbsp;&nbsp;{{$sum++}}. {{$item->question}}</p><br>
            </div>

        @endforeach
        <input type="submit" value="提交" class="btn btn-primary">
    </form>
</div>
<script>
    $(document).ready(function(){
        $(".question").each(function(){
                var str = $(this).text();
                re = new RegExp("____","g");
//第一个参数是要替换掉的内容，第二个参数"g"表示替换全部（global）。
                var Newstr = str.replace(re,'<input type="text">');
//本例会将全部匹配项替换为第二个参数。
                alert(Newstr); //内容为：abc
            $(this).replaceWith(Newstr);
            }
        );

    });
</script>
</body>