<?php

use App\Services\FileService;

function storageDisk($disk='') {
	
	return ($disk)?$disk:config('constant.file_storage_disk');	
}

function noImage() {
	
	return NULL;
}

function showDiskImage($image_path='') {

	if(!$image_path){
		return $image_path;
	}
	return ($image_path && $image_path!='/')?FileService::showFile($image_path):NULL;         
}
