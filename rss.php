<?php
$link = parse_ini_file(__DIR__ . '/config.ini', true);
include("connect.php");


$source = "";
$count= "";
$cnn = simplexml_load_file($link['cnn']);
$bbc = simplexml_load_file($link['bbc']);
		
    foreach($cnn->channel->item as $item)
	{

		$output = '';

         $title = $item->title;
         $description = $item->description;
		 $url = $item->link;
		 $pubDate = $item->pubDate;
		 $title1 = str_replace("'","\'", $title);
		 $description1 = str_replace("'","\'", $description);
		

		
	$output[]['title'] = $title;
    $output[]['description'] = $description;
    $output[]['url'] = $url;
    $output[]['p_date'] = $pubDate; 

		     
		$source = '<a title="'.$title.'" href="'.$item->link.'">'.$title1.'</a><br /> '.$description1.'<br />Published at:'.$item->pubDate.'<br /> <br /> <hr>';


			$sql = mysql_query("INSERT IGNORE INTO tbl_daily_news_headlines (title, description, url, pub_date, log_date) VALUES ('$title1','$description1','$url','$pubDate', now())") or die(mysql_error());
	
	}

		foreach ($bbc->channel->item as $bitem)
		{
					
				 $bbtitle = $bitem->title;
				 $bbdescription = $bitem->description;
				 $bburl = $bitem->link;
				 $bbpubDate = $bitem->pubDate;
				 $bbtitle1 = str_replace("'", "\'", $bbtitle);
				 $bbdescription1 = str_replace("'", "\'", $bbdescription);	
				 
    $output1[]['title'] = $bbtitle;
    $output1[]['description'] = $bbdescription;
    $output1[]['url'] = $bburl;
    $output1[]['p_date'] = $bbpubDate;    
	
		$bbsource = '<a title="'.$bitem->title.'" href="'.$bitem->link.'">'.$bitem->title.'</a><br /> '.$bitem->description.'<br />Published at:'.$bitem->pubDate.'<br /> <br /> <hr>';

	$sql = mysql_query("INSERT IGNORE INTO tbl_daily_news_headlines (title, description, url, pub_date, log_date) VALUES ('$bbtitle1','$bbdescription1','$bburl','$bbpubDate',now())") or die(mysql_error());

$final_output = array_merge($output, $output1);

		}



$count = mysql_affected_rows();

$to = "aydan.aleydin@gmail.com";
$subject = "" .date("Y/m/d"). "Found".$count." new articles";
$txt = "Hello there!";
$headers = "From: webmaster@bgworm.com" . "\r\n";

mail($to,$subject,$txt,$headers);



			$select = mysql_query("SELECT * FROM tbl_daily_news_headlines ORDER BY id DESC");

			$results = array();
			while($line = mysql_fetch_assoc($select)){
			$results[] = $line;
			
}
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
	<title>Feed Example</title>
	<link rel="stylesheet" type="text/css" href="media/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="media/css/dataTables.bootstrap.css">


	<script type="text/javascript" language="javascript" src="media/js/jquery-1.12.0.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="media/js/jquery.dataTables.js">
	</script>
	<script type="text/javascript" language="javascript" src="media/js/dataTables.bootstrap.js">
	</script>
	<script type="text/javascript" language="javascript" class="init">
	
$(document).ready(function() {
	$('#example').DataTable();
} );

	</script>
</head>
<body class="dt-example dt-example-bootstrap">
	<div class="container">
		<section>
			<h1>FEED Test</h1>
			<div class="info">

			</div>
			<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Title</th>
						<th>Description</th>
						<th>URL</th>
						<th>Publish Date</th>

					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>Title</th>
						<th>Description</th>
						<th>URL</th>
						<th>Publish Date</th>
					</tr>
				</tfoot>
				<tbody>
			<? foreach($results as $data1){

				echo '<tr><td>'.$data1['title'].'</td>';
				echo '<td>'.$data1['description'].'</td>';
				echo '<td>'.$data1['url'].'</td>';
				echo '<td>'.$data1['pub_date'].'</td></tr>';		


            }

				

            ?>
				</tbody>
			</table>

			</div>
	</section>
</body>
</html>
