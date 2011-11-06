<?

include('openCalais.php');
include('urlToObject.php');
include('xml2array.php');
include('db_functions.php');

$text =  urlToText('http://data.parliament.uk/resources/members/api/lords/');

$results = xmlstr_to_array($text);

$i= 0 ;

foreach ($results['m:peer'] as $result) {
	

		echo "<strong>NUMBER: "+$i+"</strong>"; 
		$id = $result['@attributes']['id'];

		$title = addslashes($result['m:longTitle']);
		$first_name = addslashes($result['m:firstName']);
		$last_name = addslashes($result['m:lastName']);
		$party = addslashes($result['p:party']['p:partyName']);	 
	
		$name = $first_name . " " . $last_name;
		echo "Name: " . $name ."<br/>";
		echo "Party: " . $party."<br/>";
		echo "ID: " . $id."<br/>";	
		echo "title: " . $title."<br/>";	

		$write_query = "INSERT INTO lords (id, title, name, party) VALUES ('$id', '$title', '$name', '$party')";
		db_q($write_query);
		echo $write_query."<br/>	 ";  
		$i++;
	
}


?>