<?php
	require_once B_COMM_PATH . '/class/service/CrudService.php';

	switch ($work_flag) {
		default:
			echo '$work_flag 가 틀립니다.';
			break;
		case 'getList':
			$list = CrudService::getList($tbl);
			break;
		case 'getData':
			CrudService::getData($tbl);
			break;
		case 'insert':
			CrudService::insert($tbl);
			break;
		case 'update':
			CrudService::update($tbl);
			break;
	}