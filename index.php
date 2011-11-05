<?

include('openCalais.php');
include('urlToObject.php');
include('data.php');
header ("Content-Type:text/xml");  

//$interests = urlToText('http://data.parliament.uk/resources/members/api/lords/interests/amendments/10/2011');

print_r($xmlstr);

$movies = new SimpleXMLElement($xmlstr);







?>