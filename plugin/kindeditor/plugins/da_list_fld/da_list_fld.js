/*******************************************************************************
* da系统插件-插入字段标签
* @author dannyxu100
* @date 2013-3-4
*******************************************************************************/

KindEditor.plugin('da_list_fld', function(K) {
	var self = this, 
		name = 'da_list_fld';
	
	self.plugin.da_list_fld = {
		edit : function() {
			var lang = self.lang(name + '.'),			//定义对象，lang语言包
			
				html = '<div style="padding:20px;">' +
					//url
					'<div class="ke-dialog-row">' +
					'<label for="keUrl" style="width:60px;">' + lang.url + '</label>' +
					'<input class="ke-input-text" type="text" id="keUrl" name="url" value="" style="width:260px;" /></div>' +
					//type
					'<div class="ke-dialog-row"">' +
					'<label for="keType" style="width:60px;">' + lang.linkType + '</label>' +
					'<select id="keType" name="type"></select>' +
					'</div>' +
					'</div>',							//绘制弹出层编辑界面
					
				dialog = self.createDialog({
					name : name,
					width : 450,
					title : self.lang(name),
					body : html,
					yesBtn : {							//定义点击确定事件
						name : self.lang('yes'),
						click : function(e) {
							var url = K.trim(urlBox.val());
							if (url == 'http://' || K.invalidUrl(url)) {
								alert(self.lang('invalidUrl'));
								urlBox[0].focus();
								return;
							}
							self.exec('createlink', url, typeBox.val()).hideDialog().focus();
						}
					}
				}),
				div = dialog.div,
				urlBox = K('input[name="url"]', div),
				typeBox = K('select[name="type"]', div);
			
			urlBox.val('http://');
			typeBox[0].options[0] = new Option(lang.newWindow, '_blank');
			typeBox[0].options[1] = new Option(lang.selfWindow, '');
			self.cmd.selection();
			var a = self.plugin.getSelectedLink();
			if (a) {
				self.cmd.range.selectNode(a[0]);
				self.cmd.select();
				urlBox.val(a.attr('data-ke-src'));
				typeBox.val(a.attr('target'));
			}
			urlBox[0].focus();
			urlBox[0].select();
		},
		'delete' : function() {
			self.exec('unlink', null);
		}
	};
	
	self.clickToolbar(name, self.plugin.da_list_fld.edit);
});
