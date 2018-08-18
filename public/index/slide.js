
$(function(){
	slide.tab();
	slide.vote();
})
var slide=slide||{};
(function(obj){
    var c=0,a=z=0;
    var tab=function(){
        $(".tuya img").on("click",function(){ 
            return false;
            var index = $(this).parent().index();
            var i=$(this).parent().index()+1;
            var length = $(".tuya img").length;
            var txt = $(this).nextAll(".txt").html();
            var txtinfo = $(this).nextAll(".txtinfo").html();
            var url=$(this).attr("original");
            var img=new Image();
            img.src=url;
            var arr=[i,length,txt,img,txtinfo];
            getImageS(img,creat,arr);
        })
    };
    function getImageS(img,f,arr,time){
       if(img.complete){
          f.apply(this,arr);
       }else{
           (function(img,f,arr){
                var time=null;
                time=setInterval(function(){
                   clearS(img,f,arr,time)
                },50)
            })(img,f,arr);
       }
   }
   function clearS(img,f,arr,time){
       if(img.complete){
           clearInterval(time);
           f.apply(this,arr);
       }
   }
   function creat(i,length,txt,img,txtinfo){
       if($(".popup").length==0){
           var html='<div class="popupdiv"></div><div class="popup"><div id="close"></div><div class="show_box" style="min-width:500px;positon:absolute;"><div><img src="'+img.src+'" width="'+(img.width)+'" height="'+(img.height)+'" /><div class="txt">'+txt+'</div><div class="txtinfo" style="max-width:1000px;">'+txtinfo+'</div>';
           if(i==1){
               html+='<div class="left contral" style="display:none"></div>';
           }else{
               html+='<div class="left contral"></div>';
           }
            if(i==length){
                html+='<div class="right contral" style="display:none"></div>';
            }else{
                html+='<div class="right contral"></div>';
            }
            html+='</div></div></div>';
            $("body").append(html);
            $(".popupdiv,.popup").css({
                "height":fix()._height,
                "width":fix()._width,
                "top":fix().top,
                "left":fix().left
            })
            $(".show_box").css({
                "position":"absolute",
                "top":(fix()._height-$(".show_box").height())/2,
                "left":(fix()._width-$(".show_box").width())/2
            })
            $(window).on("scroll resize",function(){
                $(".popupdiv,.popup").css({
                    "height":fix()._height,
                    "width":fix()._width,
                    "top":fix().top,
                    "left":fix().left
                })
                $(".show_box").css({
                    "position":"absolute",
                    "top":(fix()._height-$(".show_box").height())/2,
                    "left":(fix()._width-$(".show_box").width())/2
                })
            })
            $("#close").click(function(){
                $(".popupdiv,.popup").remove();
            })
            $(".show_box .contral").on("click",function(){
                var index = $(".show_box .contral").index($(this));
                var img=new Image();
                if(index){
                    i++;
                    if(i>length){
                        i=length;
                        $(this).hide();
                        return;
                    }else{
                        $(".show_box .contral").show();
                    }
                }else{
                    i--;
                    if(i<0){
                        i=0;
                        $(this).hide();
                        return;
                    }else{
                        $(".show_box .contral").show();
                    }
                }
                var txt = $(".tuya li").eq(i-1).find(".txt").html();
                var txtinfo = $(".tuya li").eq(i-1).find(".txtinfo").html();
                img.src=$(".tuya li").eq(i-1).find("img").attr("original");
                $(".show_box img").animate({
                   "opacity": 0
                },500,function(){
                    $(".show_box img").attr("src",img.src);
                    if(i==length){
                        $(".show_box .contral").eq(1).hide();
                    }
                    else if(i==1){
                        $(".show_box .contral").eq(0).hide();
                    }
                    var arr=[img.src,length,txt,index,txtinfo];
                    getImageS(img,contral,arr);
                })
            })
            function contral(imgSrc,length,txt,index,txtinfo){
                $(".show_box img").animate({
                    "opacity": 1
                },500,function(){
                   $(".show_box .txt").html(txt); 
                   $(".show_box .txtinfo").html(txtinfo);
                   $(".show_box").css({
                        "position":"absolute",
                        "top":(fix()._height-$(".show_box").height())/2,
                        "left":(fix()._width-$(".show_box").width())/2
                    }) 
                });
            }
        }
   }
    function fix(){
        var b_width=document.documentElement.clientWidth,
            b_height= document.documentElement.clientHeight;
        var scrollLeft=document.body.scrollLeft+document.documentElement.scrollLeft,
            scrollTop=document.body.scrollTop+document.documentElement.scrollTop;
        var left,right,_left,_right;
        return{
            _width:b_width,   //可见宽
            _height:b_height,    //可见高
            left_box : b_width/2+scrollLeft,
            top_box:b_height/2+scrollTop,
            left:scrollLeft,
            top:scrollTop
        }
    }
    obj.tab=tab;
})(slide);
(function(obj){
    obj.vote=function(){
        $(".tuya .vote").on("click",function(){
            if($(this).hasClass("hadvote")){    //Have had voted
                return;
            }
            if($(".hadvote").length==3){      //More than three times
                if($(".NY-pop-warp").length<1){
                   var pop=hm.popbox({
                        'title':'',
                        'html':'<div class="attention_info"><i class="attention_img"></i>明天再来为他们加油吧~</div><div class="attention_btn">我知道了</div>',
                        'callBack':function(d){
                            d.popobj.find(".attention_btn").on("click",function(){ 
                                d.close();
                            });
                        }
                    }); 
                }
                return;
            }
            var _$this = $(this);
            $.ajax({
                url:'api.php?action=userVote&item_id='+$(this).attr("voteid"),
                success:function(d){
                    var d = eval("("+d+")");
                    callbackF.call(this,_$this,d);
                }
            })
            function callbackF(dom,d){
                if(d.status==1){
                    dom.addClass("hadvote");
                    hm.toast({'text':'投票成功！'});
                    var num=Number(dom.html());
                    num++;
                    dom.html(num);
                }else if(d.status==2){
                    hm.popBox({title:'提示',html:'<div class="rz_content"><p class="rz_txt">您尚未通过校方认证，<br />暂不能投票！</p></div><div class="rz_action"><a href="#" id="rz_okbtn" class="rz_onbtn">立即认证</a></div>',width:'290',callBack:callFn});
                    function callFn(){
                        $("#rz_okbtn").click(function(){
                            location.href='http://old.yiban.cn/set/real?type=person';
                        });
                    }
                }else if(d.status==0){
                    hm.toast({'text':'投票失败！'+d.msg});
                }
            }
        })
    }
})(slide);
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
