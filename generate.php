<?
include("conf.php");
include("includes/functions.php");
$file=$_GET['file'];
$type=$_GET['type'];

if ($type=="html") {
	$xml = simplexml_load_file("$logdir$file.xml");
	//fetching title
	$operator=fetch($xml->xpath("details/operator"));
	// fetching full date
	$day=fetch($xml->xpath("details/date/day"));
	$month=fetch($xml->xpath("details/date/month"));
	$year=fetch($xml->xpath("details/date/year"));
	$time=fetch($xml->xpath("details/date/time"));
	$date="$day/$month/$year"; //Prepare data for output.
	$keywords=fetch($xml->xpath("details/keywords")); //Fetch keywords
	//Fetch all log nodes
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
	//Tells to the browser to download the output as log.html
	header('Content-type: text/html');
	header('Content-Disposition: attachment; filename="log.html"');
	//Printing output for download
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
		<b>Operator:</b> <?=$operator;?> &nbsp; <b>Keywords: </b> <?=$keywords;?>
		<br><br><b>Start Time:</b> <?=$time;?>
		<br><br>
		<b>Log:</b><br>
		<div style="background-color: #EBEBEB; font-family: arial; font-size: 9px;">
			<?=$logs;?>
		</div>
		<b>Summery:</b>
		<?=$output;?>
	</body>
</html>

<?
} elseif ($type=="log") {
	$xml = simplexml_load_file("$logdir$file.xml");
	// fetching full date
	$day=fetch($xml->xpath("details/date/day"));
	$month=fetch($xml->xpath("details/date/month"));
	$year=fetch($xml->xpath("details/date/year"));
	$date="$day-$month-$year";
	//Fetch all log nodes
	foreach($xml->xpath("body/log") as $log) {
		$sender=fetch($log->xpath("sender"));
		$time=fetch($log->xpath("time"));
		$msg=fetch($log->xpath("msg"));
		$logs.="($time) [$sender] $msg\n";
	}
	//Tells to the browser to download the output as <DATE>.log
	header('Content-type: text/log');
	header('Content-Disposition: attachment; filename="'.$date.'.log"');
	//Printing output for download
	echo $logs;
} elseif ($type=="xml") {
	//Tells to the browser to download the output as <DATE>.xml
	$download="$logdir$file.xml";
	header('Content-type: text/log');
	header('Content-Disposition: attachment; filename="'.$file.'.xml"');
	header('Content-Length: ' . filesize($download)); // Telling to the browser file size.
	//Printing output for download
	readfile($download);
	exit;
}
?>

