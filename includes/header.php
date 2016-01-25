<?php 
error_reporting(E_ALL);

require './database/ConnectionDB/dbConnection.php';
include './database/Model/Material.php';
include './database/Model/User.php';
include './database/Model/Libraries.php';
include './database/Model/StudyRooms.php';
include './database/Model/Article.php';
require_once './utilities/helpers.php';

?>
<!DOCTYPE html>
<html>
<head>
 <!--  <base href="http://localhost:5555/Ekpalib/">-->
<base href="<?php echo get_basename();?>">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="favicon.ico" />
<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="css/header.css" rel="stylesheet">
<link href="css/main-style.css" rel="stylesheet">
<link href="css/footer.css" rel="stylesheet">
<link rel="stylesheet" href="css/login-signup.css" type="text/css"
	media="all">
<link href="css/jquery/jquery-ui.css" rel="stylesheet">
	
<script src="js/jquery/jquery-2.1.4.min.js"></script>
<script src="js/jquery.polyglot.language.switcher.js"
	type="text/javascript"></script>
<script src="js/Login-Signup.js"></script>
<script src="js/header.js"></script>
<script src="js/main.js"></script>
<script src="js/confirmLoan.js"></script>
<script src="js/advancedSearch.js"></script>
<script src="bootstrap/bootstrap.js"></script>
<script src="js/Login-Signup.js"></script>
<script src="js/jquery/jquery-ui.js"></script>
<title><?php echo get_title();?></title>

