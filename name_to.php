<?


include('openCalais.php');
include('urlToObject.php');
include('xml2array.php');
include('db_functions.php');


$name_query = "SELECT * FROM entities WHERE member_name ='' LIMIT 4000"; 
$entities = db_q($name_query);

foreach ($entities as $entity) {
	$member_id = $entity['member_id'];
	$id_query = "SELECT * FROM lords WHERE id='$member_id'";
	 
	$id_result = db_q($id_query);

	$name =  addslashes($id_result[0]['name']);
	$party = addslashes($id_result[0]['party']);
	$title = addslashes($id_result[0]['title']);
	
	
	$update_query = "UPDATE entities SET member_name='$name', party='$party', title='$title' WHERE  member_id='$member_id' "; 
	echo $update_query . "<br/>"; 
	db_q($update_query);
}


?>