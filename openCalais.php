<?php


function openCalais($terms) { 
	
	$json = array();
	
	// Your license key (obatined from api.opencalais.com)
	$apiKey = "ssjzwz6tkseg47kcbfv5t2pz";
	
	// Content and input/output formats
	$query_text = urlencode("Microsoft Yahoo");
	
	$content = $query_text;
	
	$contentType = "text/txt"; // simple text - try also text/html
	$outputFormat = "Application/JSON"; // simple output format - try also xml/rdf and text/microformats
	
	$restURL = "http://api.opencalais.com/enlighten/rest/";
	$paramsXML = "<c:params xmlns:c=\"http://s.opencalais.com/1/pred/\" " . 
				"xmlns:rdf=\"http://www.w3.org/1999/02/22-rdf-syntax-ns#\"> " .
				"<c:processingDirectives c:contentType=\"".$contentType."\" " .
				"c:outputFormat=\"".$outputFormat."\"".
				"></c:processingDirectives> " .
				"<c:userDirectives c:allowDistribution=\"false\" " .
				"c:allowSearch=\"false\" c:externalID=\" \" " .
				"c:submitter=\"Calais REST Sample\"></c:userDirectives> " .
				"<c:externalMetadata><c:Caller>Calais REST Sample</c:Caller>" .
				"</c:externalMetadata></c:params>";
	
	// Construct the POST data string
	$data = "licenseID=".urlencode($apiKey);
	$data .= "&paramsXML=".urlencode($paramsXML);
	$data .= "&content=".urlencode($content); 
	
	// Invoke the Web service via HTTP POST
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $restURL);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 60);
	$response = curl_exec($ch);
	curl_close($ch);
	
	print_r($response);
	
	$return = array(); 
	
	$response = json_decode($response);
	
	$i = 0; 
	
	print_r($response);
	
	/*
	foreach ($response as $key => $value) {
		if ($key != 'doc') 
		{
			$return[$i]['type'] = $value->_type;
			$return[$i]['name'] = $value->name;
			$i++;
		}	
	}
	
	*/
	
	//print_r($return); 
	
	return $return; 
}	

?>
