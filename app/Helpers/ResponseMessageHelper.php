<?php

function updatedResponse($message='') {
	$message = ($message)?$message:'Updated Successfully.';
	session()->flash('success',$message);	
}

function createdResponse($message='') {
	$message = ($message)?$message:'Created Successfully.';
	session()->flash('success',$message);
}