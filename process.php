<?

include('openCalais.php');
include('urlToObject.php');
include('xml2array.php');
include('db_functions.php');

$text =  urlToText('http://data.parliament.uk/resources/members/api/lords/interests/amendments/2/2011');

$results = xmlstr_to_array($text);

$i = 0; 
foreach ($results['i:interest'] as $result) {
	
	
	$date = strtotime($result['i:date']);
	$member_id = addslashes($result['m:peer']['@attributes']['id']); 
	$text = addslashes($result['i:name']); 
	
	echo "Text: " . $text ."<br/>";
	echo "Date: " . $date."<br/>";
	echo "Member ID: " . $member_id ."<br/>";	
	
	$md5 = md5($result['i:name'].$date.$result['m:peer']['@attributes']['id']);
	
	$exists_query = "SELECT * FROM fragments WHERE MD5 = '$md5'"; 
	$exists_results = db_q($exists_query);
	if ($exists_results) {
		echo "Already in DB<br/>";
	}
	
	else {
		$write_query = "INSERT INTO fragments (member_id, date, text, md5) VALUES ('$member_id', '$date', '$text', '$md5')";
		db_q($write_query);
		echo $write_query."<br/>	 ";  
	}
	
	
	
	
}










?>