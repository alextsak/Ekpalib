<?php 
session_start();
include './database/Model/Material.php';
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
				<div class="col-sm-3">
					<div class="upper-nav pull-right">
						<ul class="nav navbar-nav">
							<?php if(isset($_SESSION['username'])) {
							
							echo '<li style="
									    width:  150px;
									    border: 1px solid #E5E5E5;
										margin-top:6px;
										border-radius: 3px;
										margin-right: 25px;
										
										"
									> 
									<ul class="nav navbar-nav">
        								<li class="dropdown" style="width: 150px;">
	          								<a href="#" class="dropdown-toggle" data-toggle="dropdown" 
													style="
															font-size:12px;
															margin-top:6px;
															position: relative;
														    bottom: 4px;
														    right: 20px;
															padding-left:0px;
														  "
											>
												<span class="glyphicon glyphicon-user" style="float:left;top: 3px;margin-right: 5px;" ></span>	
												<div style="    float: left;
															    width: 100px;
															    overflow: hidden;
															    text-overflow: ellipsis;
															    height: 20px;
															    white-space: nowrap;">'.
												$_SESSION['username'].'
												</div>
												<span class="glyphicon glyphicon-chevron-down" style="font-size: 10px;
																									  float: right;
																									  top: 5px;
																									right:7px;">
											</a>
									
		          						<ul class="dropdown-menu" style="border-radius: 3px; left: -16px;" >
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
								echo '<li style="
									    width:  80px;
									    border: 1px solid #E5E5E5;
										margin-top:6px;
										border-radius: 3px;
										margin-right: 25px;
										">
										<a href="./pages/login_signup.php" style="font-size:12px;
														  						margin-top:6px;
															position: relative;
														    bottom: 4px;
														    right: 5px;">Login
										<i class="glyphicon glyphicon-log-in" style="right:-5px;"></i></a></li>';
							}?>
							
							
						</ul>
					</div>
				</div>
				<?php 
				if(isset($_GET['action']) && $_GET['action']=="add"){
				
					$materialID=intval($_GET['materialID']);
				
					if(!isset($_SESSION['cart'][$materialID])){
				
						/* make query to database and set the session accordingly */
						$material = new Material();
						$material->query_data_to_cart($materialID, $_SESSION['genre']);
						
					}
				
				}
			if(isset($_SESSION['cart'])){
				
				?><div class="col-sm-3">
				<div class="dropdown">
				<button id="cart" class="btn btn-default " type="button" data-toggle="dropdown" >
				Cart 
				<i><?php echo '( '.count($_SESSION['cart']) . ' )';?></i>
				<i class="glyphicon glyphicon-shopping-cart"></i>
				</button>
				<ul id="cart-menu" class="dropdown-menu" aria-labelledby="dropdownMenu1">
				<?php 
					
					$material = new Material();
					$material->add_to_upper_cart($_SESSION['genre']);
				?>
				</ul>
				</div>
				</div>
				<?php 
				/*if(isset($_GET['action']) && $_GET['action']=="remove-from-cart") {
					//remove current item from cart and refresh the upper cart
					//echo 'deleting';
					$materialID=intval($_GET['materialID']);
					
					$max=count($_SESSION['cart']);
					foreach($_SESSION['cart'] as $key => $value) {
						if($materialID == $_SESSION['cart'][$i]){
							unset($_SESSION['cart'][$key]);
							echo 'deleted id' . $materialID . ' from cart';
							break;
						}
							
					}
					if(count($_SESSION['cart']) == 0) {
						//if the cart is empty unset the cart session variable
						unset($_SESSION['cart']);
					} else {
						//refresh cart
						//print_r($_SESSION['cart']);
						//$material->add_to_upper_cart($_SESSION['genre']);
					}
						
				}*/
				
				if(isset($_POST['id_to_remove']) && $_POST['id_to_remove']!=""){
					$materialID=intval($_POST['id_to_remove']);
					if(count($_SESSION['cart']) == 0) {
						//if the cart is empty unset the cart session variable
						unset($_SESSION['cart']);
					}
					else {
						
						unset($_SESSION['cart']['id_to_remove']);
						//sort($_SESSION['cart']);
					} 
				}
				
			}
			
			
			
			
			?>
				<div class="col-sm-3">
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
	
		
