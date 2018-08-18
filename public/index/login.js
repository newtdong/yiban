/**
 * @author zhuwenlong
 */
var start = function () {
	return start['init'].apply(start , arguments);
};
(function (exports , golbal) {
	var popHtml = null;
	exports.init = function () {
	};
	/**
	 * NAMESPACE.login
	 * @param {Function} callbakc	when login success,execute callback.
	 */
	exports.login = function (callbakc) {
		popHtml || ( popHtml = $('#loginbox').html());
		$('#loginbox').remove();
		hm.popBox({
			'title' : '登录' ,
			'width' : 388 ,
			'html' : popHtml
		});
		//username placeholder
		var username = $('.login_area_block_input:eq(0)');
		var usernameV = username.val();
		var vcode = $('.login_area_block_input:eq(2)');
		var vcodeV = vcode.val();
		palceholder(vcode);
		palceholder(username);
		//remember username
		if (Mtool.cookie.getCookie('dname') !== '' && Mtool.cookie.getCookie('dname')) {
			$('.login_area_block_input:eq(0)').val(Mtool.cookie.getCookie('dname'));
			checkv.apply(username);
		};
		username.blur(function () {
			checkv.apply($(this));
		});
		function checkv () {
			vcode.val('');
			var key = $.trim($(this).val());
			if (key == '' || key == usernameV) {
				return false;
			}
			$.ajax({
				url : '/api.php?action=isNeedVerify&ndverify=true' ,
				data : {
					'_u' : key
				} ,
				success : function (data) {
					var data = eval('(' + data + ')');
					if (data.code !== '1') {
						$('.login_area_block:eq(2)').show();
						$('.login_area_block_img').attr('src' , '/api.php?action=getVerify&_c=true&random=' + Math.random());
					} else {
						$('.login_area_block:eq(2)').hide();
					}
				}
			});
		};
		function palceholder (dom) {
			var oldtips = dom.val();
			dom.focus(function () {
				if (dom.val() == oldtips) {
					dom.val('');
				}
			}).blur(function () {
				if (dom.val() == '') {
					dom.val(oldtips);
				}
			});
		};
		//password placeholder
		var password = $('.login_area_block_input:eq(1)');
		var passwordV = password.val();
		password.focus(function () {
			$('.login_area_block_ptips').hide();
		}).blur(function () {
			if ($(this).val() == '') {
				$('.login_area_block_ptips').show();
			}
		});
		$('.login_area_block_ptips').click(function () {
			password.focus();
		});
		password.keydown(function(){
			if(event.keyCode=='13'){
				$('.login_area_block .fancyBtn').click();
			}
		});
		//login
		$('.login_area_block .fancyBtn').click(function (event) {
			if (username.val() == usernameV) {
				hm.toast({
					'text' : '请填写用户名'
				});
				return false;
			}
			if (password.val() == '') {
				hm.toast({
					'text' : '请输入密码'
				});
				return false;
			}
			if ($('.login_area_block_check').attr('checked') === "checked") {
				document.cookie = 'dname=' + username.val();
			} else {
				document.cookie = 'dname=';
			}
			$.ajax({
				url : '/api.php?action=Login&_p=tru' ,
				data : {
					'_u' : username.val() ,
					'_s' : password.val() ,
					'_c' : vcode.val() || 0
				} ,
				success : function (data) {
					var data = eval('(' + data + ')');
					if (data.code !== '1') {
						hm.toast({
							'text' : data.tips
						});
					} else {
						callbakc && callbakc();
					}
				}
			});
			event.preventDefault();
		});
	};
	/**
	 * NAMESPACE.reg
	 * @param {Function} callbakc	when login success,execute callback.
	 */
	exports.reg = function () {
		error = {
			phone : false ,
			phonev : false ,
			email : false ,
			password : false ,
			password2 : false
		}
		//email check
		$('.OP_email').focus(function () {
			error.email = false;
			$('.OP_emailT').hide();
		}).blur(function () {
			var that = $(this);
			if (!(/^[\w|\d|\.]*@[\w|\d]*\.[\w|\d]*$/.test(that.val()))) {
				$('.OP_emailT span').eq(0).removeClass().addClass('formIcoFa')
				$('.OP_emailT span').eq(1).html('请输入正确的邮箱');
				$('.OP_emailT').show();
				return false;
			}
			$.ajax({
				//'url' : '/ajax/user_appeal.php?action=findsame&type=reg&sthname=email' ,
				'url' : '/api.php?action=findsame&type=reg&sthname=email' ,
				'data' : {
					'sth' : that.val()
				} ,
				'success' : function (data) {
					var data = eval('(' + data + ')');
					if (data.emailFind == 'unknow') {
						$('.OP_emailT span').eq(0).removeClass().addClass('formIcoOk')
						$('.OP_emailT span').eq(1).html('');
						$('.OP_emailT').show();
						error.email = true;
					} else {
						$('.OP_emailT span').eq(0).removeClass().addClass('formIcoFa')
						$('.OP_emailT span').eq(1).html('邮箱已被注册请更换');
						$('.OP_emailT').show();
					}
				}
			});
		});
		//phone check
		var ajaxpro=false;
		var vcodeClick=false;
		$('.OP_phone').focus(function () {
			error.phone = false;
			$('.OP_phoneT').hide();
		}).blur(function () {
			var that = $(this);
			var key = parseInt($.trim(that.val()));
			if ($.trim(that.val()) == '') {
				return false;
			}
			that.val(key);
			if (key.toString().length !== 11) {
				$('.OP_phoneT span').eq(0).removeClass().addClass('formIcoFa')
				$('.OP_phoneT span').eq(1).html('请输入正确的手机格式');
				$('.OP_phoneT').show();
				return false;
			}
			//check exist
			ajaxpro=true;
			$.ajax({
				//'url' : '/ajax/user_appeal.php?action=findsame&type=reg&sthname=phone_num' ,
				'url' : '/api.php?action=findsame&type=reg&sthname=phone_num' ,
				'data' : {
					'sth' : that.val()
				} ,
				'success' : function (data) {
					ajaxpro=false;
					var data = eval('(' + data + ')');
					if (data.phone_numFind == 'unknow') {
						$('.OP_phoneT span').eq(0).removeClass().addClass('formIcoOk')
						$('.OP_phoneT span').eq(1).html('');
						$('.OP_phoneT').show();
						error.phone = true;
						error.phonev = false;
					} else {
						$('.OP_phoneT span').eq(0).removeClass().addClass('formIcoFa')
						$('.OP_phoneT span').eq(1).html('手机已被注册请更换');
						$('.OP_phoneT').show();
					}
					if(vcodeClick){
						showvcode();
					}
				}
			});
		});
		//get vcode
		bindgetvcode();
		function bindgetvcode () {
			$('.mobCheGet').on('click' , function () {
				if(ajaxpro){
					vcodeClick=true;
				}else{
					vcodeClick=false;
					showvcode();
				}
			});
		};
		function showvcode () {
			if (!error.phone) {
				hm.toast({
					'text' : '请正确输入手机号码'
				});
				return false;
			}
			$('.vcode_s1').show();
			error.phonev = true;
			getvcode();
			$('.mobCheGet').unbind('click');
			regetvcode();
		};
		function getvcode () {
			var phone = $('.OP_phone').val();
			$.ajax({
				'url' : '/api.php?action=sendVerifyCode' ,
				'data' : {
					'mobile' : phone
				} ,
				'success' : function (data) {
					var data = data;
				}
			});
		}
		function regetvcode () {
			var total = 60;
			var tar = $('.mobCheGet');
			tar.css('color' , '#999').html(total + '秒后重新获取');
			var interId = setInterval(function () {
				total--;
				tar.css('color' , '#999').html(total + '秒后重新获取');
				if (total <= 0) {
					clearInterval(interId);
					tar.css('color' , '#333').html('重新获取验证码');
					bindgetvcode();
				};
			} , 1000);
		}
		//checkpassword
		$('.OP_password').blur(function () {
			error.password = false;
			var key = $(this).val();
			if (key.length >= 6) {
				error.password = true;
				$('.OP_passwordT span').eq(0).removeClass().addClass('formIcoOk')
				$('.OP_passwordT span').eq(1).html('');
				$('.OP_passwordT').show();
			} else {
				$('.OP_passwordT span').eq(0).removeClass().addClass('formIcoFa')
				$('.OP_passwordT span').eq(1).html('密码不能小于六位');
				$('.OP_passwordT').show();
			}
		});
		//checkpassword2
		$('.OP_password2').blur(function () {
			error.password2 = false;
			var key = $(this).val();
			if (key == $('.OP_password').val()) {
				error.password2 = true;
				$('.OP_password2T span').eq(0).removeClass().addClass('formIcoOk')
				$('.OP_password2T span').eq(1).html('');
				$('.OP_password2T').show();
			} else {
				$('.OP_password2T span').eq(0).removeClass().addClass('formIcoFa')
				$('.OP_password2T span').eq(1).html('两次输入的密码不同');
				$('.OP_password2T').show();
			}
		});
		//submit
		$('.OP_submit').click(function (event) {
			if (error.email && error.phone && error.phonev && error.password && error.password2) {
				var name = $('input[name="name"]').val();
				var phone = $('.OP_phone').val();
				var phonev = $('.OP_phonev').val();
				var password = $('.OP_password').val();
				var email = $('.OP_email').val();
				//check phone
				$.ajax({
					url : '/api.php?action=verifyCode' ,
					data : {
						'code' : phonev ,
						'mobile' : phone
					} ,
					success : function (data) {
						var data = eval('(' + data + ')');
						if (data.status == 1) {
							//submitform
							$.ajax({
								'url' : '/api.php?action=register' ,
								'data' : {
									'email' : email ,
									'name' : name ,
									'passwd' : password ,
									'sex' : '男'
								} ,
								'success' : function (data) {
									var data = eval('(' + data + ')');
									if (data.status == 1) {
										$.ajax({
											'url' : '/api.php?action=regSavePhone' ,
											'data' : {
												'mobile' : phone
											} ,
											'success' : function (data) {
												var data = eval('(' + data + ')');
												if (data.status == 1) {
													hm.toast({
														'text' : '注册成功' ,
														timeout : 20000
													});
													setTimeout(function () {
														location.href = "/apply.php";
													} , 2000);
												} else {
													hm.toast({
														'text' : '手机保存失败'
													});
												}
											}
										});
									} else {
										hm.toast({
											'text' : '注册提交失败'
										});
									}
								}
							})
							//
						} else {
							hm.toast({
								'text' : '手机验证码错误'
							});
						}
					}
				});
				//submit reg phone
				// $.ajax({
				// 'url':'/api.php?action=regSavePhone',
				// 'data':{'mobile':phone},
				// 'success':function(data){
				//
				// }
				// });
			} else {
				var tips = '请填写完成所有必填项';
				if (!error.email) {
					tips = '邮箱填写有误';
				}
				if (!error.phone) {
					tips = '手机号码填写有误';
				}
				if (!error.phonev) {
					tips = '验证码填写有误';
				}
				if (!error.password) {
					tips = '密码填写有误';
				}
				if (!error.password2) {
					tips = '密码填写有误.';
				}
				hm.toast({
					'text' : tips
				})
			}
			event.preventDefault()
		})
	};
})(start , this);
$(function () {
	start.reg();
})
