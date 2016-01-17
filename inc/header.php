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
<title><?php echo get_title();?></title>

</head>
<body >
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
							<h4 style="color:#FFFAF0;">Εθνικό και Καποδιστριακό Πανεπιστήμιο Αθηνών</h4>
							</div>
						</div>
					</header>
				</div>
				<?php 
				//unset($_SESSION['cart']);
				if(isset($_GET['page']) && $_GET['page'] == 'login_signup') {
					getPage('pages', $_GET['page'], 'main');
					
				} else {
				?>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="left:110px;">
						<div class="upper-nav pull-right">
							<ul class="nav navbar-nav">
								<?php if(isset($_SESSION['username'])) {?>
									 <li
										style="width: 150px; border: 1px solid #E5E5E5; background-color:#992B00; margin-top: 6px; border-radius: 3px; margin-right: 40px;">
										<ul class="nav navbar-nav">
											<li class="dropdown" style="width: 150px;">
											<a href="#"
												class="dropdown-toggle" data-toggle="dropdown"
												style="font-size: 12px; margin-top: 6px; position: relative; bottom: 4px; right: 20px; padding-left: 0px;">
													<span class="glyphicon glyphicon-user"
													style="float: left; top: 3px; margin-right: 5px;"></span>
													<div style="float: left; width: 100px; overflow: hidden; text-overflow: ellipsis; height: 20px; white-space: nowrap;">
														<?php echo $_SESSION['username']?>
													</div> 
													<span class="glyphicon glyphicon-chevron-down"
													style="font-size: 10px; float: right; top: 5px; right: 7px;"></span>
											
											</a>
		
												<ul class="dropdown-menu"
													style="border-radius: 3px; left: -16px;">
													<li style="width: 100%;"><a href="#" style="font-size: 12px;">Προφίλ
															<span class="glyphicon glyphicon-cog" style="left: 8px;"></span>
													</a></li>
		
													<li class="divider" style="width: 100%"></li>
		
													<li style="width: 100%;"><a href="?page=history" style="font-size: 12px;">Ιστορικό
															<span class="glyphicon glyphicon-stats" style="left: 8px;"></span>
													</a></li>
		
													<li class="divider" style="width: 100%"></li>
		
													<li style="width: 100%;"><a href="./pages/logout.php"
														style="font-size: 12px;">Έξοδος<span
															class="glyphicon glyphicon-log-out" style="left: 8px;"></span>
													</a></li>
												</ul></li>
										</ul>
									</li>
								<?php
						
								} else {
									/* <i class="glyphicon glyphicon-log-in" style="right: -5px;"></i> */
									?><li
										style="width: 120px; border: 1px solid #E5E5E5; background-color:#992B00;margin-top: 6px; border-radius: 3px; margin-right: 40px;">
										<a href="?page=login_signup"
											style="color:#FFFAF0; font-size: 12px; margin-top: 6px;background-color:#992B00; position: relative; bottom: 4px; right: 5px;">
											Είσοδος | Εγγραφή
										</a>
									</li>
									<?php
								}
								?>
							</ul>
						</div>
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
						if ((isset ( $_GET ['action'] ) && $_GET ['action'] == "add")) {
							
							
							$materialID = intval ( $_GET ['materialID'] );
							
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
									<button id="cart" class="btn btn-default " type="button" data-toggle="dropdown" style="background-color:#992B00;color:#FFFAF0">
										Καλάθι <i style="color:color:#FFFAF0;"><?php echo '( 0 )';?></i> <i
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
					
						if(isset($_POST['removeBtn']) && $_POST['id_to_remove']!=""){
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
								      <div id="cart-window" class="modal-content">
								        <div class="modal-header">
								         <!--  <button id="header-close-button" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
								        </div>
								        <div class="modal-body">
								          <div class="table-responsive">  
								          <table class="table" id="tblGrid">
								            <thead id="tblHead">
								              <tr>
								                <th>Τίτλος</th>
								                <th>Βιβλιοθήκη</th>
								                <th>Κατηγορία</th>
								                <th>Επιλογή</th>
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
								          <button type="button" class="btn btn-default " data-dismiss="modal">Κλείσιμο</button>
								          <a href="?page=confirmLoan" class="btn btn-primary">Επιβεβαίωση Δανεισμού</a>
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
		
