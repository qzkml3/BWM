Field = {
	selAllChkbox: function (btn, target) {
		var $btn = $(btn);
		var $target = $(target);

		$target.each(function () {
			var $target = $(this);
			if ($btn.prop('checked')) {
				$target.prop('checked', true);
			} else {
				$target.prop('checked', false);
			}
		});


	},
	selRow: function (btn) {
		var $btn = $(btn);
		var $parent = $btn.closest('tr');

		if ($btn.prop('checked')) {
			$parent.addClass('on');
		} else {
			$parent.removeClass('on');
		}
	},
	selOnOff(btn, input) {
		var $btn = $(btn);
		var $input = $(input);

		if ($btn.hasClass('on')) {
			$btn.removeClass('on');
			$input.val('');
		} else {
			$btn.addClass('on');
			$input.val('on');
		}
	},
	chkEmpty: function (field, fieldName) {
		var work_flag = '';
		if (
			field[0] && field[0].type == 'checkbox' ||
			field[0] && field[0].type == 'radio'
		) {
			work_flag = '선택';
			var chkCnt = 0;
			for (var i = 0; i < field.length; i++) {
				if (field[i].checked) {
					chkCnt++;
				}
			}
			if (! chkCnt) {
				return this.chkEmptyTrigger(field[0], fieldName, work_flag);
			}
		} else if (field.tagName.toLowerCase() == 'select') {
			if ($.trim(field.value) == "") {
				work_flag = '선택';
				return this.chkEmptyTrigger(field, fieldName, work_flag);
			}
		} else {
			if ($.trim(field.value) == "") {
				work_flag = '입력';
				return this.chkEmptyTrigger(field, fieldName, work_flag);
			}
		}
	},
	chkEmptyTrigger: function (field, fieldName, work_type) {
		alert(fieldName + '을(를) ' + work_type + ' 해주세요.');
		return this.fieldChkHandler(field);
	}
	,
	chkTel: function (field, fieldName) {
		var fieldValue = $.trim(field.value);
		if (!Valid.isTel(fieldValue)) {
			alert(fieldName + " 형식이 틀립니다.");
			return this.fieldChkHandler(field);
		}
	}
	,//todo tel과 num 분리 필요
	chkTelOrNum: function (field, fieldName) {
		var fieldValue = $.trim(field.value);
		if (!Valid.isTel(fieldValue) && !Valid.isNum(fieldValue)) {
			alert(fieldName + " 형식이 틀립니다.");
			return this.fieldChkHandler(field);
		}
	}
	,
	fieldChkHandler: function(field) {
		field.focus();
		return true;
	}
	,
	/**인풋값을 onkeyup onpaste시 돈형식으로 치환*/
	toMoney: function (el) {
		$(el).on("keyup paste", function () {
			var $el = $(this);
			setTimeout(function() {
				var val = $el.val();
				val = StringUtil.toMoney(val);
				$el.val(val);
			}, 100);
		});
	}
};