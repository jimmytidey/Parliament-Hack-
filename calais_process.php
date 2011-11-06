<?
include('openCalais.php');
include('urlToObject.php');
include('xml2array.php');
include('db_functions.php');

$calais_query = "SELECT * FROM fragments LIMIT 	7913, 1000"; 
$calais_results = db_q($calais_query);

foreach($calais_results as $calais_result) {
	
	echo ('fragment: '. $calais_result['text'].'<br/>'); 
	
	$entity_data = openCalais($calais_result['text']); 
	
	foreach ($entity_data as $entity) { 
		if (isset($entity['name']) && isset($entity['type'])) {
			
			$md5 = md5($entity['name'] . $entity['type'] . $calais_result['text'] . $calais_result['date']);
			
			$exists_query = "SELECT * FROM entities WHERE md5 = '$md5'"; 
			$exists_results = db_q($exists_query);
			if ($exists_results) {
				echo "Already in DB<br/>";
			}
			else {
				$fragment_id 	= $calais_result['fragment_id']; 
				$member_id 		= $calais_result['member_id'];
				$date 			= $calais_result['date'];
				$text 			= addslashes($calais_result['text']);				 
				$type 			= addslashes($entity['type']);
				$name 			= addslashes($entity['name']);
				
				$write_entity_query = "INSERT INTO entities (fragment_id, member_id, type, date, name, text, md5) VALUES ('$fragment_id', '$member_id', '$type', '$date', '$name', '$text', '$md5')"; 
				
				echo $write_entity_query . "<br/>--------------<br/>";
				db_q($write_entity_query );
			}
		}
	} 
}




?>