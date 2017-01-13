/*
 * artDialog 3.0.5
 * Date: 2010-12-16
 * http://code.google.com/p/artdialog/
 * (c) 2009-2010 TangBin, http://www.planeArt.cn
 *
 * This is licensed under the GNU LGPL, version 2.1 or later.
 * For details, see: http://creativecommons.org/licenses/LGPL/2.1/
 */

 //-------------“art” 微型DOM引擎模块
(function(){
var $ = function (selector, content) {
		return new $.fn.init(selector, content);
	},
	readyBound = false,
	readyList = [],
	DOMContentLoaded;
 
$.fn = $.prototype = {
	init: function (selector, content) {
		if (!selector) return this;
		this[0] = typeof selector === 'string' ?
			$.selector(selector, content) : selector;
		if (typeof selector === 'function') return $().ready(selector);
		
		return this;
	},
	
	// dom 就绪
	ready: function(fn){
		$.bindReady();

		if ($.isReady) {
			fn.call(document, $);
		} else if (readyList) {
			readyList.push(fn);
		};
		
		return this;
	},
	
	// 判断样式类是否存在
	hasClass: function(name){
		var reg = new RegExp('(\\s|^)' + name + '(\\s|$)');
	
		return this[0].className.match(reg) ? true : false;;
	},
	
	// 添加样式类
	addClass: function (name) {
		if(!this.hasClass(name)) this[0].className += ' ' + name;
		
		return this;
	},
	
	// 移除样式类
	removeClass: function (name) {
		var elem = this[0];
		
		if (!name) {
			elem.className = '';
		} else
		if (this.hasClass(name)){
			elem.className = elem.className.replace(name, ' ');
		};
		
		return this;
	},
	
	// 读写样式
	// css(name) 访问第一个匹配元素的样式属性
	// css(properties) 把一个"名/值对"对象设置为所有匹配元素的样式属性
	// css(name, value) 在所有匹配的元素中，设置一个样式属性的值
	css: function(name, value) {
		var elem = this[0];
		
		if (typeof name === 'string') {
			if (value === undefined) {
				return elem.currentStyle ?
					elem.currentStyle[name] :
					document.defaultView.getComputedStyle(elem, false)[name];
			} else {
				elem.style[name] = value;
			};
		} else {
			for (var i in name) elem.style[i] = name[i];
		};
		
		return this;
	},
	
	// 向每个匹配的元素内部追加内容
	// @param {String}
	// @return {Object}
	append: function(content){
		var elem = this[0];
		
		if (elem.insertAdjacentHTML) {
			elem.insertAdjacentHTML('beforeEnd', content);
		} else {
			var range = elem.ownerDocument.createRange(),
				frag;
			if (elem.lastChild) {
				range.setStartAfter(elem.lastChild);
				frag = range.createContextualFragment(content);
				elem.appendChild(frag);
			} else {
				elem.innerHTML = content;
			};
		};
		
		return this;
	},
	
	// 移除节点
	// remove() 从DOM中删除所有匹配的元素
	// @return {undefined}
	remove: function() {
		var elem = this[0];
		
		$.each(elem.getElementsByTagName('*'), function(i, val){
			val = null;
		});

		elem.parentNode.removeChild(elem);
		elem = null;
		window.CollectGarbage && CollectGarbage();// IE私有函数释放内存
	},

	
	// 事件绑定
	// @param {String} 类型
	// @param {Function} 要绑定的事件
	// @return {Object}
	bind: function (type, fn) {
		var elem = this[0];

		if (elem.addEventListener) {
			elem.addEventListener(type, fn, false);
		} else {
			elem['$e' + type + fn] = fn;
			elem[type + fn] = function(){elem['$e' + type + fn](window.event)};
			elem.attachEvent('on' + type, elem[type + fn]);
		};
		
		return this;
	},

	// 事件代理
	// @param {String} 类型
	// @param {Function} 要绑定的事件. 注意此时this指向触发事件的元素
	// @return {Object}
	live: function(type, fn){
		this.bind(type, function(event){
			var et = event.target || event.srcElement;
			fn.call(et, event);

			return this;
		});
	},
	
	// 移除事件
	// @param {String} 类型
	// @param {Function} 要卸载的事件
	// @return {Object}
	unbind: function (type, fn) {
		var elem = this[0];

		if (elem.removeEventListener) {
			elem.removeEventListener(type, fn, false);
		} else {
			elem.detachEvent('on' + type, elem[type + fn]);
			elem[type + fn] = null;
		};
		
		return this;
	},
	
	// offset() 获取相对文档的坐标
	// @return {Object} 返回left、top的数值
	offset: function(){
		var elem = this[0],
			box = elem.getBoundingClientRect(),
			doc = elem.ownerDocument,
			body = doc.body,
			docElem = doc.documentElement,
			clientTop = docElem.clientTop || body.clientTop || 0,
			clientLeft = docElem.clientLeft || body.clientLeft || 0,
			top  = box.top  + (self.pageYOffset || docElem.scrollTop) - clientTop,
			left = box.left + (self.pageXOffset || docElem.scrollLeft) - clientLeft;
		
		return {
			left : left,
			top : top
		};
	}
};

$.fn.init.prototype = $.fn;

// 单一元素选择
// @param {String} id, tag
// @param {HTMLElement} 上下文，默认document
// @return {HTMLElement}
$.selector = function(selector, content){
	content = content || document;
    if (/^#(\w+)$/.test(selector)) return content.getElementById(RegExp.$1);
	if (/^\w+$/.test(selector)) return content.getElementsByTagName(selector)[0];
};

// 遍历
// @param {Object}
// @param {Function}
// @return {undefined}
$.each = function(obj, fn){
	var name, i = 0,
		length = obj.length,
		isObj = length === undefined;
		
	if (isObj) {
		for (name in obj) {
			if (fn.call(obj[name], name, obj[name]) === false) {
				break;
			};
		};
	} else {
		for (var value = obj[0]; i < length &&
			fn.call(value, i, value) !== false; value = obj[++i]) {};
	};
};

// DOM就绪 感谢jQuery
$.isReady = false;
$.ready = function() {
	if (!$.isReady) {
		if (!document.body) {
			return setTimeout($.ready, 13);
		};
		$.isReady = true;

		if (readyList) {
			var fn, i = 0;
			while ((fn = readyList[ i++ ])) {
				fn.call(document, $);
			};
			readyList = null;
		};
	};
};
$.bindReady = function() {
	if (readyBound) {
		return;
	};

	readyBound = true;

	if (document.readyState === 'complete') {
		return $.ready();
	};

	if (document.addEventListener) {
		document.addEventListener('DOMContentLoaded', DOMContentLoaded, false);
		window.addEventListener('load', $.ready, false);
	} else if (document.attachEvent) {
		document.attachEvent('onreadystatechange', DOMContentLoaded);
		window.attachEvent('onload', $.ready);
		var toplevel = false;
		try {
			toplevel = window.frameElement == null;
		} catch(e) {};

		if (document.documentElement.doScroll && toplevel) {
			doScrollCheck();
		};
	};
};
if (document.addEventListener) {
	DOMContentLoaded = function() {
		document.removeEventListener('DOMContentLoaded', DOMContentLoaded, false);
		$.ready();
	};
} else if (document.attachEvent) {
	DOMContentLoaded = function() {
		if (document.readyState === 'complete') {
			document.detachEvent('onreadystatechange', DOMContentLoaded);
			$.ready();
		};
	};
};
function doScrollCheck() {
	if ($.isReady) {
		return;
	};

	try {
		document.documentElement.doScroll('left');
	} catch(error) {
		setTimeout(doScrollCheck, 1);
		return;
	};
	$.ready();
};

// 元素判定
// @param {Object}
// @return {Boolean}
$.isElem = function(obj) {
	return obj && obj.nodeType === 1;
};

// 数组判定
$.isArray = function(obj) {
	return Object.prototype.toString.call(obj) === '[object Array]';
};

// 页面编码
$.charset = function(){
	var d = document;
	return d.characterSet || d.charset;
}();

// 浏览器判定
$.isIE = !-[1,];
$.isIE6 = $.isIE && !window.XMLHttpRequest;

// 动态加载外部CSS文件
// @param {String} CSS路径
// @param {Function} 回调函数
// @param {Object} 文档对象，默认为当前文档
// @return {undefined}
$.getStyle = function(href, fn, doc){
	doc = doc || document;

	var link = document.createElement('link');
	link.charset = $.charset;
	link.rel = 'stylesheet';
	link.type = 'text/css';
	link.href = href;
	doc.getElementsByTagName('head')[0].appendChild(link);
	
	var styles = doc.styleSheets,
		load = function(){
			for (var i = 0; i < styles.length; i++){
				if (link === (styles[i].ownerNode || styles[i].owningElement)) return fn();
			};
			setTimeout(arguments.callee, 5);
		};
	fn && load();
};

// 向head添加CSS
// @param {String} CSS内容
// @param {Object} 文档对象，默认为当前文档
// @return {undefined}
var _style = {};
$.addHeadStyle = function(content, doc) {
	doc = doc || document;
	
	var style = _style[doc];
	if(!style){
		style = _style[doc] = doc.createElement('style');
		style.setAttribute('type', 'text/css');
		$('head')[0].appendChild(style);
	};
	style.styleSheet && (style.styleSheet.cssText += content) || style.appendChild(doc.createTextNode(content));
};

// 动态加载外部javaScript文件
// @param {String} 文件路径
// @param {Function} 回调函数
// @param {Object} 文档对象，默认为当前文档
// @return {undefined}
$.getScript = function(src, fn, doc) {
	doc = doc || document;
	
	var script = doc.createElement('script');
	script.language = "javascript";
	script.charset = $.charset;
	script.type = 'text/javascript';

	// 读取完后的操作
	script.onload = script.onreadystatechange = function() {
		if (!script.readyState || 'loaded' === script.readyState ||'complete' === script.readyState) {
			fn && fn();
			script.onload = script.onreadystatechange = null;
			script.parentNode.removeChild(script);
		};
	};
	
	script.src = src;
	// 不插入head是为了保证script标签在DOM中的顺序，以免获取自身scr路径的方法出错
	doc.body.appendChild(script);
};

var _path = document.getElementsByTagName('script');
_path = _path[_path.length-1].src.replace(/\\/g, '/');

// 当前外链js所在路径
$.getPath = _path.lastIndexOf('/') < 0 ? '.' : _path.substring(0, _path.lastIndexOf('/'));

// 当前外链js地址
$.getUrl = _path.split('?')[0];

// 当前外链js地址参数
$.getArgs = _path.split('?')[1] || '';

// 阻止事件冒泡
// @param {Object}
// @return {undefined}
$.stopBubble = function(event){
	event.stopPropagation ? event.stopPropagation() : event.cancelBubble = true;
};

// 阻止浏览器默认行为
// @param {Object}
// @return {undefined}
$.stopDefault = function(event){
	event.preventDefault ? event.preventDefault() : event.returnValue = false;
};

(function(){
	var dd, db, dom,
		get = function(win){
			dd = win ? win.document.documentElement : document.documentElement;
			db = win ? win.document.body : document.body;
			dom = dd || db;
		};
	
	// 获取页面相关属性
	$.doc = function(win){
		get(win);
		
		return {
			width:  Math.max(dom.clientWidth, dom.scrollWidth),		// 页面宽度
			height: Math.max(dom.clientHeight, dom.scrollHeight),	// 页面长度
			left: Math.max(dd.scrollLeft, db.scrollLeft),			// 被滚动条卷去的文档宽度
			top: Math.max(dd.scrollTop, db.scrollTop)				// 被滚动条卷去的文档高度
		};
	};
	
	// 获取浏览器视口大小
	$.win = function(win){
		get(win);
				
		return {
			width: dom.clientWidth,
			height: dom.clientHeight
		};
	};
})();

// 微型模板引擎
// Simple JavaScript Templating
// Copyright (c) John Resig
// MIT Licensed
// http://ejohn.org/
// @param {String} 可以是模板字符串也可以是装载模板HTML标签的ID
// @param {Object} 给模板附加数据
// @return {String} 解析好的模板
(function(){
	var cache = {};
	$.tmpl = function tmpl(str, data){
		var fn = !/\W/.test(str) ?
		  cache[str] = cache[str] ||
			tmpl(document.getElementById(str).innerHTML) :
		  new Function("obj",
			"var p=[],print=function(){p.push.apply(p,arguments);};" +
			"with(obj){p.push('" +
			str
			  .replace(/[\r\t\n]/g, " ")
			  .split("<%").join("\t")
			  .replace(/((^|%>)[^\t]*)'/g, "$1\r")
			  .replace(/\t=(.*?)%>/g, "',$1,'")
			  .split("\t").join("');")
			  .split("%>").join("p.push('")
			  .split("\r").join("\\'")
		  + "');}return p.join('');");
		return data ? fn( data ) : fn;
	};
})();

// 微型动画引擎
// @param {HTMLElement} 元素
// @param {Number} 开始数值
// @param {Number} 结束数值
// @param {Function} 运动中不断执行设置元素状态的函数. “this”指针指向变化的数值
// @param {Function} 执行完毕后的函数
// @param {Number} 速度. 默认300
// @return {undefined}
$.effect = function(elem, start, end, change, callback, speed){
	speed = speed || 300;
	var sTime = + new Date(),
		eTime,
		val,
		iTimer = setInterval(function() {
			eTime = (+ new Date() - sTime) / speed;

			if (eTime >= 1) {
				change.call(end);
				callback && callback.call(elem);

				return clearInterval(iTimer);
			};

			val = start + (end - start) * ((- Math.cos(eTime * Math.PI) / 2) + 0.5);
			change.call(val);
		}, 1);
};

if (!window.art) window.art = $;

//-------------end
})();







//-------------Dialog应用模块
(function($){
	
// 透明渐变动画
// @param {Number} 结束的透明度
// @param {Function} 回调函数
// @param {Number} 速度
// @return {Object}
$.fn.opacityFlash = function(end, fn, speed){
	var elem = this[0],
		start = end === 0 ? 1 : 0,
		change = elem.filters ? function(){
			elem.filters.alpha.opacity = this * 100;
		} : function(){
			elem.style.opacity = this;
		};
			
	$.effect(elem, start, end, change, fn, speed);
	return this;
};

// CSS常规动画
// @param {String} CSS属性名
// @param {Number} 结束的值
// @param {Function} 回调函数
// @param {Number} 速度. 默认300
// @return {Object}
$.fn.cssFlash = function(name, end, fn, speed){
	var elem = this[0],
		start = parseInt(this.css(name)),
		end = parseInt(end),
		change = function(){
			try {
				elem.style[name] = this + 'px';
			} catch (_){
			};
		};
			
	$.effect(elem, start, end, change, fn, speed);
	return this;
};

// 清除文本选择
$.clsSelect = window.getSelection ?
	function(){
		try{
			window.getSelection().removeAllRanges()
		}catch(_){};
	} :
	function(){
		try{
			document.selection.empty();
		}catch(_){};
};

// 元素可挪动边界算法
// @param {Boolean} 是否静止定位，默认否
// @param {Number} 指定其他宽度
// @param {Number} 指定其他高度
// @return {Object} 将返回最小、最大的Left与Top的值与居中的Left、Top值
$.fn.limit = function(fixed, width, height){
	var minX, minY, maxX, maxY, centerX, centerY;
	var win = $.win(),
		doc = $.doc();
	var winWidth = win.width,
		winHeight = win.height,
		docLeft = doc.left,
		docTop = doc.top,
		boxWidth = width || this[0].offsetWidth,
		boxHeight = height || this[0].offsetHeight;

	if (fixed) {
		minX = 0;
		maxX = winWidth - boxWidth;
		centerX = maxX / 2;
		minY = 0;
		maxY = winHeight - boxHeight;
		var hc =  winHeight * 0.382 - boxHeight / 2;// 黄金比例垂直居中
		centerY = (boxHeight < 4 * winHeight / 7) ?  hc : maxY / 2;
	} else {
		minX = docLeft;
		maxX = winWidth + minX - boxWidth;
		centerX = maxX / 2;
		minY = docTop;
		maxY = winHeight + minY - boxHeight;
		var hc = winHeight * 0.382 - boxHeight / 2 + minY;// 黄金比例垂直居中
		centerY =  (boxHeight < 4 * winHeight / 7) ? hc : (maxY + minY) / 2;
	};
	if (centerX < 0) centerX = 0;
	if (centerY < 0) centerY = 0;
	return {minX: minX, minY: minY, maxX: maxX, maxY: maxY, centerX: centerX, centerY: centerY};
};

(function(){
	var regular, zIndex = 0;

	// 元素拖动模块
	// @param {Object}
	// @return {Object}
	$.fn.drag = function(options){		
		var data = options,
			defaults = $.fn.drag.defaults,
			limit, cache, isTemp, isDown, $move, $elem = this;

		// 合并默认配置
		for (var i in defaults) {
			if (data[i] === undefined) data[i] = defaults[i];
		};
		
		// 设置触点
		var on = data.on || this;
		
		// 按下
		var down = function(event){
			isDown = true;
			data.downFn && data.downFn();
			
			// 叠加高度			
			var old = $elem[0].style.zIndex || data.zIndex;
			zIndex = old > zIndex ? old : zIndex;
			zIndex ++;
			
			// 缓存拖动相关的数据
			if (data.limit) limit = $elem.limit(data.fixed);
			// 被移动元素的属性缓存
			cache = function(){
				var doc = $.doc();
				return {
					x: event.clientX,
					y: event.clientY,
					left: parseInt($elem[0].style.left),
					top: parseInt($elem[0].style.top),
					zIndex: zIndex,
					width: $elem[0].offsetWidth,
					height: $elem[0].offsetHeight,
					docLeft: doc.left,
					docTop: doc.top
				};
			}();
			
			// 对于超过预设尺寸的用替身代替拖动，保证流畅
			if(cache.width * cache.height >= data.showTemp) {
				isTemp = true;

				data.temp.css({
					'width': cache.width - 2 + 'px',
					'height': cache.height - 2 + 'px',
					'left': cache.left + 'px',
					'top': cache.top + 'px',
					'zIndex': cache.zIndex,
					'display': 'block'
				});
			};
			
			$.clsSelect();
			regular  = setInterval($.clsSelect, 20);
			
			document.body.setCapture && $elem[0].setCapture();// IE下鼠标超出视口仍可被监听
			$(document).bind('mousemove', move).bind('mouseup', up);
		};
		
		on.bind('mousedown', down);
		
		// 移动
		var move = function(event){
			if (isDown === false) return;
			
			$move = isTemp ? data.temp : $elem;
			var doc = $.doc();
			var x = event.clientX,
				y = event.clientY,
				l = cache.left - cache.x + x - cache.docLeft + doc.left,
				t = cache.top - cache.y + y - cache.docTop + doc.top;

			if (limit) {
				if (l > limit.maxX) l = limit.maxX;
				if (l < limit.minX) l = limit.minX;
				if (t > limit.maxY) t = limit.maxY;
				if (t < limit.minY) t = limit.minY;
			};
			
			$move.css({
				'left': l + 'px',
				'top': t + 'px'
			});
		};
		
		// 松开移动
		var up = function(){
			isDown = false;

			$(document).unbind('mousemove', move).unbind('mouseup', up);
			document.body.releaseCapture && $elem[0].releaseCapture();// IE释放鼠标监控
			clearInterval(regular);

			if (isTemp) {					
				$elem.cssFlash('left', data.temp.css('left'), null, 150).
					cssFlash('top', data.temp.css('top'), function(){
						data.upFn && data.upFn();
					}, 150);

				data.temp.css('display', 'none');
				isTemp = false;
			} else {
				data.upFn && data.upFn();
			};
		};

		return this;
	};
	
	$.fn.drag.defaults = {
		on: null,				// 触点
		downFn: null,			// 按下后的回调函数
		upFn: null,				// 松开后的回调函数
		fixed: false,			// 是否静止定位
		limit: true,			// 是否限制挪动范围 
		zIndex: 1,				// 初始叠加高度
		temp: null,				// 拖动用的替身元素
		showTemp: 100000		// 超过此面积的层使用替身代替拖动
	};
	
})();

// IE6 Fixed 支持模块
var position;
$(function(){
	
	// 给IE6 fixed 提供一个"不抖动的环境"
	// 只需要 html 与 body 标签其一使用背景静止定位即可让IE6下滚动条拖动元素也不会抖动
	// 注意：IE6如果 body 已经设置了背景图像静止定位后还给 html 标签设置会让 body 设置的背景静止(fixed)失效	
	$.isIE6 && $('body').css('backgroundAttachment') !== 'fixed' && $('html').css({
		backgroundImage: 'url(about:blank)',
		backgroundAttachment: 'fixed'
	});
	
	position = {
		fixed: $.isIE6 ?
		function(elem){
			var style = elem.style,
				doc = $.doc(),
				de = document.documentElement,
				de2 = '(document.documentElement)',
				left = parseInt(style.left) - de.scrollLeft,
				top = parseInt(style.top) - de.scrollTop;
			this.absolute(elem);
			style.setExpression('left', 'eval(' + de2 + '.scrollLeft + ' + left + ') + "px"');
			style.setExpression('top', 'eval(' + de2 + '.scrollTop + ' + top + ') + "px"');
		} :
		function(elem){
			elem.style.position = 'fixed';
		},
		absolute: $.isIE6 ?
		function(elem){
			var style = elem.style;
			style.position = 'absolute';
			style.removeExpression('left');
			style.removeExpression('top');
		} :
		function(elem){
			elem.style.position = 'absolute';
		}
	};
});

// 锁屏遮罩 && 对话框替身 && iframe遮罩 
// 防止IE6锁屏遮罩被下拉控件穿透
// 防止拖动时光标落入iframe导致指针捕获异常
var publicTemplate = '\
	<div id="aui_iframe_mask"></div>\
	<div id="aui_overlay"><div>\
		<!--[if IE 6]><iframe src="about:blank"></iframe><![endif]-->\
	</div></div>\
	<div id="aui_temp_wrap"><div id="aui_temp">\
		<!--[if IE 6]><iframe src="about:blank"></iframe><![endif]-->\
	</div></div>\
';

// 能自适应的artDialog模板
var template = '\
<div id="<%=id%>" class="aui_dialog_wrap <%="aui_" + skin%>">\
  <% var _css = "aui_dialog art_focus";\
	if (!border) _css += " art_no_border";\
	if (!title) _css += " art_no_title";\
  	if (!drag) _css += " art_no_drag";\
  %>\
  <div id="<%=id%>dialog" class="<%=_css%>">\
  <% if (border) { %>\
	<table class="aui_table">\
		<tr>\
		  <td class="aui_border aui_left_top"></td>\
		  <td class="aui_border aui_top"></td>\
		  <td class="aui_border aui_right_top"></td>\
		</tr>\
		<tr>\
		  <td class="aui_border aui_left"></td>\
		  <td class="aui_center">\
			<% } %>\
			<table class="aui_table aui_content_table">\
				<% if (title) { %>\
				<tr>\
				  <td <% if (icon) { %>colspan="2"<% } %> class="aui_td_title">\
					 <div class="aui_title_wrap">\
						<div id="<%=id%>title" class="aui_title">\
					  		<span class="aui_title_icon"></span><%=title%>\
						</div>\
					  	<a id="<%=id%>close" class="aui_close" href="#"><%=closeText%></a>\
					 </div>\
				  </td>\
				</tr>\
				  <% } %>\
				<tr>\
				  <% if (title && icon) { %>\
				  <td class="aui_td_icon"><div class="aui_icon art_<%=icon%>"></div></td>\
				  <% } %>\
				  <td id="<%=id%>td_content" class="aui_td_content" style="width:<%=width%>;height:<%=height%>">\
					<div class="aui_content_wrap">\
						<div id="<%=id%>content" class="aui_content">\
							<% if (content) { %>\
								<%=content%>\
							<% } else { %>\
								<div class="aui_noContent"></div>\
							<% } %>\
						</div>\
						<div class="aui_content_mask"></div>\
						<div class="aui_loading_tip"><%=loadingTip%></div>\
					</div>\
				  </td>\
				</tr>\
				<% if (yesFn || noFn) { %>\
				<tr>\
				  <td <% if (icon) { %>colspan="2"<% } %> class="aui_td_buttons">\
					  <div class="aui_buttons_wrap">\
						<% if (yesFn) { %><span class="aui_yes"><button id="<%=id%>yes"><%=yesText%></button></span><% } %>\
						<% if (noFn) { %><span class="aui_no"><button id="<%=id%>no"><%=noText%></button></span><% } %>\
					  </div>\
					</td>\
				</tr>\
				<% } %>\
			</table>\
			<% if (border) { %>\
		  </td>\
		  <td class="aui_border aui_right"></td>\
		</tr>\
		<tr>\
		  <td class="aui_border aui_left_bottom"></td>\
		  <td class="aui_border aui_bottom"></td>\
		  <td class="aui_border aui_right_bottom"></td>\
		</tr>\
	</table>\
	<% } %>\
	<!--[if IE 6]><iframe id="<%=id%>ie6_select_mask" class="aui_ie6_select_mask" src="about:blank"></iframe><![endif]-->\
  </div>\
</div>\
';

var count = 0,
	loadList = [],
	lockList = [],
	dialogList = {},
	$html = $('html'),
	isFilters = ('filters' in document.documentElement),
	lockMouse = ['DOMMouseScroll', 'mousewheel', 'scroll', 'contextmenu'],
	$iframe_mask, $temp_wrap, $temp, $overlay, topBoxApi, lockBoxApi, lockClick,
	topBox, zIndex, dialogReady, docMouse, docKey;

// 对话框核心
// @param {Object}
// @param {Object}
// @return {Object}
var dialog = function(data){

	// 解析模板并插入文档
	data.tmpl &&  (data.content = $.tmpl(data.tmpl, data.content));
	var html = $.tmpl(template, data);
	$('body').append(html);
	
	// 获取DOM
	var id = '#' + data.id;
	var ui = {
		wrap: $(id),								// 外套
		dialog: $(id + 'dialog'),					// 对话框
		td_content: $(id + 'td_content'),			// 内容区外套 
		title: $(id + 'title'),						// 标题拖动触点
		content: $(id + 'content'),					// 内容
		yesBtn: $(id + 'yes'),						// 确定按钮
		noBtn: $(id + 'no'),						// 取消按钮
		closeBtn: $(id + 'close'),					// 关闭按钮
		ie6_select_mask: $(id + 'ie6_select_mask')	// IE6 下拉控件遮罩
	};
	
	// 缓存属性
	var winWidth, winHeight, docLeft, docTop, boxWidth, boxHeight,
		boxLeft, boxTop;
	var refreshCache = function(){
		var win = $.win(),
			doc = $.doc();
			
		winWidth = win.width;
		winHeight = win.height;
		docLeft = doc.left;
		docTop = doc.top;
		boxWidth = ui.dialog[0].offsetWidth;
		boxHeight = ui.dialog[0].offsetHeight;
	};
	refreshCache();

	var isInstall, timer, ie6SelectMask, $follow = null;
	
	// 锁屏
	var lock = {
		on: function(){
			lockList.push(api);
			
			position.fixed(ui.dialog[0]);
			lock.zIndex();

			// 限制按键
			if (!docKey) docKey = function(event){
				var key = event.keyCode;
				
				// 切换按钮焦点
				(key === 37 || key === 39 || key === 9) && lockBoxApi.focus();

				if ((event.ctrlKey && key === 82) ||
					(event.ctrlKey && key === 65) ||
					key === 116 || key === 9 || key === 38 || key === 40 || key === 8) {
						docMouse(event);
						lockBoxApi.position().focus();
						try{
							event.keyCode = 0;// IE
						}catch(_){};
						$.stopDefault(event);
					};
			};
			
			// 遮罩点击
			if (!lockClick) lockClick = function(event){
				data.lockClick ? lockBoxApi.close && lockBoxApi.close() : docMouse(event);
			};
			
			// 限制鼠标
			if (!docMouse) docMouse = function(event){
				//lockBoxApi.focus(); // iPad 下焦点会自动弹出
				//scroll(docLeft, docTop); // iPad 对话框会移位
				$.stopBubble(event);
				$.stopDefault(event);
					
			};

			if (lockList.length === 1) {
				// 绑定全局事件中断用户操作
				$(document).bind('keydown', docKey);
				$.each(lockMouse, function(i, name){
					$(document).bind(name, docMouse);
				});
				
				// 绑定遮罩点击事件
				$overlay.bind('click', lockClick);
				
				// 针对移动设备对fixed支持不完整可能带来遮罩无法全部覆盖的问题
				if ('ontouchend' in document) {
					var docSize = $.doc();
					$overlay.css({
						width: docSize.width + 'px',
						height: docSize.height + 'px'
					});
				};
				
				// 对现代浏览器优雅的消除滚动条实现全屏锁定
				var noCenter = $('body').css('backgroundPosition');
				noCenter =  noCenter && noCenter.split(' ')[0];
				noCenter =  noCenter !== 'center' && noCenter !== '50%';
				noCenter && $.doc().height > winHeight && $html.addClass('art_page_full');
				
				// 显示遮罩
				data.effect && !isFilters ?
					$overlay.addClass('art_opacity').opacityFlash(1) :
					$overlay.removeClass('art_opacity');
				$html.addClass('art_page_lock');

			};
			
			// 对话框中部分操作不受全局的限制
			ui.dialog.bind('contextmenu', function(event){
				$.stopBubble(event);
			});
			ui.dialog.bind('keydown', function(event){
				var key = event.keyCode;
				if (key === 116) return;
				$.stopBubble(event);
			});

			lockBoxApi = api;
		},
		
		// 关闭锁屏
		off: function(fn){
			lockList.splice(lockList.length - 1, 1);

			var out = function(){

				if (lockList.length === 0) {// 只有一个对话框在调用锁屏
					$html.removeClass('art_page_lock');
					$html.removeClass('art_page_full');
					$.each(lockMouse, function(i, name) {
						$(document).unbind(name, docMouse);	// 解除页面鼠标操作限制
					});
					$(document).unbind('keydown', docKey);	// 解除屏蔽的按键
					docKey = docMouse = null;
					lockList = [];
				} else {
					// 多个调用锁屏的对话框支持ESC键连续使用
					lockBoxApi = topBoxApi = lockList[lockList.length - 1].zIndex();
				};

				fn && fn();
			};

			data.effect && lockList.length === 0 && !isFilters ?
				$overlay.opacityFlash(0, out) : out();
		},
		
		// 叠加高度
		zIndex: function(){
			$overlay.css('zIndex', zIndex);
			$iframe_mask.css('zIndex', zIndex);
		}
	};
	
	// 控制接口
	// 每个对话框实例都会返回此接口
	// 按钮回调函数的"this"指向此接口
	// 调用存在id名称对话框不会执行，而是返回此接口
	var api = {

		// 内容
		content: function(content){
			if (content === undefined) {
				return ui.content[0];
			} else {
				api.loading.off().zIndex().focus();
				ui.content[0].innerHTML = content;
				
				return api;
			};
		},
		
		// 重置对话框大小
		size: function(width, height, fn){

			var td = ui.td_content,
				ready = function(){
					ie6SelectMask();
					fn && fn.call(api);
				};
			
			data.width = width;
			data.height = height;

			if (data.effect) {
				td.cssFlash('width', width).
					cssFlash('height', height, ready)	
			} else {
				td.css({
					'width': width + 'px',
					'height': height + 'px'
				});
				ready();
			};
			
			return api;
		},
		
		// 坐标定位
		position: function(left, top, fixed) {
			fixed = fixed || data.fixed || false;
			isInstall && refreshCache();
			
			// 防止Firefox、Opera在domReady调用对话框时候获取对象宽度不正确,
			// 导致对话框left参数失效
			ui.dialog[0].style.position = 'absolute';
			
			var limit = ui.dialog.limit($.isIE6 ? false : fixed);

			if (left === undefined || left === 'center') {
				boxLeft = limit.centerX;
			} else if (left === 'left'){
				boxLeft = limit.minX;
			} else if (left === 'right'){
				boxLeft = limit.maxX;
			} else if (typeof left === 'number') {
				if (data.limit) {
					left = left > limit.maxX ? limit.maxX : left;
					left = left < limit.minX ? limit.minX : left;	
				};
				boxLeft = left;
			};
			
			if (top === undefined || top === 'center') {
				boxTop = limit.centerY;
			} else if (top === 'top'){
				boxTop = limit.minY;
			} else if (top === 'bottom'){
				boxTop = limit.maxY;
			} else if (typeof top === 'number') {
				if (data.limit) {
					top = top > limit.maxY ? limit.maxY : top;
					top = top < limit.minY ? limit.minY : top;
				};
				boxTop = top;
			};
			
			data.left = left;
			data.top = top;

			if (data.effect && isInstall) {
				ui.dialog.cssFlash('left', boxLeft).
					cssFlash('top', boxTop);
			} else {
				ui.dialog.css({
					'left': boxLeft + 'px',
					'top':  boxTop + 'px'
				});
			};
			
			fixed && position.fixed(ui.dialog[0]);
			
			return api;
		},

		// 跟随元素
		follow: function(elem){
			if (!elem) return api;
			
			if (typeof elem === 'string') elem = $(elem)[0] || $('#' + elem)[0];
			
			// 删除旧的安装标记
			$follow && $follow[0].artDialog && ($follow[0].artDialog = null);
			
			// 给元素做个新的安装标记
			elem.artDialog = data.id;
			
			$follow = $(elem);
			data.follow = elem;
			
			// 刷新缓存
			isInstall && refreshCache();
			
			// 适应页边距
			var w = (boxWidth - $follow[0].offsetWidth) / 2,
				h = $follow[0].offsetHeight,
				p = $follow.offset(),
				l = p.left,
				t = p.top;
			if (w > l) w = 0;
			if (t + h > docTop + winHeight - boxHeight) h = 0 - boxHeight;

			return api.position(l + docLeft - w, t + h);
		},

		// 加载提示
		loading: {
			on: function(){
				ui.dialog.addClass('art_loading');
				return api;
			},
			off: function(){
				ui.dialog.removeClass('art_loading');
				return api;
			}
		},
		
		// 置顶对话框
		zIndex: function(){
			zIndex ++;	
			ui.dialog.css('zIndex', zIndex);
			lockList.length === 0 && $iframe_mask.css('zIndex', zIndex);

			// IE6与Opera叠加高度受具有绝对或者相对定位的父元素z-index控制
			ui.wrap.css('zIndex', zIndex);
			$temp_wrap.css('zIndex', zIndex + 1);
			
			// 点亮顶层对话框
			topBox && topBox.removeClass('art_focus');
			topBox = ui.dialog;
			topBox.addClass('art_focus');
			
			// 保存顶层对话框的AIP
			topBoxApi = api;
			return api;
		},
		
		// 元素焦点处理
		focus: function(elem){
			if (typeof elem === 'string') elem = $(elem)[0] || $('#' + elem)[0];
			elem = ($.isElem(elem) && elem) || ui.noBtn[0] || ui.yesBtn[0] || ui.closeBtn[0];
			
			// 延时可防止Opera会让页面滚动的问题
			// try可以防止IE下不可见元素设置焦点报错的问题
			setTimeout(function(){
				try{
					elem.focus();
				}catch (_){};
			}, 40);
			
			return api;
		},
		
		// 显示对话框
		show: function(fn){
			// 对原生支持opacity浏览器使用特效
			// IE7、8浏览器仍然对PNG启用滤镜“伪”支持，如果再使用透明滤镜会造成PNG黑边
			// 想支持IE透明褪色？忍痛割爱不使用PNG做皮肤即可
			data.effect && !isFilters ?
				ui.dialog.addClass('art_opacity').opacityFlash(1, fn, 150) :
				fn && fn();
			ui.wrap.css('visibility', 'visible');

			return api;
		},
		
		// 隐藏对话框
		hide: function(fn){
			var fn2 = function(){
				var o = ui.dialog[0].style.opacity;
				if (o) o = null;
				ui.wrap.css('visibility', 'hidden');
				fn && fn();
			};

			data.effect && !isFilters ?
				ui.dialog.removeClass('art_opacity').opacityFlash(0, fn2, 150) :
				fn2();

			return api;
		},

		// 关闭对话框
		close: function() {
			if (!dialogList[data.id]) return null;

			// 停止计时器
			api.time();

			dialogList && dialogList[data.id] && delete(dialogList[data.id]);
			data.lock && ui.dialog.css('visibility', 'hidden');
			
			var closeFn = function(){

				if ($follow && $follow[0]) $follow[0].artDialog = null;
				if (api === topBoxApi) topBoxApi = null;
				if (topBox === ui.dialog) topBox = null;
				
				// 在文档中删除对话框所有节点与引用
				var remove = function(){
					// 执行关闭回调函数
					data.closeFn && data.closeFn.call(api, window);
					
					// 从文档中移除对话框节点
					ui.wrap.remove();
					
					$.each(api, function(name){
						delete api[name];
					});
					api = null;
				};
				
				api.hide(remove);
			};

			data.lock ? lock.off(closeFn) : closeFn();
			return null;
		},
		
		// 定时器关闭对话框
		time: function(second) {
			timer && clearTimeout(timer);

			if (second) timer = setTimeout(function(){
				api.closeFn();
				clearTimeout(timer);
			}, 1000 * second);
			
			return api;
		},
		
		// 确定按钮行为
		yesFn: function(){
			return typeof data.yesFn !== 'function' || data.yesFn.call(api, window) !== false ?
				api.close() : api;
		},

		// 取消按钮行为
		noFn: function(){
			return typeof data.noFn !== 'function' || data.noFn.call(api, window) !== false ?
				api.close() : api;
		},
		
		// 关闭按钮行为
		closeFn: function(event){
			event && $.stopDefault(event);

			var fn =  data.noFn;
			return typeof fn !== 'function' || fn.call(api, window) !== false ?
				api.close() : api;
		},
		
		// {供外部插件访问}
		ui: ui,		// 结构
		data: data	// 配置
	
	};
	
	if (data.lock) {
		data.fixed = true;
		data.follow = null;
	};
	if (data.follow || 'ontouchend' in document) data.fixed = false; // 移动设备对fixed支持有限
	api.zIndex();
	data.time && api.time(data.time);
	data.lock && lock.on();
	!data.content && api.loading.on();
	data.follow ? api.follow(data.follow) : api.position(data.left, data.top, data.fixed);

	// 监听对话框中鼠标的点击
	ui.dialog.live('click', function(event){
		var node = this.nodeName.toLowerCase();
		switch (this) {
		    case ui.yesBtn[0]:		// 确定按钮
				api.yesFn();
				break;
			case ui.noBtn[0]:		// 取消按钮
				api.noFn();
				break;
			case ui.closeBtn[0]:	// 关闭按钮
				api.closeFn(event);
				break;
			default:				// 其他元素
				node === 'td' || node === 'div' && api.zIndex();
				ie6SelectMask();
				break;
		};
	});

	// 给确定按钮添加一个 Ctrl + Enter 快捷键
	// 只对消息内容有按键交互操作的对话框生效
	ui.content.bind('keyup', function(event){	
		event.keyCode === 27 && $.stopBubble(event); // 防止输入的过程中按ESC退出
		event.ctrlKey && (event.keyCode === 13) && api.yesFn();
	});
	
	// 固化对话框
	// 防止自适应结构遇到边界会自动瘦身
	// 副作用：固化后对异步写入的内容自适应机制可能会异常
	!data.limit && ui.dialog.css({
		width: ui.dialog[0].clientWidth + 'px',
		height: ui.dialog[0].clientHeight + 'px'
	});
	
	// 启用拖动支持
	data.drag && ui.title[0] && ui.dialog.drag({
		on: ui.title,								// 触点
		fixed: $.isIE6 ? false : data.fixed,		// 是否静止定位
		temp: $temp,								// 替身
		showTemp: data.showTemp,					// 超过此面积采用替身
		zIndex: data.zIndex,						// 初始叠加高度
		limit: data.limit,							// 限制挪动范围
		downFn: function(){							// 按下
			data.fixed && position.fixed($temp[0]);
			if (data.lock) lockBoxApi = api;
			api.zIndex().focus();
			ui.dialog.addClass('art_move');
			$html.addClass('art_page_move');
		},
		upFn: function(){							// 松开
			$.isIE6 && data.fixed && position.fixed(ui.dialog[0]);
			position.absolute($temp[0]);
			ui.dialog.removeClass('art_move');
			$html.removeClass('art_page_move');
		}
	});

	// 让IE6支持PNG背景
	// IE6 无法原生支持具有阿尔法通道的PNG格式图片，但可以采用滤镜来解决
	// 使用滤镜比较麻烦的地方在于它CSS中定义的图片路径是针对HTML文档，所以最好采用绝对路径
	if ($.isIE6) {
		var list = ui.wrap[0].getElementsByTagName('*');
		$.each(list, function(i, elem){
				// 获取皮肤CSS文件定义的“ie6png”属性
			var png = $(elem).css('ie6png'),
				pngPath = $.dialog.defaults.path + '/skin/' + png;
			if (png) {
				elem.style.backgroundImage = 'none';
				elem.runtimeStyle.filter = "progid:DXImageTransform.Microsoft." +
					"AlphaImageLoader(src='" + pngPath + "',sizingMethod='crop')";
			};
			png = pngPath = null;
		});
	};
	
	// 显示对话框
	data.show && api.show();

	// IE6覆盖下拉控件的遮罩
	// 原理：每个对话框下使用一个同等大小的iframe强制遮盖下拉控件
	ie6SelectMask = function(){
		ui.ie6_select_mask[0] && ui.ie6_select_mask.css({
			'width': ui.dialog[0].offsetWidth,
			'height': ui.dialog[0].offsetHeight
		});
	};
	ie6SelectMask();
	setTimeout(ie6SelectMask, 40);// 有时候IE6还得重新执行一次才有效
	
	// 智能定位按钮焦点
	data.focus && api.focus(data.focus);

	// 执行定义的初始化函数
	data.initFn && data.initFn.call(api, window);

	// 设置安装标记
	isInstall = true;

	$(window).bind('unload', function(){
		if (!api) return;
		data.effect = false;
		api.close;
	});
	
	return api;
};

// 对话框入口代理
// @param {Object}
// @param {Function}
// @param {Function}
// @return {Object}
$.fn.dialog = function(options, yesFn, noFn){
	
	// 调用其他窗口的对话框
	var win = options.window || $.dialog.defaults.window;
	if (typeof win === 'string' && win !== 'self') win = window[win];
	// IE8要注意:
	// window.top === window 为 false
	// window.top == window 为 true
	if (win && window != win && win.art && win.art.dialog) {
			options.window = false;
			return win.art.dialog(options, yesFn, noFn);
	};
	
	var data = options || {},
		defaults = $.dialog.defaults;
	
	// 判断参数类型
	if (typeof data === 'string') data = {content: data, fixed: true};
	if (typeof data.width === 'number') data.width = data.width + 'px';
	if (typeof data.height === 'number') data.height = data.height + 'px';
	if (document.compatMode === 'BackCompat') return alert(data.content);
	
	// 整合跟随模式到主配置
	data.follow = this[0] || data.follow;

	// 整合按钮回调函数到主配置
	data.yesFn = data.yesFn || yesFn;
	data.noFn = data.noFn || noFn;

	// 如果此时对话框相关文件未就绪则储存参数，等待就绪后再统一执行
	if (!dialogReady) return loadList.push(data);
	
	// 返回同名ID对话框API
	if (dialogList[data.id]) return dialogList[data.id].zIndex().show().focus();

	// 返回跟随模式重复的调用
	if (data.follow) {
		var elem = data.follow;
		if (typeof elem === 'string') elem = $('#' + elem)[0];
		if (elem.artDialog) return dialogList[elem.artDialog].
			follow(elem).zIndex().show().focus();
	};
	
	// 生成唯一标识
	count ++;
	data.id = data.id || 'artDialog' + count;
	
	// 合并默认配置
	for (var i in defaults) {
		if (data[i] === undefined) data[i] = defaults[i];
	};
	
	// 获取多个对话框中zIndex最大的
	zIndex = zIndex || data.zIndex;
	// 使用第一个皮肤
	if ($.isArray(data.skin)) data.skin = data.skin[0];

	return dialogList[data.id] = dialog(data);
};

$.dialog = $().dialog;

// 对外暴露默认配置
var defaults = {

	// {模板需要的}
	title: '\u63D0\u793A',		// 标题. 默认'提示'
	tmpl: null,					// 供插件定义内容模板 [*]
	content: null,				// 内容
	yesFn: null,				// 确定按钮回调函数
	noFn: null,					// 取消按钮回调函数
	yesText: '\u786E\u5B9A',	// 确定按钮文本. 默认'确定'
	noText: '\u53D6\u6D88',		// 取消按钮文本. 默认'取消'
	width: 'auto',				// 宽度
	height: 'auto',				// 高度
	skin: 'default',			// 皮肤
	icon: null,					// 消息图标
	border: true,				// 是否有边框
	loadingTip: 'Loading..',	// 加载状态的提示
	closeText: '\xd7',			// 关闭按钮文本. 默认'×'

	// {逻辑需要的}
	fixed: false,				// 是否静止定位
	focus: true,				// 是否自动聚焦
	window: 'self',				// 设定弹出的窗口 [*]
	esc: true,					// 是否支持Esc键关闭
	effect: true,				// 是否开启特效
	lock: false,				// 是否锁屏
	lockClick: false,			// 点击锁屏遮罩是否关闭对话框
	left: 'center',				// X轴坐标
	top: 'center',				// Y轴坐标
	time: null,					// 自动关闭时间
	initFn: null,				// 对话框初始化后执行的函数
	closeFn: null,				// 对话框关闭执行的函数
	follow: null,				// 跟随某元素
	drag: true,					// 是否支持拖动
	limit: true,				// 是否限制位置
	loadBg: true,				// 预先加载皮肤背景
	path: $.getPath,			// 当前JS路径. 供插件调用其他文件 [*]
	show: true,					// 是否显示
	zIndex: 1987,				// 对话框最低叠加高度值(重要：此值不能过高，否则会导致Opera、Chrome等浏览器表现异常) [*]
	showTemp: 100000			// 指定超过此面积的对话框拖动的时候用替身 [*]

};
$.fn.dialog.defaults = window.artDialogDefaults || defaults;

// 开启IE6 CSS背景图片缓存，防止它耗费服务器HTTP链接资源
try{
	document.execCommand('BackgroundImageCache', false, true);
} catch (_){};

// 预缓存皮肤背景，给用户一个快速响应的感觉
// 这里通过插入隐秘对话框触发浏览器提前下载CSS中定义的背景图
// @param {String, Array} 皮肤名称
// @param {Boolean} 是否提前下载背景图片。默认true
// @return {undefined}
var _loadSkin = {};
$.fn.dialog.loadSkin = function(skin, bg){
	var load = function(name){
		if (_loadSkin[name]) return;

		$.getStyle($.dialog.defaults.path + '/skin/' + name + '.css');

		bg !== false && $.dialog({
			skin: name,
			time: 9,
			limit: false,
			focus: false,
			lock: false,
			fixed: false,
			type: false,
			icon: 'alert',
			left: -9999,
			yesFn: true,
			noFn: true
		});
		_loadSkin[name] = true;
	};

	if (typeof skin === 'string') {
		load(skin);
	} else {
		$.each(skin, function(i, name){
			load(name);
		});
	};
};

// DOM就绪后才执行的方法
var allReady = function(){
	
	// 载入核心CSS文件
	if (!dialogReady) return $.getStyle($.dialog.defaults.path + '/core/art.dialog.css', function(){
		dialogReady = true;
		allReady();
	});
	
	// 插入公用层
	$('body').append(publicTemplate);
	$iframe_mask = $('#aui_iframe_mask');
	$overlay = $('#aui_overlay');
	$temp_wrap = $('#aui_temp_wrap');
	$temp = $('#aui_temp');

	// 监听全局键盘
	var esc = function(event){
		event.keyCode === 27 && topBoxApi && topBoxApi.data.esc &&
		    topBoxApi.closeFn();// Esc
	};
	$(document).bind('keyup', esc);
	
	if (!('ontouchend' in document)) {
		// 监听浏览器窗口变化
		// 调节浏览器窗口后自动重置位置
		// 通过延时控制各个浏览器的调用频率
		var delayed,
			docH = $.doc();
		var winResize = function(){
			delayed && clearTimeout(delayed);
			
			// 防止IE 页面大小变化也导致执行onresize的BUG
			var o = docH;
			docH = $.doc();
			if (Math.abs(o.height - docH.height) > 0 ||
				Math.abs(o.width - docH.width) === 17) return clearTimeout(delayed);
	
			delayed = setTimeout(function(){
				$.each(dialogList, function(name, val){
					val.data.follow ?
						val.follow(val.data.follow) :
						(typeof val.data.left === 'string' ||
							typeof val.data.top === 'string') &&
						val.position(val.data.left, val.data.top);
				});
				clearTimeout(delayed);
			}, 150);
		};
		$(window).bind('resize', winResize);
	};

	// 缓存皮肤
	$.dialog.loadSkin($.dialog.defaults.skin, $.dialog.defaults.loadBg);
	
	// 批量执行文档未就绪前的请求
	if (loadList.length > 0) {
		$.each(loadList, function(i, name){
			$.dialog(name);
		});
		loadList = null;
	};
};
$(allReady);

// 指定窗口植入自身
$.fn.dialog.inner = function(win, fn){
	// iframe跨域没有权限操作
	try {
		win.document;
	} catch (_){
		return;
	};
	// frameset
	if (win.document.getElementsByTagName('frameset').length !== 0)
		return win.parent.document.getElementsByTagName('frameset').length === 0 ? $.fn.dialog.inner(win.parent, fn) : false;
	
	$(function(){
		// IE8要注意:
		// window.top === window 为false
		// window.top == window 为true
		if (win == window) return;
		if (win.art) {
			fn && fn();
		} else {
			win.artDialogDefaults = $.fn.dialog.defaults;
			win.artDialogDefaults.loadBg = false;
			var url = $.getArgs === '' ? $.getUrl : $.getUrl + '?' + $.getArgs;
			$.getScript(url, fn, win.document);
		};
	});
};
$.dialog.inner(window.parent);

$.fn.dialog.dialogList = dialogList;

})(art);
//-------------end










//-------------dialog扩展包[此部分是独立的，不需要可以删除]
(function($, jq){
	
var _alert = window.alert,
	_name = 'artPlus',
	_html = jq ?
		// jQuery html()方法可以解析script标签
		function(elem, content){
			jq(elem).html(content);
		} :
		// 原生方法
		function(elem, content){
			elem.innerHTML = content;
		},
	_load = jq ?
		// 如果引入了jQuery则使用强大的jQuery.ajax
		function(url, fn, cache){
			jq.ajax({
				url: url,
				success: function(data){
					fn && fn(data);
				},
				cache: cache
			});
		} :
		// 仅提供基本AJAX支持
		function(url, fn, cache){
			var ajax = window.XMLHttpRequest ?
				new XMLHttpRequest() :
				new ActiveXObject('Microsoft.XMLHTTP');
				
			ajax.onreadystatechange = function(){
				if(ajax.readyState === 4 && ajax.status === 200){
					fn && fn(ajax.responseText);
				};
				ajax.onreadystatechange = null;
				//ajax = null;
			};
			ajax.open('GET', url, 1);
			!cache && ajax.setRequestHeader('If-Modified-Since', '0'); 
			ajax.send(null);
		};

// 警告
// @param {String} 消息内容
// @return {Object} 对话框操控接口
$.fn.dialog.alert = function(content){
	return typeof content !== 'string' ?
		_alert(content) :
		$.dialog({
			id: _name + 'Alert',
			icon: 'alert',
			lock: true,
			window: 'top',
			content: content,
			yesFn: true
		});
};

// 确认
// @param {String} 消息内容
// @param {Function} 确定按钮回调函数
// @param {Function} 取消按钮回调函数
// @return {Object} 对话框操控接口
$.fn.dialog.confirm = function(content, yes, no){
	return $.dialog({
			id: _name + 'Confirm',
			icon: 'confirm',
			fixed: true,
			window: 'top',
			content: content,
			yesFn: function(here){
				return yes.call(this, here);
			},
			noFn: function(here){
				return no && no.call(this, here);
			}
		});
};

// 提问
// @param {String} 提问内容
// @param {Function} 回调函数. 接收参数：输入值
// @param {String} 默认值
// @return {Object} 对话框操控接口
$.fn.dialog.prompt = function(content, yes, value){
	value = value || '';
	var input = _name + 'promptInput';
	
	return $.dialog({
		id: _name + 'Prompt',
		icon: 'prompt',
		fixed: true,
		window: 'top',
		content: '\
			<div>' + content + '</div>\
			<div>\
			  <input id="' + input + '" value="' + value + '" type="txt" style="width:20em;padding:3px" />\
			</div>\
		',
		focus: input,
		yesFn: function(here){
			return yes && yes.call(this, here.art('#' + input)[0].value, here);
		},
		noFn: true
	});
};

// 提示
// @param {String} 提示内容
// @param {Number} 显示时间
// @return {Object} 对话框操控接口
$.fn.dialog.tips = function(content, time){
	return $.dialog({
		id: _name + 'tips',
		icon: 'tips',
		skin: 'default',
		fixed: true,
		window: 'top',
		title: false,
		content: content,
		time: time || 2
	});
};

// 弹窗
// @param {String} iframe地址
// @param {Object} 配置参数. 这里传入的回调函数接收的第1个参数为iframe内部window对象
// @return {Object} 对话框操控接口
$.fn.dialog.open = function(url, options){
	var load, $iframe, iwin,
		opt = options,
		id = _name + 'Open',
		data = {
			window: 'top',
			content: {url: url},
			tmpl: '<iframe class="' + id + '" src="<%=url%>" frameborder="0" allowtransparency="true"></iframe>',
			initFn: function(here){
				var api = this;
				
				$iframe = $('iframe', api.ui.content[0]);
				iwin = $iframe[0].contentWindow;
				api.loading.on();
				load = function(){
					// 植入artDialog文件
					$.dialog.inner(iwin, function(){
						// 给当前对话框iframe里面扩展一个关闭方法
						iwin.art.fn.dialog.close = function(){
							api.close();
						};
						// 传递来源window对象
						iwin.art.fn.dialog.parent = window;
					});
					
					api.data.effect = false;
					
					// 探测iframe内部是否可以被获取，通常只有跨域的下获取会失败
					// google chrome 浏览器本地运行调用iframe也被认为跨域
					if (api.data.width === 'auto' && api.data.height === 'auto') try{
						var doc = $.doc(iwin);
						api.size(doc.width, doc.height);
					}catch (_){};
					
					// IE6、7获取iframe大小后才能使用百分百大小
					api.ui.content.addClass('art_full');
					$iframe.css({
						'width': '100%',
						'height': '100%'
					});
		
					api.data.left === 'center' && api.data.top === 'center' && api.position('center', 'center');
					api.loading.off();
					opt.initFn && opt.initFn.call(api, here);
				};
				
				$iframe.bind('load', load);
			},
			closeFn: function(here){
				$iframe.unbind('load', load);
		
				// 重要！需要重置iframe地址，否则下次出现的对话框在IE6、7无法聚焦input
				// IE删除iframe后，iframe仍然会留在内存中出现上述问题，置换src是最容易解决的方法
				$iframe[0].src = 'about:blank';
				opt.closeFn && opt.closeFn.call(this, here);
			}
		};
	
	// 回调函数第二个参数指向iframe内部window对象
	if (opt.yesFn) data.yesFn = function(here){
		return opt.yesFn.call(this, iwin, here);
	};
	if (opt.noFn) data.noFn = function(here){
		return opt.noFn.call(this, iwin, here);
	};

	for (var i in opt) {
		if (data[i] === undefined) data[i] = opt[i];
	};
	
	$.dialog(data);
		
	return iwin;
};
$.fn.dialog.close = function(){};
$.fn.dialog.parent = window;

// Ajax生成内容
// @param {String} url
// @param {Object, String} 配置参数. 传入字符串表示使用模板引擎解析JSON生产内容
// @param {Boolean} 是否允许缓存. 默认true
// @return {Object} 对话框操控接口
$.fn.dialog.load = function(url, options, cache){
	cache = cache || false;
	var opt = options || {},
		tmpl = typeof opt === 'string' ? opt : null,
		ajaxLoad,
		data = {
			window: 'top',
			content: 'loading..',
			initFn: function(here){
				var api = this;
				
				api.loading.on();
				
				_load(url, function(content){
					api.data.effect = false;
					
					if (tmpl) content = $.tmpl(tmpl,
						window.JSON && JSON.parse ?
						JSON.parse(content) :
						eval('(' + content + ')'));
						
					_html(api.ui.content[0], content);
					api.data.left === 'center' && api.data.top === 'center' && api.position('center', 'center');
	
					api.loading.off();
					opt.initFn && opt.initFn.call(api, here);				
				}, cache);
				
			},
			closeFn: function(here){
				opt.closeFn && opt.closeFn.call(this, here);
			}
		};
		
	if (opt.tmpl) {
		tmpl = opt.tmpl;
		opt.tmpl = null;
	};
	
	for (var i in opt) {
		if (data[i] === undefined) data[i] = opt[i];
	};
	
	var dig = $.dialog(data);
};

// 获取指定对话框API
$.fn.dialog.get = function(id, win){
	win = win || window;
	return win.art.dialog.dialogList[id];
};

// 替换内置alert函数[可选]
// 引入js带上'plus'参数即可开启：artDialog.js?plus
if ($.getArgs === 'plus') window.alert = $.fn.dialog.alert;

// 给jQuery增加"dialog"插件
if (jq && !jq.dialog && !jq.fn.dialog) {
	jq.extend({
		dialog : art.dialog
	});
	jq.fn.dialog = function(options, yesFn, noFn){
		return art(this[0]).dialog(options, yesFn, noFn);
	};
};

})(art, window.jQuery);
//-------------end