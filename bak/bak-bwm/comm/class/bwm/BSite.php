<?php
	define('B_SITE_NAME', 'BWM');
	define('B_TITLE_DELIMITER', ' : ');
	
	class BSite {
		static function getPageTitle() {
			if (B_TITLE) {
				return B_TITLE . B_TITLE_DELIMITER . B_SITE_NAME;
			} else {
				return B_SITE_NAME;
			}
		}
	}