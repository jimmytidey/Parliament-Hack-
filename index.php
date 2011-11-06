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

		<section id="options" >

			<ul class="option-set">
				<li><a  href='#Position'>Position</a></li>
				<li><a href='#Company'>Company</a></li>									
				<li><a href='#IndustryTerm'>Term</a></li>
				<li><a href='#Country'>Country</a></li>
				<li><a href='#City'>City</a></li>
				<li><a href='#Facility'>Facility</a></li>
				<li><a href='#Organization'>Organisation</a></li>
				<li><a href='#Person'>Person</a></li>
			</ul>	
			
			<br/><br/>
			

						
		</section>	
				
		
		<div id='isotope_container'>
		
		    <?
		    $query = "SELECT * FROM aggregate WHERE total > 3 ORDER BY total desc ";
			$results = db_q($query);
	
			foreach($results as $result) {
		
				$type = $result['type'];
				$url_type = urlencode($result['type']);
				
				$name = $result['name'];
				$url_name = urlencode($result['name']);
				
				$total = $result['total'];
				$conservative = $result['Conservative'];
				$labour = $result['Labour'];
				$liberal_democrat = $result['Liberal Democrat'];
				$cross_bench = $result['Crossbench'];
				$bishops = $result['Bishops'];				
				$other = $result['Other'];
		
				echo "<div class='isotope-item $type' >\n"; 
					echo "<h1><a href='subject.php?name=$url_name&amp;type=$url_type'><span class='type'>$type</span> : $name</a></h1>\n"; 
					echo "<div class='stat conservative' style ='width:". $conservative * 2 ."px;'  >$conservative</div>\n"; 
					echo "<div class='stat labour' style ='width:". $labour * 2 ."px;'  >$labour</div>\n"; 
					echo "<div class='stat liberal_democrat' style ='width:". $liberal_democrat * 2 ."px;'  >$liberal_democrat</div>\n"; 
					echo "<div class='stat crossbench'  style ='width:". $cross_bench * 2 ."px;' >$cross_bench</div>\n"; 
					echo "<div class='stat bishops' style ='width:". $bishops * 2 ."px;'  >$bishops</div>\n"; 
				
					//echo "<div class='stat other' style ='width:". $other * 2 ."px;'  >$other</div>"; 
				echo "</div>\n"; 
				
				echo " \n";
		
			}

		    ?>		
		</div>
	</div>	
	
</body>

</html>

