<?
include('openCalais.php');
include('urlToObject.php');

$interests = urlToText('http://localhost:8888/parliament_hack/');

$result = new SimpleXMLElement($interests);

print_r($result);

?>