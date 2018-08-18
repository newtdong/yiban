/**
 * function list
 * form
 * 		getNumber(dom)
 * 		warn(dom)
 * 		placeHolder(dom)
 * 		count(inputDom,resultDom,totalInt)
 * cookie
 * 		getCookie(cName)
 * 		setCookie(sName)
 * date
 * 		format(time)
 */
var Mtool = Mtool || {}
//
Mtool.form = {}
Mtool.form.getNumber = function (dom) {
	var theString = $.trim(dom.val());
	var theLength = theString.length;
	var backLength = 0;
	for (var i = 0; i < theLength; i++) {
		if (/[\u4e00-\u9fa5]/.test(theString.charAt(i))) {
			backLength += 1;
		} else {
			backLength += 0.5;
		}
	}
	return Math.ceil(backLength);
}
Mtool.form.warn = function (dom) {
	var oldColor = dom.css('border-color');
	var count = 0;
	dom.css('border-color' , 'red');
	var theInterval = setInterval(function () {
		count++;
		if (count % 2 == 0) {
			dom.css('border-color' , 'red');
		} else {
			dom.css('border-color' , oldColor);
		}
		if (count == '5') {
			clearInterval(theInterval);
		}
	} , 200)
};
Mtool.form.placeHolder = function (dom) {
	var domLength = dom.length;
	for (var i = 0; i < domLength; i++) {
		var theDom = dom.eq(i);
		(function (theDom) {
			var oldValue = theDom[0].defaultValue || theDom.val();
			theDom.focus(function () {
				var that = $(this);
				if (that.val() == oldValue) {
					that.val('');
				}
			}).blur(function () {
				var that = $(this);
				if (that.val() == '') {
					that.val(oldValue);
				}
			})
		})(theDom);
	}
}
Mtool.form.count = function(dom,result,total){
	var oldColor=result.css('color');
	dom.on('keyup',function(){
		var resultVal=$(this).val();
		var totalLength=0;
		for(var i=0;i<resultVal.length;i++){
			re=/[\u4e00-\u9fa5]/;
			if(re.test(resultVal.charAt(i))){
				totalLength++;
			}else{
				totalLength+=0.5;
			}
		};
		var totalLength=Math.ceil(totalLength);
		if(totalLength>total){
			result.css('color','red');
		}else{
			result.css('color',oldColor);
		}
		result.html(totalLength+'/'+total);
	});
};
//
Mtool.cookie = {};
Mtool.cookie.getCookie = function (sName) {
	var aCookie = document.cookie.split(';');
	var len = aCookie.length;
	for (var i = 0; i < len; i++) {
		var aCrumb = aCookie[i].split('=');
		if (trim(sName) == trim(aCrumb[0])) {
			return aCrumb[1];
		}
	}
	function trim (sString) {
		return sString.replace(/^(\s*| *)/ , '').replace(/(\s*| *)$/ , '');
	}
	return null;
};
Mtool.cookie.setCookie = function SetCookie (name , value) {
	var Days = 30;
	var exp = new Date ();
	exp.setTime(exp.getTime() + Days * 24 * 60 * 60 * 1000);
	document.cookie = name + "=" + escape(value) + ";expires=" + exp.toGMTString();
}
//
Mtool.date = {};
Mtool.date.format = function (time) {
	var test=time.match(/\//g);
	if(!(test&&test.length<=2)){
		window.console&&console.log('ops,you need give me a date linke "2012/01,2012/01/01"');
		return false;
	}
	var date=time.split('/');
	var thatYear,thatMonth,thatDay;
	thatYear=date[0];
	thatMonth=date[1];
	if(test.length==2){
		thatDay=date[2];
	};
	var temDate=new Date();
	temDate.setFullYear(thatYear);
	temDate.setMonth(thatMonth-1);
	if(thatDay){
		temDate.setDate(thatDay);
		return {
			time:temDate,
			date:temDate.getDay()
		}
	}else{
		var year=temDate.getFullYear();
		var month=temDate.getMonth()+1;
		temDate.setDate(1);
		var firestDay=temDate.getDay();
		temDate.setMonth(month);
		temDate.setDate(0);
		totaldays=temDate.getDate();
		temDate.setMonth(month-1);
		temDate.setDate(totaldays);
		lastDay=temDate.getDay();
		return {
			year:year,
			month:month,
			totaldays:totaldays,
			firestDay:firestDay,
			lastDay:lastDay
		}
	}
}
//