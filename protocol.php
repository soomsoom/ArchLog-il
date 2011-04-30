<?
	include("conf.php");
	include("includes/functions.php");
	$file=strip_tags($_GET['log']);
	if ($file) {
	//loading the xml file
		if (file_exists("$logdir$file.xml")) {
			$xml = simplexml_load_file("$logdir$file.xml");
			foreach($xml->xpath("protocol/topic") as $log) {
				$topic=fetch($log->xpath("name"));
				$vote['subject']=fetch($log->xpath("vote/subject"));
				$vote['decline']=fetch($log->xpath("vote/decliend"));
				$vote['agree']=fetch($log->xpath("vote/agree"));
				$vote['avoid']=fetch($log->xpath("vote/avoid"));
				$output .= "<div class='box'>\n
					<h2>נושא: $topic</h2>\n
					<b>שאילתת הצבעה: </b> {$vote['subject']}<br>\n
					<b>תוצאות הצבעה: </b> בעד: {$vote['agree']}, נגד: {$vote['decline']},נמנעים: {$vote['avoid']}\n
				</div>\n";
			}
		}
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>Arch Linux - Israel: תמצית</title> 
		<meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
		<link rel="stylesheet" type="text/css" href="media/archweb.css" media="screen, projection" /> 
		<link rel="stylesheet" type="text/css" href="media/archweb-print.css" media="print" /> 
		<link rel="icon" type="image/x-icon" href="media/favicon.ico" /> 
		<link rel="shortcut icon" type="image/x-icon" href="media/favicon.ico" /> 
	</head>
	
	<body style="min-width: 490px;">
		<div id="content-protocol">
			<?=$output;?>
		</div>
	</body>
</html>
				
					
