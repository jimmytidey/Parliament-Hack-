<? include('db_functions.php'); ?>
<!DOCTYPE html>

<html>
<head>

	<meta charset=utf-8 />


	<title>Jimmy Tidey</title> 

	<link rel="stylesheet" type="text/css" media="screen" href="style/style.css" />

	
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.5.min.js"></script>
	<script type='text/javascript' src='script/jquery.isotope.min.js' ></script>
	<script type='text/javascript' src='script/script.js' ></script>
	

</head> 

<body>
	
	<div id='container'>


		
		    <?
			$name = $_GET['name'];
			$type = $_GET['type'];
		
		    $query = "SELECT * FROM entities WHERE name='$name' && type='$type' ";
			
			$results = db_q($query);
			
			echo "<h1>$name - $type</h1>";
			
			
			foreach($results as $result) {

				
				
				$name = $result['member_name'];
				$text = $result['text'];
				$party = $result['party'];
				$title = $result['title'];
			
		
				echo "<div class='isotope-item'>"; 
				echo "<h2>$name, $title, $party</h2>"; 
				echo "<div class='text'>$text</div>"; 
				echo "</div>"; 
		
			}
			

		    ?>		

	</div>	
	
</body>

</html>

