<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
	<title>Feed Example</title>
	<link rel="stylesheet" type="text/css" href="media/css/bootstrap.min.css">
	<script type="text/javascript" language="javascript" src="media/js/jquery-1.12.0.min.js">
	</script>
</head>
<body class="dt-example dt-example-bootstrap">
	<div class="container">
<div class="form-group">
   <label class="col-md-4 control-label" for="singlebutton"></label>
   <div class="col-md-4 center-block">
      <button id="singlebutton" name="singlebutton"   class="btn btn-primary center-block" style="margin: 85px;"  onClick="getPage();" >
          Fetch The NEWS!
       </button>
   </div>  

   <script type="text/javascript">
function getPage() {
	$('#output').html('<img src="LoaderIcon.gif" />');
	jQuery.ajax({
		url: "rss.php",
		type: "POST",
		success:function(data){$('#output').html(data);
		$("#singlebutton").css({ 'display': "none" });

		}
	});
}
getPage(1);
</script>

</div>
   <div id="output"></div>

</body>
</html>
