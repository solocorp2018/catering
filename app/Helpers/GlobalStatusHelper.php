<?php

function _getGlobalStatus() {
	return array_flip(config('constant.status'));
}

function _active() {
	$statusArr = _getGlobalStatus();
	return $statusArr['Active'] ?? '';
}

function _inactive() {
	$statusArr = _getGlobalStatus();
	return $statusArr['InActive'] ?? '';
}

function _published() {
	$statusArr = _getGlobalStatus();
	return $statusArr['Published'] ?? '';
}

function findStatus($id) {
	$statusArr = config('constant.status');
	return $statusArr[$id] ?? '--';
}