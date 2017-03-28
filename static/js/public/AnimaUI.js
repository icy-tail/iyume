$(function(){
	$("head").append("<link rel='stylesheet' href='/static/css/public/AnimaUI.css'>");
	$("._infochild_bottom_ok").live("click",function(){
		closeWnd();
	});
	$("._infochild_bottom_cancel").live("click",function(){
		closeWnd();
		});
	// $(document).bind("contextmenu",function(e){
	// 	$.showImmortal();
	// 	return false;
	// });
});
$(document).ready(function () {	//防止在DOM元素加载完成就执行jQuery代码，从而避免产生不必要的错误
	$("*").keydown(function (e) {	//判断按键
                e = window.event || e || e.which;
                if (e.keyCode == 112 
                    || e.keyCode == 113
                    || e.keyCode == 114 
                    || e.keyCode == 115
                  //|| e.keyCode == 116  	//F5
                    || e.keyCode == 117
                    || e.keyCode == 118 
                    || e.keyCode == 119
                    || e.keyCode == 120 
                    || e.keyCode == 121
                    || e.keyCode == 122 
                    || e.keyCode == 123) {
                    	$.showImmortal();
		return false;
                }
            });
	window.onhelp = function () { 	//ie下面不能屏蔽f1键的补充方法,和上面的一行的效果是一样的，选其一
		$.showImmortal();
		return false;
	 };
});
function addPopupDiv(css){
	$("._mask").remove();
	$("body").prepend("<div class='_mask'>" +
			"<div class='_infownd'>" +
				"<div class='_infochild_top "+css+"'></div>" +
				"<div class='_infochild_middle'>" +
					"<div class='_infochild_middle_context'></div>" +
				"</div>" +
				"<div class='_infochild_bottom'>" +
					"<div class='_infochild_bottom_div'></div>" +
				"</div>" +
			"</div>" +
			"</div>");
};
function openPopup(prompt,data){
	$("._infownd").animate({width: "24%"},200,function(){
		$(this).animate({"margin-top": "91px"},200);
		$("._infochild_middle").animate({height: "100px"},200,function(){
			$("._infochild_bottom_div").append("<button class='_infochild_bottom_ok'></button>");
			if(prompt=="Warning"){
				$("._infochild_bottom_div").append("<button class='_infochild_bottom_cancel'></button>");
			}
			$("._infochild_top").append("<a>"+prompt+"</a>");
			$("._infochild_middle_context").html(data);
		});
	});
};
function closeWnd(){
	$("._infochild_middle_context").html("");
	$("._infownd").animate({width: 0},200);
	$("._mask").animate({opacity: 0},200,function(){
		$(this).remove();
	});
};
function closeMenu(){
	$("._menu").remove();
}
jQuery.extend({
	showWarning: function(data){
		addPopupDiv("_title_warning");
		openPopup("Warning",data);
	},
	showError: function(data){
		addPopupDiv("_title_error");
		openPopup("Error",data);
	},
	showInfo: function(data){
		addPopupDiv("_title_info");
		openPopup("Alert",data);
	},
	showImmortal: function(){
		if($("._immortal").length<=0){
			$("body").prepend("<div class='_immortal'></div>");
			$("._immortal").css({
				left: $(window).width()/2-150+"px"
			});
			$("._immortal").animate({
				height: "126px",
				top: "63px"
			},100,function(){
				setTimeout(function(){
					$("._immortal").animate({
						height: 0,
						top: "126px"
					},100,function(){
						$("._immortal").remove();
					});
				},2000);
			});
		}
	},
	showMenu: function(x, y){
		if($("._menu").length>0){
			$("._menu").css({left: x,top: y});
			return;
		}
		$("body").append("<div class='_menu'></div>");
		$("._menu").css({left: x,top: y});
		$("._menu").prepend("<div class='_menu_item'></div>");
	}
});
