Valid = {
	isTel: function (val) {
		var rexp = /^\d{2,3}-\d{3,4}-\d{4}$/;
		return rexp.test(val);
	}
	,
	isNum: function (val) {
		var rexp = /^\d+$/;
		return rexp.test(val);
	}
};