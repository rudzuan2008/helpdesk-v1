Ext.define('mhelpdesk.view.SystemConfig', {
	extend : 'Ext.form.Panel',
	xtype : 'systemConfig',
	requires : ['Ext.TitleBar', 'Ext.Toolbar', 'Ext.form.FieldSet'],
	config : {
		title : '',
		itemId : 'systemConfig',
		padding : 5,
		scrollable : 'vertical',
		pinHeaders : true,
		layout : {
			type : 'vbox'
		},
		defaults : {
			labelWidth : '30%',
			labelAlign : 'left',
			labelWrap : true,
			minWidth : 100,
			anchor : '100%'
		},
		listeners : [{
					fn : 'onSoundFlagChange',
					event : 'change',
					delegate : '#sound_flag'
				}, {
					fn : 'onSwipe',
					event : 'swipe',
					element : 'element'
				}],
		items : []
	},
	onSwipe : function(e) {
		var me = this;
		console.info(e.direction);
		if (e.direction == "right") {
			me.fireEvent('back', me);
		}

	},
	txtHeader : 'Panel Atas',
	txtEmail : 'Emel',
	txtEmailDesc : 'Masukan emel',
	txtPhone : 'Telefon',
	txtPhoneDesc : 'Masukan telefon',
	txtTitle : 'Nama Aplikasi',
	txtTitleDesc : 'Masukan Nama Aplikasi',
	txtMember : 'Ahli',
	txtMemberDesc : 'Masukan Ahli Kumpulan',
	txtLanguage : 'Bahasa',
	txtLanguageDesc : 'Pilihan Bahasa',
	txtTickerInterval : 'Kelipan Skrin',
	txtTickerIntervalDesc : 'in second',
	txtUseSound : 'Bunyi',
	txtUseSoundDesc : 'Pilihan Bunyi',
	txtNotice : 'Keterangan Aplikasi',
	txtNoticeDesc : 'Maklumat Aplikasi',
	txtColorTrue : "Warna Betul",
	txtColorFalse : 'Warna Salah',
	txtSave : "Kemaskini",
	txtCancel : "Batal",
	txtRed : 'Merah',
	txtYellow : 'Kuning',
	txtOrange : 'Oren',
	txtGreen : 'Hijau',
	txtBlue : 'Biru',
	txtTheme : 'Theme',
	txtBM : 'Bahasa Malaysia',
	txtEN : 'English',
	txtJohorTheme : 'Johor Theme',
	txtDefaultTheme : 'Default Theme',
	initData : function() {
		var me = this;
		var system = mhelpdesk.view.System;
		var locale = mhelpdesk.view.Locale;
		try {

			var localSystemSettingStore = system.getLocalSystemSettingStore(); // Ext.getStore('localSystemSettingStore');

			var record = localSystemSettingStore.findRecord('sys_id', 1);

			var title = record.get("title");
			me.down("#title").setValue(title);
			var members = record.get("members");
			me.down("#members").setValue(members);
			var lang = record.get("locale");
			me.down("#locale").setValue(lang);
			var ticker_interval = record.get("ticker_interval");
			me.down("#ticker_interval").setValue(ticker_interval);
			var sound = record.get("sound");
			var soundFlag = 0;

			if (sound == 1) {
				soundFlag = 1;
			}
			me.down("#sound").setValue(soundFlag);
			var notice = record.get("notice");
			me.down("#notice").setValue(notice);
			var color_true = record.get("color_true");
			me.down("#color_true").setValue(color_true);
			var color_false = record.get("color_false");
			me.down("#color_false").setValue(color_false);
			var email = record.get("email");
			me.down("#email").setValue(email);
			var phone = record.get("phone");
			me.down("#phone").setValue(phone);

		} catch (ex) {
			console.error(ex);
		}
	},
	initialize : function() {
		var me = this;
		var system = mhelpdesk.view.System;
		var locale = mhelpdesk.view.Locale;
		try {

			var localSystemSettingStore = system.getLocalSystemSettingStore(); // Ext.getStore('localSystemSettingStore');

			var record = localSystemSettingStore.findRecord('sys_id', 1);

			var title = record.get("title");
			var members = record.get("members");
			var lang = record.get("locale");
			var ticker_interval = record.get("ticker_interval");
			var sound = record.get("sound");
			var soundFlag = 0;

			if (sound == 1) {
				soundFlag = 1;
			}
			var notice = record.get("notice");
			var color_true = record.get("color_true");
			var color_false = record.get("color_false");
			var email = record.get("email");
			var phone = record.get("phone");
			var screenMode = record.get("screen_mode");
			var theme = record.get("theme");

			var toolbarOper = Ext.create("Ext.Container", {

				layout : {
					type : 'hbox',
					align : 'top',
					pack : 'stretch'
				},
				// height : 90,
				width : '100%',
				items : [{
					xtype : 'button',
					itemId : 'btnSubmit',
					name : 'btnSubmit',
					ui : 'white',
					iconAlign : 'top',
					// padding: '20px',
					iconCls : 'fa-database',
					style : 'font-family: "FontAwesome";margin: .5em .5em .5em;padding-left: 5px; width: 80px; text-align: -webkit-center;',
					text : me.txtSave,
					listeners : {
						tap : function(thisButton, e, eOpts) {
							me.fireEvent('save', me, thisButton, e, eOpts);

						}
					}
						// }, {
						// xtype : 'button',
						// itemId : 'btnCancel',
						// name : 'btnCancel',
						// ui : 'white',
						// iconAlign : 'top',
						//			
						// // padding: '20px',
						// iconCls : 'fa-times',
						// style : 'font-family: "FontAwesome";margin: .5em .5em
						// .5em;padding-left: 5px; width: 80px; text-align:
						// -webkit-center;',
						// text : me.txtCancel,
						//							
						// listeners : {
						// tap : function(thisButton, e, eOpts) {
						// me.fireEvent('cancel', me, thisButton, e, eOpts);
						//		
						// }
						// }
				}, {
					// iconCls : "fa-info-circle",
					// cls : 'my-toolbar',
					style : 'font-family: "FontAwesome"; text-align: center;',
					xtype : "button",
					text : '<i class="fa fa-info-circle"></i>',
					name : "btnHelp",
					itemId : 'btnHelp',
					// iconCls : "list",
					ui : "plain",
					align : 'middle',
					docked : 'right',

					listeners : {
						tap : function(thisButton, e, eOpts) {
							me.fireEvent('info', me, thisButton, e, eOpts);

						}
					}
				}]
			});
			this.setItems([{
						xtype : 'textfield',
						label : me.txtTitle,
						placeHolder : this.txtTitleDesc,
						itemId : 'title',
						name : 'title',
						readOnly : true,
						value : title
					}, {
						xtype : 'textareafield',
						label : me.txtMember,
						placeHolder : this.txtMemberDesc,
						itemId : 'members',
						name : 'members',
						value : members,
						hidden : true,
						maxRows : 2
					}, {
						xtype : 'textareafield',
						label : me.txtNotice,
						placeHolder : this.txtNoticeDesc,
						itemId : 'notice',
						name : 'notice',
						value : notice,
						hidden : true,
						maxRows : 3
					}, {
						xtype : 'textfield',
						label : me.txtEmail,
						placeHolder : this.txtEmailDesc,
						itemId : 'email',
						name : 'email',
						hidden : true,
						value : email
					}, {
						xtype : 'textfield',
						label : me.txtPhone,
						placeHolder : this.txtPhoneDesc,
						itemId : 'phone',
						name : 'phone',
						hidden : true,
						value : phone
					}, {
						xtype : 'selectfield',
						label : this.txtLanguage,
						autoSelect : true,
						readOnly : false,
						placeHolder : this.txtLanguageDesc,
						options : [{
									text : this.txtBM,
									value : 'ms_MY'
								}, {
									text : this.txtEN,
									value : 'en'
								}],
						itemId : 'locale',
						name : 'locale',
						value : lang,
						required : false
					}, {
						xtype : 'selectfield',
						label : this.txtTheme,
						autoSelect : true,
						readOnly : false,
						options : [{
									text : this.txtDefaultTheme,
									value : 'app.css'
								}, {
									text : this.txtJohorTheme,
									value : 'cupertino.css'
								}],
						itemId : 'theme',
						name : 'theme',
						value : theme,
						required : false
//						listeners : {
//							change : function ( thisList, newValue, oldValue, eOpts ) {
//								var oldlink = document.getElementsByTagName("link").item(0);
//								//me.changeCSS("resources/css/cupertino.css",oldlink);
//								console.error(oldlink);
//								var theme = system.getTheme();
//								if (theme) {
//									console.error("update setting"+theme);
//									mainController.changeCSS('resources/css/'+theme, oldlink);
//								}else{
//									console.error("update setting");
//									me.updSysSetting("theme","app.css");
//									mainController.changeCSS('resources/css/'+theme, oldlink);
//								}
//								oldlink = document.getElementsByTagName("link").item(0);
//								//me.changeCSS("resources/css/cupertino.css",oldlink);
//								console.error(oldlink);
//								
//								
//							}
//						}
					},{
						xtype : 'selectfield',
						label : this.txtColorTrue,
						autoSelect : true,
						readOnly : false,
						options : [{
									text : this.txtRed,
									value : 'red'
								}, {
									text : this.txtOrange,
									value : '#ffb600'
								}, {
									text : this.txtYellow,
									value : '#ff0'
								}, {
									text : this.txtGreen,
									value : 'green'
								}, {
									text : this.txtBlue,
									value : '#009dff'
								}],
						itemId : 'color_true',
						name : 'color_true',
						value : color_true,
						hidden : true,
						required : true
					}, {
						xtype : 'selectfield',
						label : this.txtColorFalse,
						autoSelect : true,
						readOnly : false,
						options : [{
									text : this.txtRed,
									value : 'red'
								}, {
									text : this.txtOrange,
									value : '#ffb600'
								}, {
									text : this.txtYellow,
									value : '#ff0'
								}, {
									text : this.txtGreen,
									value : 'green'
								}, {
									text : this.txtBlue,
									value : '#009dff'
								}],
						itemId : 'color_false',
						name : 'color_false',
						value : color_false,
						hidden : true,
						required : true
					}, {
						xtype : 'textfield',
						label : me.txtTickerInterval,
						placeHolder : this.txtTickerIntervalDesc,
						itemId : 'ticker_interval',
						name : 'ticker_interval',
						hidden : true,
						value : ticker_interval
					}, {
						xtype : 'togglefield',
						itemId : 'sound',
						name : 'sound',
						value : soundFlag,
						label : me.txtUseSound
					}, {
						xtype : 'togglefield',
						itemId : 'screen_mode',
						name : 'screen_mode',
						value : screenMode,
						label : me.txtHeader
					}, {
						xtype : 'toolbar',
						docked : 'top',
						ui : 'white',
						layout : {
							type : 'hbox',
							align : 'stretch',
							pack : 'left'
						},
						items : [toolbarOper]
					}]);
		} catch (ex) {
			console.error(ex);
		}
		this.callParent(arguments);
	},

	onSoundFlagChange : function(slider, newValue, oldValue, eOpts) {
		var me = this;
		me.fireEvent('soundChange', this, slider, newValue, oldValue, eOpts);
	}
});