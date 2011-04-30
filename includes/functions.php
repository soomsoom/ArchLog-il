<?
function fetch($arr) { 
	//In some array, Out some string.
		while(list( , $node) = each($arr)) {
			return $node;
	}
}

function search($keywo) {
	//The search engine, getting a word and search over all keywords in the search.xml
	$keyword = strip_tags($keywo);
	$xml=simplexml_load_file("search.xml");
	$pos=0;
	//Search part.
	foreach ($xml->xpath("item") as $item) {
		$find=fetch($item->xpath("keywords")); // Getting keywords element.
		if(preg_match("/$keyword/i", $find) == true) { // Checking if the word is in this keywords.
			$date=fetch($item->xpath("date")); // Fetching date
			$file=fetch($item->xpath("file")); // Fetching file to link.
			$operator=fetch($item->xpath("operator")); // Fetching operator
			$results[$pos]=array("date" => $date, "file" => $file, "operator" => $operator, "keywords" => $find); // An array to work with
			$pos++;
			
			
		}
	}
	$pos=1;
	// Reordering array from the newest record to the oldest record.
	for ($i=count($results)-1;$i>=0;$i--) {
		$res[$pos]=$results[$i]; 
		$pos++;
	}
	return $res;
}

function lastLogs() {
	//Getting last logs.
	$xml=simplexml_load_file("search.xml");
	$pos=0;
	foreach ($xml->xpath("item") as $item) {
		if ($pos >= $lastrecords) { // Check if we dont exceed with the configuration.
			$date=fetch($item->xpath("date")); // Fetching Date
			$file=fetch($item->xpath("file")); //Fetching file name
			if ($date != "" && $file != "") {
				$temp[$pos]=array("date" => $date, "file" => $file); // An array to work with.
				$pos++;
			}
		}
		
	}
	$pos=0;
	$total=count($temp);
	// Reordering array from the newest record to the oldest record.
	$until=$$lastrecords-$until;
	for($i=$total;$i>=$until;$i--) {
		$res[$pos]=$temp[$i];
		$pos++;
	}
	return $res;
}

?>
