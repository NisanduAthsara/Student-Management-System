<?php
	
	$serverName = "localhost";
	$userName = "root";
	$pwd = "";
	$dbname = "student_management_system";

	$conn = mysqli_connect($serverName,$userName,$pwd,$dbname);

	if(!$conn){
		?>
		<script type="text/javascript">
			alert("Oops! Unable to connect!");
		</script>
		<?php
		die();
	}
?>