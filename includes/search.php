<?
$search=$_GET['search'];

$res1 = search($search);
if ($_GET['page']>1) {
	
	$start=($_GET['page']*$recordsperpage)+1;
	$until=$start+$recordsperpage;
} elseif($_GET['page'] > 0 || $_GET['page'] == "") {
	$until=$recordsperpage+1;
	$start=1;
	$_GET['page']=1;
}
$pages=count($res1);
$total=ceil($pages/$recordsperpage);
if ($total > 0 && $search != "") {
	for ($page=1;$page<=$total;$page++) {
		if ($page == $_GET['page']) 
			$list .= "$page &nbsp;";
		else
			$list .= "<a href='search.php?search=$search&page=$page'>$page</a> &nbsp;";
	}
	$blue=false;
	for ($x=$start;$x<$until;$x++) {
		if ($res1[$x]['file'] && $res1[$x]['operator'] && $res1[$x]['date']) {
			$link="<a href='index.php?log=".$res1[$x]['file']."'>צפייה בלוג</a>";
			if ($blue == false) {
				$output.="<tr class='odd'>";
				$blue=true;
			} else {
				$output.="<tr class='even'>";
				$blue=false;
			}
			$output.="<td>".strip_tags($res1[$x]['date'])."</td>
			<td>".strip_tags($res1[$x]['operator'])."</td>
			<td>".strip_tags($res1[$x]['keywords'])."</td>
			<td>$link</td>
			</tr>\n";
		}
	}

} else {
	$output = "<tr>
		<td colspan='4'><center><b>אין תוצאות</b></center></td>
	</tr>";
}
?>
<div id="lastlog" class="box">
<h2>תוצאות חיפוש עבור: <?=$_GET['search'];?></h2>
<b>עמודים:</b> <?=$list;?>
<table class="results">
	<thead>
		<th>תאריך</th>
		<th>מפעיל</th>
		<th>מילות מפתח</th>
		<th>צפייה</th>
	</thead>
	<tbody>
		<?=$output;?>
	</tbody>
</table>
</div>
