<?php 
require_once(dirname(__FILE__).'/simple_html_dom.php');

$html = file_get_html('https://choosealicense.com/licenses/');

$links = [];

foreach ($html->find('.license-overview .license-overview-heading .license-overview-name a') as $element){
	 	$links [$element->innertext] = 'https://choosealicense.com/'.$element->href; 
}

foreach ($links as $key => $value) {
	echo $key."<br>_________<br>";
	$html = file_get_html($value,$stripRN=false);
	$e = $html->find('pre',0);
	$textToStore = nl2br($e->outertext);
	// echo $textToStore;
	echo ($e->outertext);
	echo "<br>";
}

?>