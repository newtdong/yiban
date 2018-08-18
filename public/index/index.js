
$(function(){
	main.tab();
	main.init();
    main.judgelogin();
})
var main={};
(function(dom){
	dom.tab=function(d){
		function displayF(d){
			this.id = d.id;
			this.id_c = d.id_c;
			this.main();
			this.addEvent();
		}
		displayF.prototype={
			main:function(){
				this.dom = $("#"+this.id).find("a");
				this.con = $("#"+this.id_c+">div");
				if(this.dom.length!==this.con.length){
					return false;
				}
			},
			addEvent:function(){
				var _this = this;
				var hash = window.location.hash;
				var name = $("#welfare").attr("data-name");
				this.addModule(hash.replace('#','')||name);
				this.dom.each(function(){
					$(this).on("click",function(){
					    var hash = window.location.hash=$(this).attr("href");
						_this.addModule(hash.replace('#',''));
					})
				})
			},
			/*addModule:function(hash){
			    this.dom.removeClass("act");
			    $("."+hash+"O").addClass("act");
				var _this = this;
				this.con.stop().animate({
				    //height:0,
                    opacity:0
				},300,function(){
				    $(this).css({display:'none'})
				    $("."+hash).css("display","block");
				    $("."+hash).stop().animate({
                        //height:'1526px',
                        opacity:1
                    },600)
				})
			}*/
		}
		new displayF({
			id:"head",
			id_c:"main"
		})
	}
})(main);
(function(d){
    d.pagessss=function(){
        function page(dom){
			this.id = dom.id;
            this.nowPage = dom.nowPage;//   当前页
            this.listNum = dom.listNum;// 当前显示条数
            this.allNum = dom.allNum;   //总数量
            this.interim = dom.interim;    //左右过渡几条
            this.pageNum=Math.ceil(this.allNum/this.listNum);
        }
        page.prototype={
            addHtml:function(){
                var html = '<div class="pages">';
                if((this.nowPage-this.interim)-1 >= 0 && (this.nowPage-this.interim)-1<=2){
                    html += '<a href="'+(this.nowPage-1)+'"><<上一页</a>';
                    for(var i=1;i<=this.nowPage-this.interim;i++){
                        html += '<a href="">'+i+'</a>';
                    }
                }
                else if((this.nowPage-this.interim)-1>2){
                    html += '<a href="'+(this.nowPage-1)+'"><<上一页</a>';
                    html += '<a href="1">1</a>';
                    html += '<a href="javascript:;" class="ellipsis">…</a>';
                    for(var i=this.nowPage-this.interim;i<this.nowPage;i++){
                        html += '<a href="">'+i+'</a>';
                    }
                }
                html += '<a href="">'+this.nowPage+'</a>';
                if(this.pageNum-(this.nowPage+this.interim)>=0&&this.pageNum-(this.nowPage+this.interim)<=2){
                    for(var i=this.nowPage+1;i<=this.pageNum;i++){
                        html += '<a href="">'+i+'</a>';
                    }
                    html += '<a href="'+(this.nowPage+1)+'">下一页&gt;&gt;</a>';
                }
                else if(this.pageNum-(this.nowPage+this.interim)>2){
                    for(var i=this.nowPage+1;i<=(this.nowPage+this.interim);i++){
                        html += '<a href="">'+i+'</a>';
                    }
                    html += '<a href="javascript:;" class="ellipsis">…</a>';
                    html += '<a href="">'+this.pageNum+'</a>';
                    html += '<a href="'+(this.nowPage+1)+'">下一页&gt;&gt;</a>';
                }
				$("#"+this.id).html(html);
            }
        } 
        /*new page({
            nowpage:1,
            listNum:7,
            allNum:35,
            interim:1
        })*/
    }
})(main);
/*
 *layUI
 * select
 */
