var tabpanel = null;

function add_panel(id, title, targetUrl) {
	var html='<iframe name="right" class="rightMain" id="rightMain" src="'+targetUrl+'" frameborder="false" scrolling="auto" style="border:none; margin-bottom:30px" width="100%" height="auto" allowtransparency="true"></iframe>';
	if(tabpanel==null){
		tabpanel = new TabPanel({
			renderTo: 'panellist',
			autoResizable: true,
			border: 'none',
			active: 0,
			//maxLength : 5,
			widthResizable:true,
			items: [{
				id: id,
				title: title,
				html: html,
				closable: true
			}]
		});
	}else{
		tabpanel.addTab({
			id: id,
			title: title,
			html: html
		})
	}
	$('.rightMain').height(document.documentElement.clientHeight-150);
}
//clientHeight-0; 空白值 iframe自适应高度
function windowW(){
	if($(window).width()<980){
			$('.header').css('width',980+'px');
			$('#content').css('width',980+'px');
			$('body').attr('scroll','');
			$('body').css('overflow','');
	}
}

windowW();

$(window).resize(function(){
	if($(window).width()<980){
		windowW();
	}else{
		$('.header').css('width','auto');
		$('#content').css('width','auto');
		$('body').attr('scroll','no');
		$('body').css('overflow','hidden');
	}
});
window.onresize = function(){
	var heights = document.documentElement.clientHeight-150;
	$('.rightMain').height (heights);
	var openClose = $("#rightMain").height()+39;
	$('#center_frame').height(openClose+9);
	$("#openClose").height(openClose+30);	
}
window.onresize();

//查询顶部菜单,设置顶部菜单
$(function(){
	//searchMenu();
	$('.rightMain').height(document.documentElement.clientHeight-150);
	$('#center_frame').height(document.documentElement.clientHeight-103);


	//左侧开关
	$("#openClose").click(function(){
		if($(this).data('clicknum')==1) {
			$("html").removeClass("on");
			$(".left_menu").removeClass("left_menu_on");
			$(this).removeClass("close");
			$(this).data('clicknum', 0);
		} else {
			$(".left_menu").addClass("left_menu_on");
			$(this).addClass("close");
			$("html").addClass("on");
			$(this).data('clicknum', 1);
		}
		return false;
	});
})

//切换菜单
function _M(menuid,position,targetUrl,leftUrl) {
	//$("#leftMain").load("/admin/findByIdLogin.do?menuId="+menuid+"&rodId="+Math.random());


	var path = leftUrl;
	$.ajax({
		type:"post",//以POST方法接收表单数据
		url: path,
		data:"id="+menuid,
		dataType:"json",
		error:function(json){
		},
		success:function(data) {
			var htmlStr = "";
			$.each(data,function(i,n){
				// 获取二级菜单
				if(n.upLevelMenu == menuid) {
					htmlStr += '<h3 class="f12 cu on"><span class="switchs cu on" title="展开与收缩"></span>' + n.menuName + '</h3>';
					htmlStr += '<ul>';
					$.each(data, function (index, value) {
						if (value.upLevelMenu == n.id) {
							// 获取三级菜单
							htmlStr += '<li id="_MP' + value.id + '" class="sub_menu"><a href="javascript:_MP(\'' + value.id + '\',\'' + value.menuName + '\',\''+value.menuUrl+'\');" hidefocus="true" style="outline:none;">' + value.menuName + '</a></li>'
						}
					});
					htmlStr += '</ul>';
				}
			});
			$("#leftMain").html(htmlStr);
		}
	});

	$('.top_menu').removeClass("on");
	$('#_M'+menuid).addClass("on");
	$("#current_pos").html(position);
	//当点击顶部菜单后，隐藏中间的框架
	$('#display_center_id').css('display','none');
	//显示左侧菜单，当点击顶部时，展开左侧
	$(".left_menu").removeClass("left_menu_on");
	$("#openClose").removeClass("close");
	$("html").removeClass("on");
	$("#openClose").data('clicknum', 0);
	$("#current_pos").data('clicknum', 1);
	document.getElementById("rightMain").src=targetUrl;
}

//点击菜单方法
function _MP(menuid,position,targetUrl) {
	if(position != '菜单管理'){
		$("#display_center_id").hide();
	}
	$("#rightMain").attr('src', targetUrl);
	$('.sub_menu').removeClass("on fb blue");
	$('#_MP'+menuid).addClass("on fb blue");
	$("#current_pos").html(position);
	$("#current_pos").data('clicknum', 1);
}

//锁屏
function lock_screen(){
	$.ajax({
		url:lockUrl,
		datatype:"text",
		success:function(rdata){
			$('#dvLockScreen').css('display','');
		}
	});
}

function unscreenlock() {
	var lock_password = $('#lock_password').val();
	var username = $('#username').val();
	if(lock_password=='') {
		$('#lock_tips').html('<font color="red">密码不能为空。</font>');
		return false;
	}
	$.ajax({
		url:unlockUrl,
		datatype:"text",
		type:"post", 
		data:"username="+username+"&password="+lock_password,
		success:function(rdata){
			if(rdata=='1') {
				$('#dvLockScreen').css('display','none');
				$('#lock_password').val('');
				$('#lock_tips').html('锁屏状态，请输入密码解锁');
			} else if(rdata=='3') {
				$('#lock_tips').html('<font color="red">密码重试次数太多</font>');
			} else {
				$('#lock_tips').html('<font color="red">密码错误！</font>');
			}
		}
	});
}

function changePWD(){
	$.dialog({id:'change_pwd'}).close();
	var url = openchangepwdUrl;
	$.dialog.open(url,{
		title: '修改密码',
		width: 600,
		height:300,
		lock: true,
		border: false,
		id: 'change_pwd',
		drag:true
	});
}

$(document).bind('keydown', 'return', function(evt){check_screenlock();return false;});
