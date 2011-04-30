<?
// *** XSS protection hook STARTS FROM HERE ***
foreach($_GET as $key => $value) {
	$_GET[$key] = strip_tags($value);
}
// *** XSS protection hook STOP HERE ***
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>Arch Linux - Israel: לוגים</title> 
		<meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
		<link rel="stylesheet" type="text/css" href="media/archweb.css" media="screen, projection" /> 
		<link rel="stylesheet" type="text/css" href="media/archweb-print.css" media="print" /> 
		<link rel="icon" type="image/x-icon" href="media/favicon.ico" /> 
		<link rel="shortcut icon" type="image/x-icon" href="media/favicon.ico" /> 
		<script langauge="javascript">
			function summery(file) {
			window.open( "protocol.php?log="+file, "תמצית", "status = 0, height = 500, width = 500, resizable = 0, location=0, scrollbars=1"  )
			}
		</script>
	</head>
	
	<body>
		<?
			include("conf.php");
			include("includes/functions.php");
			
				$res=lastLogs();
			
		?>
		<div id="archnavbar" class="anb-logs"> 
			<div id="archnavbarmenu"> 
				<ul id="archnavbarlist"> 
					<li id="anb-logs"><a href="http://logs.archlinux.org.il/" title="לוגים">לוגים</a></li> 
					<li id="anb-aur"><a href="http://archlinux.org.il/aur/" title="Arch Linux User Repository">AUR</a></li> 
					<li id="anb-download"><a href="/download/" title="הורדת Arch Linux">הורדה</a></li> 
					<li id="anb-bugs"><a href="http://archlinux.org.il/bugs/" title="דיווח ומעקב על באגים">באגים</a></li> 
					<li id="anb-forums"><a href="http://groups.google.com/group/archlinux-israel" title="דיונים">קבוצת דיון</a></li> 
					<li id="anb-wiki"><a href="http://wiki.archlinux.org.il/" title="תיעוד ומדריכים">ויקי</a></li> 
					<li id="anb-packages"><a href="http://www.archlinux.org.il/packages/" title="מאגר החבילות">חבילות</a></li> 
					<li id="anb-home"><a href="/" title="חדשות, חבילות, פרוייקטים ועוד">דף הבית</a></li> 
				<div id="archnavbarlogo"><h1><a href="/" title="חזרה אל דף הבית">Arch Linux</a></h1></div>	
				</ul> 
			</div> 
		</div><!-- #archnavbar -->
		<div id="content"> 
			<div id="archdev-navbar"> 
            
		</div><!-- #archdev-navbar --> 
		
		<div id="content-left-wrapper"> 
			<div id="content-left">
				<?
					if (strip_tags($_GET['search'])) {
						include("includes/search.php");
				
					} elseif ($_GET['log']) {
						include("includes/show.php");
					} else {
				
				?>	
						<div class="box">
							<h2>ברוכים הבאים למערכת הלוגים של ArchLinux-Israel.</h2>
							<p>המערכת נוצרה במיוחד עבור הקהילה, ויודעת לעבוד בצורה מושלמת ומסונכרנת עם בוט ה-IRC שלנו.
							<br>תפקיד המערכת הוא להציג בצורה פשוטה ונוחה ככל הניתן לוגים מהערוץ ה-IRC שלנו (שכרגע נוצרים אך ורק בפגישות).
							<br><br>קוד וקבצי המערכת פתוחים לכולם וניתנם לצפייה בכתובת: <a href="http://github.com/netanelshine/archlog-il">http://github.com/netanelshine/archlog-il</a>
							<br>במצב זה כל אחד יכול לשלוח תיקונים \ הצעות ורעיונות על מנת לשפר את המערכת.
							<br><br>להלן תרשים הזרימה של שלבי פעולות המערכת: <br><br><img src="http://img409.imageshack.us/img409/3827/57365819.png"></p>
						</div>
				
				<?
					}
				?>
			</div>
		</div>
                <div id="content-right"> 
                
			<div id="logsearch" class="widget"> 
 
				<form id="logsearch-form" method="get" action="index.php"> 
					<fieldset> 
		    				<p>חיפוש לוג:&nbsp;&nbsp;<input id="pkgsearch-field" type="text" name="search" size="18" maxlength="200" /></p> 
					</fieldset> 
				</form> 
			</div> 
			<div id="pkg-updates" class="widget box"> 
 				<h3><?=$lastrecords;?> הלוגים הכי חדשים</h3>
 				<table> 
 					<thead>
 						<tr>
 							<th><center>תאריך</center></th>
 							<th><center>צפייה</center></th>
 						</tr>
 					</thead>
 				<? for ($i=0;$i<=$lastrecords;$i++) { 
 					if ($res[$i]['date'] && $res[$i]['file']) {
 				?>
 					
					<tr> 
					    <td class="pkg-name"><center><span class="community"><?=$res[$i]['date'];?></span></center></td> 
					    <td class="pkg-arch"> 
						<center><a href="index.php?log=<?=$res[$i]['file']?>" title="הסתכל על לוג זה">לחץ כאן לצפייה</a></center>
					    </td> 
					</tr> 
				<?
					} 
				}
				 ?>
				</table>
 			</div>
		</div>
	</body>
</html>