(function(d){
    d.select = function (obj) {
        var slt = obj || $('select.layUI');
        slt.each(function (i) {
            var Li = slt.eq(i);
            if (!Li.hasClass('layUIOver')) {
                var sltUI = Li.html().replace(/<\/option>/gi ,'</a>').replace(/<option/gi , '<a href="javascript:void(0)"').replace(/selected\=\"selected\"/gi , 'class="on"');
                var UI = $('<div class="layUISlt noSelect"><div class="layUISltOn"><span>' + Li.find('option:selected').html() + '</span><i class="layUISltOnIco"></i></div><div class="layUISltCnt" style="z-index:' + (100 - i) + '"><div class="layUISltCntLi">' + sltUI + '</div></div></div>');
                Li.after(UI);
                show(UI);
                Li.addClass('layUIOver');
                if($("#opusType").val()==""){
                    oisshow(Li.find('option:selected'));
                }else{
                    //if($("#opusType").val()==2)
                    oisshow(Li.find('option:selected'),$("#opusType").val());
                }
            }
        });
        var B;
        function hideLi (e) {
            var dx = e.clientX;
            var dy = e.clientY;
            if (dx < B.offset().left - $(document).scrollLeft() || dx > B.offset().left - $(document).scrollLeft() + B.width() || dy < B.offset().top - $(document).scrollTop() - 30 || dy > B.offset().top - $(document).scrollTop() + B.height()) {
                B.stop().animate({
                    height : 0
                } , 150);
                $('body').unbind('mousedown' , hideLi);
            }
        }
        function show (obj) {
            var li = obj.find('.layUISltCntLi a');
            obj.find('.layUISltOn').click(function () {
                var $this = $(this);
               
                B = $(this).parent().find('.layUISltCnt');
                if (B.height() < 5) {
                    B.stop().animate({
                        height : B.find('.layUISltCntLi').height()
                    } , 100 , 'swing');
                    $('body').bind('mousedown' , hideLi);
                } else { 
                    B.stop().animate({
                        height : 0
                    } , 'slow');
                    $('body').unbind('mousedown' , hideLi);
                } 
            });
            obj.on('click' , '.layUISltCntLi a' , function () { 
                li.removeClass('on');
                $(this).addClass('on');
                obj.find('.layUISltOn span').html($(this).html());
                obj.prev().trigger('change');
                obj.prev().find('option').attr({
                    selected : false
                }).eq($(this).index()).attr({
                    selected : true
                });
                B.stop().animate({
                    height : 0
                } , 'fast');
                $(this).attr("tid");
                oisshow($(this));
            });
        }
        function strlen(str, to_word) {
            var to_word = to_word || true;
            var count = 0;
            var arr = str.split('');
            var len = arr.length;
            for (var i = 0; i < len; i++) {
                if (arr[i].charCodeAt(0) < 299) {
                    count++;
                } else {
                    count += 2;
                }
            }
            return to_word ? Math.ceil(count / 2) : count;
        }
        function oisshow(dom,issecond){ 
            var val = dom.attr("value");
            var dd = dom.attr("data-info");

            if(val=="0_2"){ 
                var html = '<select vc="all" class="layUI second" name="plane_type" data-is="1">'+
                                '<option data-info="juben" value="1_1">原创征文</option>'+
                                '<option data-info="donghua" value="1_2" >影像征集</option>'+
                                '<option data-info="sheji" value="1_3" >主题摄影</option>'+
                            '</select>'; 
                $("#box").html(html);
                dom.attr("data-has",2);
                d.select();
                return;             
            } else if(val == "1_1"){
                var _html = $("#juben_place").html();
                document.getElementById("uploadC").innerHTML=_html;
                $('#content textarea').bind('input propertychange', function() {
                    var v = $(this).val();
                    var length = strlen(v);
                    if(length>2000) {
                        $('#content .length span').html(length).addClass('red')
                    } else {
                        $('#content .length span').html(length).removeClass('red')
                    }
                })
                $("#opusType").val(1);
                d.select();
            } else if(val == "1_2"){
                var _html = $("#donghua_place").html();
                document.getElementById("uploadC").innerHTML=_html;
                $("#opusType").val(2);
                d.select();
            } else if(val == "1_3"){
                var _html = $("#sheji_place").html();
                document.getElementById("uploadC").innerHTML=_html;
                $("#opusType").val(3);
                d.select();
            } else if(val == "1_4"){
                var _html = $("#sheji2_place").html();
                document.getElementById("uploadC").innerHTML=_html;
                $("#opusType").val(4);
                d.select();
            }
			up.begin();
        }
    }
    d.init = function () {
        $('select').length && this.select()
    }
})(main);
(function(d){
})(main);
(function(dom){
    dom.judgelogin=function(){
        var _this = this;
        $('.SignBtn').on('click' , function () {
            if($('.SignBtn').attr('logined')=='true'){
                location.href="/apply.php"
            }else{
                _this.login();
            }
        });
        $('.hasApply em').on('click',function(){
           location.href = "http://www.yiban.cn/login/index?go=http://proj.yiban.cn/project/gongyi/index.php#baoming";
            //登录弹层
            //start.login(function(){
               // window.location.href = 'index.php#baoming';
               // window.location.reload();
            //})
        })
    },
    dom.login=function(){
        var html = $('#signTpl').html();
        hm.popBox({
            'title' : '请选择' ,
            'width' : 390 ,
            'html' : html ,
            'callBack' : function (d) {
                d.popobj.on('click' , '.fan_login' , function () {
                    d.close();
                    start.login(function () {
                        window.location.href = 'apply.php';
                    });
                })
            }
        })
    }
})(main);
var dream = dream || {};
//焦点图
(function(ex) {
	var focusShow = function(dom) {
		var dom = dom;
		var pic = dom.find('li');
		var picW = pic.width();
		var picH = pic.height();
		var total = pic.length;
		var cur = -1;
		var btn = '';
		for (var s = 0; s < total; s++) {
			btn = btn + '<li>' + (s + 1) + '</li>'
		}
		picW=422;
		var btnDom = '<div class="picBtn"><ul>' + btn + '</ul></div>';
		dom.append(btnDom);
		var picBtn = dom.find('.picBtn li');
		pic.css({
			position : 'absolute',
			top : '0',
			left : picW,
			zIndex : '80'
		});
		function run(to) {
			var oldNo, newNo;
			oldNo = cur;
			if (to) {
				newNo = parseInt(to);
			} else {
				cur >= total - 1 ? newNo = 0 : newNo = cur + 1;
			}
			cur = newNo;
			for (var s = 0; s < total; s++) {
				pic.eq(s).css({
					zIndex : parseInt(pic.eq(s).css('zIndex')) - 1
				})
			}
			pic.eq(oldNo).css({
				zIndex : 99,
				left : 0
			}).stop().animate({
				left : -picW
			}, 1000);
			pic.eq(newNo).css({
				zIndex : 100,
				left : picW
			}).stop().animate({
				left : 0
			}, 400);
			picBtn.removeClass('on').eq(newNo).addClass('on');
		}
		run();
		var timer = setInterval(run, 5000);
		picBtn.click(function() {
			var __ = $(this);
			if (__.attr('class') != 'on') {
				run(__.index().toString());
			}
		});
		dom.mouseenter(function() {
			clearInterval(timer);
		}).mouseleave(function() {
			timer = setInterval(run, 5000);
		});
	}
	ex.slidePic = focusShow;
})(dream);
$(function(){
	if ($('.xwFocusA').length) {
		dream.slidePic($('.xwFocusA'));
	}
});
