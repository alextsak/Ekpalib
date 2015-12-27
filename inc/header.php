<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
		<base href="http://localhost:5555/Ekpalib/">
		<meta charset='utf-8'>
   		<meta http-equiv="X-UA-Compatible" content="IE=edge">
   		<meta name="viewport" content="width=device-width, initial-scale=1">
	 	<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
	 	<link href="css/index.css" rel="stylesheet">
	 	<link href="css/searchpage.css" rel="stylesheet">
	 	<link href="css/main.css" rel="stylesheet">
	 	<link href="css/header.css" rel="stylesheet">
		
  		<script src="js/jquery/jquery-2.1.4.min.js"></script>
  		<script src="js/jquery.polyglot.language.switcher.js" type="text/javascript"></script>
  		<script src="js/Login-Signup.js"></script>
  		<script src="js/header.js"></script>
  		<script src="js/searchPage.js"></script>
  		<script src="bootstrap/bootstrap.js"></script>
  		

</head>
<body>
	<div class="container">
		<div class=row>
			<div class="col-sm-8">
				<header>
					<div class="logo">
						<a href=""> <img  src="images/ekpalib-logo.png" alt="Smiley face"></a>
						<h3>University Libraries</h3>
						<h4>National and Kapodistrian University of Athens</h4>
					</div>
				</header>
			</div>
			<div class="col-sm-4" style="padding-left: 150px;">
				<div class="col-sm-6">
					<div class="upper-nav pull-right">
						<ul class="nav navbar-nav">
							<?php if(isset($_SESSION['username'])) {
							
							echo '<li style="
									    width:  150px;
									    border: 1px solid #E5E5E5;
										margin-top:6px;
										border-radius: 3px;
										"
									> 
									<ul class="nav navbar-nav">
        								<li class="dropdown">
	          								<a href="#" class="dropdown-toggle" data-toggle="dropdown" 
													style="
															font-size:12px;
															margin-top:6px;
															position: relative;
														    bottom: 4px;
														    right: 20px;
														  "
											>
												<span class="glyphicon glyphicon-user"  ></span>' . 	
												$_SESSION['username'] . '
												<span class="glyphicon glyphicon-chevron-down" style="left:16px;font-size: 10px;"   >
											</a>
									
		          						<ul class="dropdown-menu" style="border-radius: 3px;" >
		            						<li style="width:100%;"><a href="#" style="font-size:12px;">Profile 
													<span class="glyphicon glyphicon-cog" style="left:8px;"></span>
												</a>
											</li>
		            						
											<li class="divider" style="width:100%"></li>
		            						
											<li style="width:100%;"><a href="#" style="font-size:12px;">History
													<span class="glyphicon glyphicon-stats" style="left:8px;"></span>
												</a>
											</li>
		            						
											<li class="divider" style="width:100%"></li>
											
											<li style="width:100%;"><a href="./pages/logout.php" style="font-size:12px;">Sign Out 
													<span class="glyphicon glyphicon-log-out" style="left:8px;"></span>
												</a>
											</li>
		          						</ul>
        							</li>
     								</ul>
								</li>';
							//echo '<li><a href="./pages/logout.php"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>';
							}
							else {
								//echo $_SESSION['username'];
								echo '<li><a href="./pages/login_signup.php"><i class="	glyphicon glyphicon-log-in"></i> Login</a></li>';
							}?>
							
							
						</ul>
					</div>
				</div>
				<div class="col-sm-6">
					<div id="polyglotLanguageSwitcher">
						<form action="">
							<select id="polyglot-language-options">
								<option id="gr" value="gr">Greek</option>
								<option id="en" value="en" selected>English</option>
								<option id="fr" value="fr">Fran&ccedil;ais</option>
							</select>
						</form>
					</div>
				</div>
			</div>
		</div>
	
		
