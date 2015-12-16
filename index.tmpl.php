<!doctype html>
<html>
<head>
<title>Email Registration</title>
<style>
li{list-style:none;}
ul,li{margin:0; padding:0;}
.notice {color:red; font-style: italic;}
</style>
</head>
<body>
<h1>Join the Mailing List</h1>
<form action="" method="post">
	<ul>
		<li>
			<label for="name">Your Name: </label>
			<input type="text" name="name" value="<?php echo old('name'); ?>">
		</li>
		<li>
			<label for="email">Your Email Address: </label>
			<input type="text" name="email" value="<?php echo old('email'); ?>">
		</li>
		<li>
				<input type="submit" value="Sign Up">
		</li>
	</ul>	
	
	<?php if(isset($status)) :?>
	<p class="notice"><?php echo $status;?></p>
	<?php endif;?>
	
</form>
</body>
</html>