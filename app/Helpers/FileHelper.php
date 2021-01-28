<?php

function storageDisk($disk='') {
	
	return ($disk)?$disk:config('constant.file_storage_disk');	
}

