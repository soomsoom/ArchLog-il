<?
	$file=$_GET['log'];
	if ($file) {
		//loading the xml file
		if (file_exists("$logdir$file.xml")) {
			$xml = simplexml_load_file("$logdir$file.xml");
			// Fetching operator
			$operator=fetch($xml->xpath("details/operator"));
			// fetching full date
			$day=fetch($xml->xpath("details/date/day"));
			$month=fetch($xml->xpath("details/date/month"));
			$year=fetch($xml->xpath("details/date/year"));
			$logtime=fetch($xml->xpath("details/date/time"));
			$date="$day/$month/$year"; //Prepare data for output.
			$keywords=fetch($xml->xpath("details/keywords")); //Fetch keywords
			//Fetch all log nodes
			foreach($xml->xpath("body/log") as $log) {
				$sender=fetch($log->xpath("sender"));
				$time=fetch($log->xpath("time"));
				$msg=fetch($log->xpath("msg"));
				$logs.="($time) [$sender] $msg<br>";
			}
		} else {
			$title="ERROR";
			$date="NULL";
			$keywords="NULL";
			$operator="NULL";
			$logtime="00:00:00";
			$logs="[FATAL]Can't find $file.xml on $logdir";
	
		}
	
	
?>
	<div id="lastlog" class="box">
		<h2>לוג מתאריך: <?=$date;?></h2>
		<b>מפעיל:</b> <?=$operator;?> &nbsp; <b>מילות מפתח:</b> <?=$keywords;?> 
		<br><br><b>תחילת הלוג:</b> <?=$logtime;?> &nbsp; <b>הורדה:</b> <a href="generate.php?file=<?=$file;?>&type=html">[HTML]</a> <a href="generate.php?file=<?=$file?>&type=xml">[XML]</a> <a href="generate.php?file=<?=$file?>&type=log">[LOG]</a> &nbsp; <b>אפשרויות: </b> <a href="#" onClick="javascript:summery('<?=$file;?>')">הצג תמצית</a>
		<br><br><b>לוג: </b>
		<div id="lastlog-log" class="log">
			<?=$logs;?>
		</div>
	</div>
<?
}
?>
