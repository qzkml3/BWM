function b_getParam(name) {
	var url = location.href;
	var params_s = url.substring(url.indexOf('?') + 1);
	var params_a = params_s.split('&');

	for (v in params_a) {
		var key = params_a[v].split('=')[0];
		var val = params_a[v].split('=')[1];

		if (key == name) {
			return val;
		}
	}
}