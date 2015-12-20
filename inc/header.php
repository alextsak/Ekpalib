<!doctype html>
<?php #$server_path = $_SERVER['DOCUMENT_ROOT'];
	#$current_path = '/Libtest';
	#$template_path = '/inc';
	
	
	#$path = $server_path . $current_path . $template_path;
	#echo $path;
?>
<html>
<head>
<base href="http://localhost:5555/Ekpalib/">
<meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/menu.css">
   <script src="js/jquery/jquery-2.1.4.min.js" type="text/javascript"></script>
   <script src="js/menu.js"></script>
   <title>EKPA Libraries</title>
</head>
<body>
<div id="container">
	<header>
	<div class="logo">
		<img src="images/ekpalib-logo.png" alt="Smiley face">
	</div>
		
	</header>
	
<div id='cssmenu'>
<ul>
   <li><a href='#'>Home</a></li>
   <li class='active has-sub'><a href='./pages/login_signup.php'>Login-SignUp</a>
      <ul>
         <li class='has-sub'><a href='#'>Product 1</a>
            <ul>
               <li><a href='#'>Sub Product</a></li>
               <li><a href='#'>Sub Product</a></li>
            </ul>
         </li>
         <li class='has-sub'><a href='#'>Product 2</a>
            <ul>
               <li><a href='#'>Sub Product</a></li>
               <li><a href='#'>Sub Product</a></li>
            </ul>
         </li>
      </ul>
   </li>
   <li><a href='#'>About</a></li>
   <li><a href='#'>Contact</a></li>
</ul>
</div>	
</div>