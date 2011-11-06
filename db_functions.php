<? 

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'root';
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
$dbname = 'parliament';
mysql_select_db($dbname) or die ('Error connecting to mysql');

function db_q($query)  
{
	$result = mysql_query($query) or die(mysql_error());
	
	if ($result) {
	
		$i = 0; 
		while($row=@mysql_fetch_array($result))
		{
			$data[$i]=$row;
			$i++;
		}
		if(isset($data)) {
			return($data);
		}	
	}
}




?>