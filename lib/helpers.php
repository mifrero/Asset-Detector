<?php 

// clean URLs
function cleanURL($url) {

 	$url = str_replace(array('http://','https://'), '', $url);
 	$url = rtrim($url, '/');

	return $url;
}

// convert scritps to printable HTML code
function jsInliner($script) {
 	
 	$script = htmlspecialchars($script);
 	 	
	return $script;
}

