function include(url) {
  document.write('<script type="text/javascript" src="' + url + '"></script>')
}
include('/static/js/public/device.js');
include('/static/js/public/jquery.mousewheel.js');
include('/static/js/public/jquery.simplr.smoothscroll.js');
$(function() {
  if ($('html').hasClass('desktop')) {
    $.srSmoothscroll(getCookie('smooth'));
  }
  $(document).bind("contextmenu", function(e) {
    $.showMenu(e.clientX, e.clientY);
    if (getCookie('smooth') == 1) {
      $("._menu_item").html("关闭平滑滚动");
    } else {
      $("._menu_item").html("开启平滑滚动");
    }
    return false;
  });
  $("._menu_item").live("click", function() {
    if (getCookie('smooth') == 1) {
      setCookie('smooth', 0, 365);
      location.reload();
    } else {
      setCookie('smooth', 1, 365);
      location.reload();
    }
  });
  $("*").not("._menu_item").click(function() {
    closeMenu();
  });
});

function setCookie(c_name, value, expiredays) {
  var exdate = new Date()
  exdate.setDate(exdate.getDate() + expiredays)
  document.cookie = c_name + "=" + escape(value) +
    ((expiredays == null) ? "" : ";expires=" + exdate.toGMTString())
}

function getCookie(c_name) {
  if (document.cookie.length > 0) {
    c_start = document.cookie.indexOf(c_name + "=")
    if (c_start != -1) {
      c_start = c_start + c_name.length + 1
      c_end = document.cookie.indexOf(";", c_start)
      if (c_end == -1) c_end = document.cookie.length
      return unescape(document.cookie.substring(c_start, c_end))
    }
  }
  return ""
}

function checkCookie() {
  smooth = getCookie('smooth')
  if (smooth != null && smooth != "") {

  } else {
    if (smooth != null && smooth != "") {
      setCookie('smooth', smooth, 365)
    }
  }
}