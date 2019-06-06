<?php

if (session_status() == 0) {
	session_start();
}

// print '<pre>';
// print_r($_SESSION);
// print '</pre>';
// session_destroy();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>My To-do List</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="style.css">
	<script src="main.js"></script>
	<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
	<script language="javascript" src="try.js"></script>
</head>
<body>
 

<div id="h2">
	<h2>To-do list</h2>
	<div class='pargraph'>
	<p>Enter Your Task Here</p>
</div>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
	<input type="text" name="userentry">
	<input type='hidden' name='action' value='save'>
	<input type="submit">    
</form>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
	<input type='hidden' name='action' value='reset'>
	<button type="submit" value="Reset">Reset</button>
</form>
<?php

if (isset($_POST['action'])) {
	if ($_POST['action'] == 'reset') {
		$id = $_POST['id'];
		unset($_SESSION['list'][$id]);
		header('Location: ?action=reset');
	}

	if ($_POST['action'] == 'save') {
		var_dump($_POST);
		if(!isset($_SESSION['list'])) {
			$_SESSION["list"] = array();
		}

		// Set session variables
		$_SESSION["list"][] = $_POST['userentry'];
		header('location:'.$_SERVER['PHP_SELF']);
	}
}

if (isset($_SESSION['list'])) {
	foreach($_SESSION["list"] as $i => $value) {
?>
	<form method='post' style='width: 100%;overflow: hidden;'>
		<div style='border: 1px solid #000;max-width: 500px;margin: 0 auto;padding: 15px;background: #fff;margin-bottom: 15px;'>
			<p style=''>
				<?php echo $value; ?>
			</p>
			<input type='hidden' name='id' value="<?php echo $i; ?>">
			<input type='hidden' name='action' value='reset'>
			<input type='submit' value='RESET'>
		</div>
	</form>
	<?php
	}
}
?>

	<script>
	
   $(document).ready(function(){
		var itemDone = 0;
		$("li").each(function(i){
		$(this).click(function(){
			checkIndex = i;
			//get a line through completed activities
			if(itemDone == 0){
			$(this).css("text-decoration","line-through");
			itemDone = 1;
			sessionStorage.setItem(checkIndex,itemDone);
			
			//Removing the line through the activity
			} else {
			$(this).css("text-decoration","none");
			itemDone = 0
			sessionStorage.setItem(checkIndex,itemDone);
			}
		 });
		});
		//Keeping the line while new activities are added
		$("li").each(function(i){
			if(sessionStorage.getItem(i)== 1){
			$(this).css("text-decoration","line-through");
			}

		});
			
	});
	
	
	</script>
	

</body>



</html>