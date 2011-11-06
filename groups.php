<?


include('openCalais.php');
include('urlToObject.php');
include('xml2array.php');
include('db_functions.php');



$name_query = "SELECT * FROM entities WHERE agg !='2' LIMIT 1000"; 
$entities = db_q($name_query);



foreach ($entities as $entity) {
	
	//check if this category already exists 
	$type = addslashes($entity['type']);
	$name = addslashes($entity['name']);	
	 
	$unique_query  = ("SELECT * FROM aggregate WHERE type='$type' && name='$name'");
	
	$unique_result = db_q($unique_query);
	
	echo "PARTY: ".  $entity['party']; 
	
	//is unique, create a new row 
	if (count($unique_result) < 1) { 
		
		if ($entity['party'] == "Conservative") {
			$insert_query = "INSERT INTO aggregate (type, name, total, Conservative) VALUES ('$type', '$name', '1', '1')";
		}
	
		else if ($entity['party'] == "Labour") {
			$insert_query = "INSERT INTO aggregate (type, name, total, Labour) VALUES ('$type', '$name', '1', '1')";
		}
		
		else if ($entity['party'] == "Liberal Democrat") {
			$insert_query = "INSERT INTO aggregate (type, name, total, `Liberal Democrat`) VALUES ('$type', '$name', '1', '1')";
		}
		
		else if ($entity['party'] == "Crossbench") {
			$insert_query = "INSERT INTO aggregate (type, name, total, Crossbench) VALUES ('$type', '$name', '1', '1')";
		}
		
		else if ($entity['party'] == "Bishops") {
			$insert_query = "INSERT INTO aggregate (type, name, total, Bishops) VALUES ('$type', '$name', '1', '1')";
		}

		else {
			$insert_query = "INSERT INTO aggregate (type, name, total, Other) VALUES ('$type', '$name', '1', '1')";
		}										
		
		echo "ADDING NEW TYPE / NAME <br />"; 
		
		echo "Name: " . $name ."<br/>";
		echo "Type: " . $type."<br/>";
		echo "Party: " . $entity['party']."<br/>";
			
		echo $insert_query ;
		
		db_q($insert_query);
		
		echo "<br/> -----------<br/>";
		
	}
	
	//is not unique, update an existing row  
	
	else {
			
		$agg_id = $unique_result[0]['agg_id'];
		
			
		if ($entity['party'] == "Conservative") {
			$insert_query = "UPDATE aggregate SET total = total+1, Conservative = Conservative+1  WHERE agg_id = '$agg_id'";
		}
	
		else if ($entity['party'] == "Labour") {
			$insert_query = "UPDATE aggregate SET total = total+1, Labour = Labour+1  WHERE agg_id = '$agg_id'";
		}
		
		else if ($entity['party'] == "Liberal Democrat") {
			$insert_query = "UPDATE aggregate SET total = total+1, `Liberal Democrat` = `Liberal Democrat`+1  WHERE agg_id = '$agg_id'";
		}
		
		else if ($entity['party'] == "Crossbench") {
			$insert_query = "UPDATE aggregate SET total = total+1, Crossbench =Crossbench+1  WHERE agg_id = '$agg_id'";
		}
		
		else if ($entity['party'] == "Bishops") {
			$insert_query = "UPDATE aggregate SET total = total+1, Bishops = Bishops+1  WHERE agg_id = '$agg_id'";
		}

		else {
			$insert_query = "UPDATE aggregate SET total = total+1, Other = Other+1  WHERE agg_id = '$agg_id'";
		}										
		
		echo "UPDATING OLD<br />"; 
		
		echo "TOTAL: ". $unique_result[0]['total'];
		
		echo "Name: " . $name ."<br/>";
		echo "Type: " . $type."<br/>";
		echo "Party: " . $entity['party']."<br/>";
			
		echo $insert_query ;
		
		db_q($insert_query);
		
		echo "<br/> -----------<br/>";
		
		
	}
	
	$entity_id = $entity['entity_id'];
	
	$agg_query = "UPDATE entities SET agg = '2' WHERE entity_id ='$entity_id' ";
	
	db_q($agg_query);
	
}

?>