<?
	include("includes/functions.php");
	//loading the xml file
	$xml = simplexml_load_file("sample.xml");
	// fetching full date
	$day=fetch($xml->xpath("details/date/day"));
	$month=fetch($xml->xpath("details/date/month"));
	$year=fetch($xml->xpath("details/date/year"));
	$time=fetch($xml->xpath("details/date/time"));
	$date="$day/$month/$year - $time";
	foreach($xml->xpath("body/log") as $log) {
		$sender=fetch($log->xpath("sender"));
		$time=fetch($log->xpath("time"));
		$msg=fetch($log->xpath("msg"));
		$logs.="($time) [$sender] $msg<br>";
	}
	foreach($xml->xpath("protocol/topic") as $log) {
		$topic=fetch($log->xpath("name"));
		$vote['subject']=fetch($log->xpath("vote/subject"));
		$vote['decline']=fetch($log->xpath("vote/decliend"));
		$vote['agree']=fetch($log->xpath("vote/agree"));
		$vote['avoid']=fetch($log->xpath("vote/avoid"));
		$output .= "<div style='background-color: #EBEBEB; font-family: arial; font-size: 9px; height: 50px;'>\n
			<h2>topic: $topic</h2>\n
			<b>poll question: </b> {$vote['subject']}<br>\n
			<b>poll results: </b> agree: {$vote['agree']}, declined: {$vote['decliend']}, avoids: {$vote['avoid']}\n
			</div>\n";
	}
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title><?=$date;?></title>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	</head>
	
	<body>
		<center><h1><?=$date;?></h1></center>
		<br>
		<b>Published:</b> <?=$date;?>
		<br>
		<b>Log:</b><br>
		<div style="background-color: #EBEBEB; font-family: arial; font-size: 9px; height: 400px;">
			<?=$logs;?>
		</div>
		
		<b>Summery:</b>
		<?=$output;?>
	</body>
</html>
