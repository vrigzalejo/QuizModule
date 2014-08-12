<?php
/*
* app/custom/validators.php
* Added by Vrigz Alejo 
* 8-2-2014
*/
Validator::extend('alpha_spaces', function($attribute, $value) {
	return preg_match('/^[\pL\s]+$/u', $value);
});
