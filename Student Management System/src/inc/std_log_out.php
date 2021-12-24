<!DOCTYPE html>
<html>
<head>
	<title>Students</title>
	<link rel="stylesheet" type="text/css" href="css/style1.css">
	<link rel="stylesheet" type="text/css" href="css/style4.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="icon" href="img/images.png" type="image/icon type">
</head>
<body>
	<div class="inline">
		<ul class="inline_ul">
			<li><h1 class="h1">Hi <?php echo $_SESSION["sfname"]?>!</h1></li>
			<li class="right"><div class="logout"><a href="log_out.php" class="log-out">Logout</a></div></li>
		</ul>	
	</div>
	