$(document).ready(function () {
	$b.debug.showScript('.on');
	$b.pop.closePopClickShadow();
});

window.$b = function () {
	return 'b-js.js v0.01 dev';
}

$b.ajax = {};

$b.alert = function (head, cont) {
	switch (arguments.length) {
		case 2:
			$('#b_alert .b_pop_page_head').show();
			$('#b_alert .b_pop_page_head').text(head);
			$('#b_alert .b_pop_page_cont').text(cont);
			break;
		case 1:
			$('#b_alert .b_pop_page_head').hide();
			$('#b_alert .b_pop_page_head').text(head);
			$('#b_alert .b_pop_page_cont').text(cont);
			break;
		default:
	}
	$('#b_alert').fadeIn('fast');
		
	
		
}

$b.log = function (o) {
	return console.log(o);
}

$b.result = function (o) {
	var v = '<div class="b_result">' + o + '</div>';

	document.write(v)
}

$b.outerHtml = function (jq) {
	var $jq = $(jq);
	var outerHtml = $jq.wrap('<div class="temp">').parent().html()

	$jq.unwrap();
	return outerHtml;
}

$b.write = function (s) {
	document.write(s);
}

$b.write_br = function (s) {
	document.write(s + '<br>');
}

$b.write_ln = function (s) {
	document.write(s + '\n');
}

/**Charset of ajax*/
$b.ajax.charset = function (charset) {
	$.ajaxSetup({
		'beforeSend': function (xhr) {
			xhr.overrideMimeType('text/html; charset=' + charset);
		},
	});
}

$b.debug = {};

/** Show script to page
 * If no class parameter every script to page
 * */
$b.debug.showScript = function (cls) {
	var $script;

	if (cls) {
		$script = $('script').filter(cls);
	} else {
		$script = $('script');
	}

	$script.each(function () {
		var $script = $(this);
		var script = $b.outerHtml($script);

		$script.before('<code class="b_source"><xmp>' + script + "</xmp></code>");
	});
}

$b.str = {};

/**Search text in contents*/
$b.str.hasStr = function (full_str, keyword) {
	return full_str.indexOf(keyword) > -1;
}

$b.img = {};

/**Responsive image map*/
$b.img.resImgMap = function () {
	$('map').imageMapResize();
}

/**Image in contents*/
$b.img.imgInCont = function (sel) {
	var $imgs = $(sel).find('img');

	$($imgs).each(function () {
		var $img = $(this);
		var parentTagName = $img.parent().get(0).tagName;

		$img.css({
			'display': 'block',
			'max-width': '100%',
			'margin-left': 'auto',
			'margin-right': 'auto',
		});

		if (parentTagName != 'A') {
			$img.wrap('<a target="_blank" href="' + $img.attr('src') + '">');
		}
	});
}

/**Scroll end of document*/
function b_onScrollEnd(callBackFunc, charset) {
	if (charset == null) {
		charset = 'utf-8';
	}

	$(window).on('scroll', function () {
		var w_st = $(window).scrollTop();
		var w_h = $(window).height();
		var w_b = Math.round(w_st + w_h) + 100;
		var b_h = Math.round($('body').outerHeight(true));

		window.paging_lock = false;

		if (w_b >= b_h) {
			clearTimeout($.data(this, 'b_scroll_paging'));
			$.data(this, 'b_scroll_paging', setTimeout(function () {

				callBackFunc();
				console.log('============================');
			}, 100));

		}

		console.log('w_b: ' + w_b);
		console.log('b_h: ' + b_h);
	});
}

$b.pop = {};

$b.pop.open = function (jq) {
	var $pop = $(jq);
	$pop.fadeIn('fast');
}

$b.pop.close = function (jq) {
	var $pop;

	if (typeof jq == 'string') {
		$pop = $(jq);
	} else {
		$pop = $(jq).closest('.b_pop');
	}

	$pop.fadeOut('fast');
	return false;
}

/*Close pop when click shadow when if*/
$b.pop.closePopClickShadow = function () {
	$('.b_pop').on('click', function (e) {
		$pop = $(this);

		if (this == e.target) {
			if ($pop.data('click-shadow-close') == 1) {
				$b.pop.close($pop);
			}
		}
	});
}