$('input[type="submit"]').click(function() {
	var user = $('input[type="text"]').val();
	var password = $('input[type="password"]').val();
	user = user.replace(/\s+/g, "");
	password = password.replace(/\s+/g, "");
	if (user == "") {
		var options = {
			title: "被漆黑的火焰围绕的人啊",
			options: {
				body: "和我漆黑火焰使缔结恋人的契约吧",
				lang: 'zh'
			}
		};
		$("#easyNotify").easyNotify(options);
		return;
	} else if (password == "") {
		var options = {
			title: "隐藏着黑暗力量的钥匙啊",
			options: {
				body: "在我面前显示出你真正的力量吧",
				lang: 'zh'
			}
		};
		$("#easyNotify").easyNotify(options);
		return;
	}
	// 正在验证登陆
	var userinfo = {
		userid: user,
		password: password
	};
	$('.login').addClass('test');
	setTimeout(function() {
		$('.login').addClass('testtwo');
	}, 300);
	setTimeout(function() {
		$('.authent').show().animate({
			right: -320
		}, {
			easing: 'easeOutQuint',
			duration: 600,
			queue: false
		});
		$('.authent').animate({
			opacity: 1
		}, {
			duration: 200,
			queue: false
		}).addClass('visible');
	}, 500);
	$.ajax({
		url: "/index/login",
		type: "post",
		data: userinfo,
		success: function(data) {
			if (data.status == 'success') {
				var options = {
					title: "遵从召唤而来",
					options: {
						body: "我问你,你是我的Master吗?",
						lang: 'zh'
					}
				};
				VerificationEnd(options, data);
			} else if (data.status == 'error') {
				var options = {
					title: "赶紧离开这吧",
					options: {
						body: "你不是我要等的人",
						lang: 'zh'
					}
				};
				VerificationEnd(options, data);
			} else {
				var options = {
					title: "不存在的master",
					options: {
						body: "要来签订契约么？",
						lang: 'zh'
					}
				};
				VerificationEnd(options, data);
			}
		},
		error: function(XMLResponse) {
			console.log("error:" + XMLResponse.responseText);
		}
	});
});

function VerificationEnd(options, data) {
	// 验证完毕
	setTimeout(function() {
		$('.authent').show().animate({
			right: 90
		}, {
			easing: 'easeOutQuint',
			duration: 600,
			queue: false
		});
		$('.authent').animate({
			opacity: 0
		}, {
			duration: 200,
			queue: false
		}).addClass('visible');
		$('.login').removeClass('testtwo');
	}, 1500);
	setTimeout(function() {
		$('.authent').hide();
		$('.login').removeClass('test');
		$("#easyNotify").easyNotify(options);
	}, 1800);
	if (data.status == 'success') {
		// 成功登陆
		$('.login div').fadeOut(120);
		setTimeout(function() {
			$('.success p').prepend(data.username + ",");
			$('.success').fadeIn();
			setTimeout(function() {
				location.href = 'http://iyume.cn';
			}, 1500);
		}, 2200);
	}
}
$('input[type="text"],input[type="password"]').focus(function() {
	$(this).prev().animate({
		'opacity': '1'
	}, 200);
});
$('input[type="text"],input[type="password"]').blur(function() {
	$(this).prev().animate({
		'opacity': '.5'
	}, 200);
});
$('input[type="text"],input[type="password"]').keyup(function() {
	if (!$(this).val() == '') {
		$(this).next().animate({
			'opacity': '1',
			'right': '30'
		}, 200);
	} else {
		$(this).next().animate({
			'opacity': '0',
			'right': '20'
		}, 200);
	}
});
var open = 0;
$('.tab').click(function() {
	$(this).fadeOut(200, function() {
		$(this).parent().animate({
			'left': '0'
		});
	});
});