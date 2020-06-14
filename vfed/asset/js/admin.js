layui.use(['element', 'form', 'upload', 'layer', 'code'], function() {
	var $ = layui.jquery,
		element = layui.element,
		form = layui.form,
		layer = layui.layer,
		upload = layui.upload;

	form.on('submit', function(data) {
		$.post($('.layui-form-pane').attr('action'), data.field, function(res) {
			layer.msg(res.msg, {
				time: 1000
			}, function() {
				var exp = new Date();
				exp.setTime(exp.getTime() - 1);
				var cval = document.cookie.match(new RegExp('(^| )fed_color=([^;]*)(;|$)'));
				if(cval != null) document.cookie = 'fed_color=' + escape(cval) + ';path=/;expires=' + exp.toUTCString();
				location.reload();
			});
		});
		return false;
	});

	upload.render({
		elem: '.layui-upload',
		url: $('.j-ajax', parent.document).attr('href').replace('/index/clear.html', '') + '/upload/upload.html?flag=site',
		method: 'post',
		before: function(input) {
			layer.msg('文件上传中...', {
				time: 3000000
			});
		},
		done: function(res, index, upload) {
			var obj = this.item;
			if(res.code == 0) {
				layer.msg(res.msg);
				return false;
			}
			layer.closeAll();
			var input = $(obj).parent().parent().find('.upload-input');
			if($(obj).attr('lay-type') == 'image')
				input.siblings('img').attr('src', res.data.file).show();
			input.val(res.data.file);
		}
	});

	$('.upload-input').hover(function(imgstr) {
		var imgstr = window.event || imgstr;
		var imgsrc = $(this).val();
		if(imgsrc.trim() == '') return;
		$('.fed-admin-picture').css({
			left: imgstr.clientX + document.body.scrollLeft + 20,
			top: imgstr.clientY + document.body.scrollTop + 20,
			display: ''
		});
		if(imgsrc.indexOf('://') < 0) imgsrc = vfed.path + imgsrc;
		else imgsrc = imgsrc.replace('mac:', 'http:');
		$('.fed-admin-images').attr('src', imgsrc);
	}, function() {
		$('.fed-admin-picture').css('display', 'none');
	});

	$(document).on('click', '.fed-admin-renews', function() {
		layer.confirm('确定恢复默认设置吗', {
			title: '提示'
		}, function() {
			$.post($('.layui-form-pane').attr('action') + '&name=' + vfed.name, 'type=renews', function(data) {
				layer.msg(data.msg.replace('1', ''), {
					time: 1000
				}, function() {
					location.reload();
				});
			}).error(function(data) {
				layer.msg('请求失败：' + data.status);
			}, 'json');
		});
	});

	$(document).on('click', '.fed-admin-player', function() {
		var that = $(this);
		layer.confirm('更新前请备份' + $(this).attr('data-href'), {
			title: $(this).text()
		}, function() {
			$.post(vfed.tpls + 'asset/fed/create.php?id=cop&name=' + vfed.name, 'urls=&news=' + encodeURIComponent(that.attr('data-copy')) + '&nows=' + encodeURIComponent('../../../../' + that.attr('data-href')), function(data) {
				layer.alert(data.msg + '！如未生效请手动清理缓存');
			}).error(function(data) {
				layer.msg('请求失败：' + data.status);
			}, 'json');
		});
	});

	$.getJSON('https://v3.vfed.cc/template/vfed/asset/fed/create.php?id=ver&ver=version&vfed=?', function(data) {
		var vers = data.version;
		var index = 0;
		var news = data.version.split('.');
		var nows = $('.fed-admin-version').text().split('.');
		while(index < Math.min(news.length, nows.length)) {
			var version = parseInt(news[index]) - parseInt(nows[index]);
			if(version != 0) break;
			index++;
		}
		var version = (version != 0) ? version : (news.length - nows.length);
		if(version > 0) {
			$('.fed-admin-newset').html('<font color="red" style="margin:0 10px">最新版：' + data.version + '</font><a class="fed-admin-button" style="margin:0 10px;color:red" href="javascript:;">立即更新</a>');
			$.getJSON('https://v3.vfed.cc/template/vfed/asset/fed/create.php?id=ver&ver=change&vfed=?', function(data) {
				var output = '<ul>';
				for(var i = 0; i < data.length; i++) {
					var k = (i + 1) < 10 ? '0' + (i + 1) : (i + 1);
					output += '<li class="layui-text">' + k + '：' + data[i] + '</li>';
				}
				output += '</ul>';
				$(document).on('click', '.fed-admin-button', function() {
					layer.confirm(output, {
						area: '400px',
						title: '最新版更新日志',
						btn: ['立即更新', '取消更新']
					}, function() {
						var index = layer.load(2);
						$.get(vfed.tpls + 'asset/fed/create.php?id=upd', function(data) {
							layer.close(index);
							if(data.msg = 1) {
								$.get(vfed.tpls + 'asset/fed/create.php?id=ver&ver=edition', function(data) {
									if(data.version == vers) {
										layer.alert('升级成功', function(index) {
											$.get($('.j-ajax', parent.document).attr('href'), function(data) {
												layer.msg(data.msg, {
													time: 1000
												}, function() {
													location.reload();
												});
											});
										});
									} else {
										layer.msg('升级失败', {
											icon: 2
										});
									}
								});
							} else {
								layer.msg('升级失败', {
									icon: 2
								});
							}
						}, 'json').error(function(data) {
							layer.msg('请求失败：' + data.status, {
								time: 1000
							}, function() {
								location.reload();
							});
						});
					});
				});
			});
		}
	});
});