</head>
<body>
	<div class="container">
			<div class="row" style="margin:0px;">
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" id="logo-bg">
					<header>
						<div class="logo-container">
							<div class="logo-img">
							 	<a href="<?php echo get_basename();?>"> <img class="img-responsive" src="images/Drawing.png" alt="Smiley face"></a>
							</div>
							<div class="logo-title">
								<h3 style="color:#FFFAF0;">Βιβλιοθήκες Πανεπιστημίου ΕΚΠΑ</h3>
							
							</div>
						</div>
					</header>
				</div>
				<?php 
				
				if(isset($_GET['page']) && $_GET['page'] == 'login_signup') {
					getPage('pages', $_GET['page'], 'main');
					
				} else {
					
				?>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="left: 13%;" >
							<?php if(isset($_SESSION['username'])) {?>
								<div class="dropdown" style="float: right;">
								  <button id="user"  class="btn btn-default dropdown-toggle" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
								   	<span class="glyphicon glyphicon-user" style="float: left; top: 3px; margin-right: 5px;"></span>
								   	<?php echo $_SESSION['username']?>
								    <span class="glyphicon glyphicon-chevron-down"
									style="font-size: 10px;"></span>
								  </button>
								  
								  <ul class="dropdown-menu" aria-labelledby="user" style="border-radius: 3px;border: 1px solid #E5E5E5;">
								    <li>
								    	<a href="#" style="color:white;font-size: 12px;">Προφίλ
								    		<span class="glyphicon glyphicon-cog"></span>
								    	</a>
								    </li>
								    <li class="divider" style="width: 100%;"></li>
								    <li>
								    	<a href="?page=history" style="color:white;font-size: 12px;">Ιστορικό
								    		<span class="glyphicon glyphicon-stats"></span>
								    	</a>
								    </li>
								    <li class="divider" style="width: 100%"></li>
								    <li>
								    	<a href="./pages/logout.php" style="color:white;font-size: 12px;">Έξοδος
								    		<span class="glyphicon glyphicon-log-out"></span>
								    	</a>
								    </li>
								    
								  </ul>
								</div>
								<?php
									if(isset($_POST['request']) && $_POST['request'] == "remove"){
										$material = new Material();
										$message = $material->remove_request($_POST['username'],$_POST['materialID']);
										if ($message != "ok") {
											echo "<script>error_messages('$message');</script>";
										}
										else {
											$massage = "Επιτυχής διαγραφή της αιτησής σας";
											echo "<script>error_messages('$message');</script>";
										}
									}
									else if(isset($_POST['request']) && $_POST['request'] == "expand"){
										
										$m = new Material();
										$res = $m->request_expansion($_POST['username'], $_POST['materialID'], $_POST['days']);
										
										if(strcmp($res, "ok") == 0){
											
											$message = "Η επέκταση έγινε με επιτυχία";
											echo "<script>success_messages('$message');</script>";
										} else {
											$message = "Πρόβλημα επέκτασης";
											echo "<script>success_messages('$message');</script>";
										}
										
									}
									} else {
									
									?>
										
									 <button id="user"  class="btn btn-default dropdown-toggle" type="button" onclick="window.location.href='?page=login_signup'"
								  		 href="?page=login_signup"
											style="float: right; color:#FFFAF0; font-size: 12px; margin-top: 6px;background-color:#992B00; position: relative;">
											Είσοδος | Εγγραφή
										
								  	</button>
									<?php
							}
							?>
					</div>
					<?php
						// create session cart and add the item given
						if(isset($_POST['action']) && $_POST['action'] == "add"){
							$materialID = intval ( $_POST ['materialID'] );
								
							if (! isset ( $_SESSION ['cart'] [$materialID] )) {
							
								/* make query to database and set the session accordingly */
								$material = new Material ();
								$message = $material->add_to_cart ($materialID);
								if ($message != "ok") {
									echo "<script>error_messages('$message');</script>";
								}
							}else {
								$message = "Το βιβλίο " . "<span style=\"color:black;font-weight:bold;text-decoration: underline;\">".$_SESSION ['cart'] [$materialID]['title'] ."</span> περιέχεται ήδη στο καλάθι σας";
								
								echo "<script>error_messages('$message');</script>";
							}
						}
					
						// if there is no session for the cart then echo just 0
						if (! isset ( $_SESSION ['cart'])){
						?>
							<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="left:50px;">
								<div class="dropdown">
									<button id="cart" class="btn btn-default " type="button" data-toggle="dropdown">
										Καλάθι <i><?php echo '( 0 )';?></i> <i
											class="glyphicon glyphicon-shopping-cart"></i>
									</button>
									<ul id="cart-menu" class="dropdown-menu"
										aria-labelledby="dropdownMenu1">
										<li><p style="text-align: center; color: #FFFAF0;">Το καλάθι είναι
												άδειο</p></li>
									</ul>
								</div>
							</div>
						<?php 
						
					}
					if(isset($_SESSION['cart'])) {
					
					
						if(isset($_POST['id_to_remove'])){
							$materialID=intval($_POST['id_to_remove']);
							if(count($_SESSION['cart']) == 0) {
								//if the cart is empty unset the cart session variable
								unset($_SESSION['cart']);
							}
							else {
								unset($_SESSION['cart'][$materialID]);
							}
						}
						else if(isset($_POST['action']) && $_POST['action'] == "removeAll"){
							foreach($_SESSION['cart'] as $key => $val) {
								unset($_SESSION['cart'][$key]);
							}
							if(count($_SESSION['cart']) == 0) {
								unset($_SESSION['cart']);
							}
	
						}
						
					?>
					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="left:50px;">
							<button id="cart" class="btn btn-default" data-toggle="modal" href="#cartModal" style="background-color:#992B00;color:#FFFAF0"> 
								Καλάθι 
								<i style="color:#FFFAF0;"><?php 
									if(!isset($_SESSION['cart'])) {
										echo '( 0 )';
									}
									else {
										echo '( '.count($_SESSION['cart']) . ' )';
									}
								?></i> 
								<i class="glyphicon glyphicon-shopping-cart"></i>
							</button>
							
							<div class="modal fade" id="cartModal">	
								<div class="modal-dialog">
								      <div id="cart-window" class="modal-content" style="background-color: #520000;">
								         <div class="modal-header">
									    </div>
								        
								        <div class="modal-body" style="background-color: #5B2A2A;margin: 10px; border-radius: 10px;">
								          <div class="table-responsive">  
								          <table class="table" id="tblGrid">
								            <thead id="tblHead">
								              <tr>
								                <th style="color:white">Τίτλος</th>
								                <th style="color:white">Βιβλιοθήκη</th>
								                <th style="color:white">Κατηγορία</th>
								                <th style="color:white">Επιλογή</th>
								              </tr>
								            </thead>
								            
								            <tbody>
								              <?php 
												if(count($_SESSION['cart']) > 0){
												
													$material = new Material();
													$material->update_upper_cart();
												} else {
													unset($_SESSION['cart']);
												}
												?>
								            </tbody>
								          </table>
								          </div>
										</div>
								        <div class="modal-footer">
								          <button id="modal-button" type="button" class="btn btn-default " data-dismiss="modal">Κλείσιμο</button>
								          <button type="button" class="btn btn-danger " data-dismiss="modal" onclick='cleanCart()'>Διαγραφή Όλων</button>
								          <a href="?page=confirmLoan" style="background-color: #EC971F;border-color:#EC971F;" class="btn btn-primary">Επιβεβαίωση Δανεισμού</a>
								        </div>
												
								      </div><!-- /.modal-content -->
								    </div><!-- /.modal-dialog -->
								</div>
								<!-- </li>
							</ul> -->
						<!-- </div> -->
					</div>
					<?php 
					}
					
					?>
					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="left:25px;">
						<div id="polyglotLanguageSwitcher">
						
							<form action="">
								<select id="polyglot-language-options">
									<option id="gr" value="gr" selected>Greek</option>
									<option id="en" value="en">English</option>
									<option id="fr" value="fr">Fran&ccedil;ais</option>
								</select>
							</form>
						</div>
					</div>
				</div>
				
			
			
			</div>
	<?php }?>
		
