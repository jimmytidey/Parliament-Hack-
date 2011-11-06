<?

include('openCalais.php');
include('urlToObject.php');
include('xml2array.php');
include('db_functions.php');

$text =  urlToText('https://api.twitter.com/1/statuses/user_timeline.xml?include_entities=true&count=300&screen_name=BaronessDeech');

$results = xmlstr_to_array($text);

//print_r($results);
$i= 1; 
foreach ($results['status'] as $result) {
	
	echo "<strong>NUMBER: "+$i+"</strong>"; 
	$date = strtotime($result['created_at']);

	$text = addslashes($result['text']); 
	
	echo "Text: " . $text ."<br/>";
	echo "Date: " . $date."<br/>";	
	
	$md5 = md5($text.$date);
	
	$exists_query = "SELECT * FROM fragments WHERE MD5 = '$md5'"; 
	$exists_results = db_q($exists_query);
	if ($exists_results) {
		echo "Already in DB<br/>";
	}
	
	else {
		$write_query = "INSERT INTO fragments (member_id, date, text, md5, fragment_type) VALUES ('3756', '$date', '$text', '$md5', 'twitter')";
		db_q($write_query);
		echo $write_query."<br/>	 ";  
	}
	
	
	
	
}


?>