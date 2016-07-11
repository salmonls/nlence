<?php
	
function p($info)
{
	var_dump($info);
}

function C($var = NULL,$value = NULl)
{
	static $config = array();
	if(is_null($var) && is_null($value)){
		return $config;
	}

	if( is_array($var) ) {
		$config = array_merge($config,$var);
		return;
	}

	if(is_string($var)) {
		$var = strtoupper($var);
		if(is_null($value)) {
			return isset($config[$var]) ? $config[$var] : '';
		}
		$config[$var] = $value;
		return;
	}
	return $config;
}
?>