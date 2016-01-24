<?php 
error_reporting(E_ALL);

/*
 * Creating the logic for the login and the registration process
 */

if(isset($_POST['login-form-btn']) && !empty($_POST['login-form-btn'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$user = new User();
	$message = "";
	$message = $user->Login($username, $password);
	if($message == "User found"){
		$_SESSION['username'] = $username;
		$base = get_basename();
		header('Location: ' . $base);	
	}

}
if(isset($_POST['register-form-btn']) && !empty($_POST['register-form-btn'])){
	$reg_array = array();
	array_push($reg_array,$_POST['username'], $_POST['password'],$_POST['firstName'], $_POST['lastName'], $_POST['phonenumber'], $_POST['email'], $_POST['academicID'], $_POST['academicPass']);
	$user = new User();
	$username = $_POST['username'];
	$message = $user->RegisterUser($reg_array);
	if($message == "registered"){
		$_SESSION['username'] = $username;
		$base = get_basename();
		header('Location: ' . $base);
	}
	else {
		$message_error = "Η εγγραφη σας δεν ολοκληρώθηκε σωστά";
		echo "<script>error_messages('$message_error');</script>";
	}
	
	
}

?>

		    	<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<div class="panel panel-login">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-6">
										<a href="#" class="active" id="login-form-link">Είσοδος</a>
									</div>
									<div class="col-xs-6">
										<a href="#" id="register-form-link">Εγγραφή</a>
									</div>
								</div>
								<hr>
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-12">
										<form id="login-form" style="display: block;" method="POST" action="">
											<div class="form-group">
												<input type="text" name="username" id="log-in-username" tabindex="1" class="form-control" placeholder="Όνομα Χρήστη" value="">
											</div>
											<div class="form-group">
												<input type="password" name="password" id="log-in-password" tabindex="2" class="form-control" placeholder="Κωδικός Χρήστη">
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col-sm-6 col-sm-offset-3">
														 <input id="login-submit" type="submit" name="login-form-btn" value="Είσοδος" tabindex="4" class="form-control btn btn-primary"/> 
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col-lg-12">
														<div class="form-group text-center">
														<?php if(isset($message) && $message != 'User found') {
															echo '<label style="color:orange;">'.  $message . '</label>';
															}
														?>
															 
														</div>
													</div>
												</div>
											</div>
										</form>
										<form id="register-form"  role="form" style="display:none;" method="POST" action="">
											<div class="row">
											  	<div class="col-md-12" role="form">
												  	<div class="form-group">
														<input type="text" name="username" id="sign-up-username" tabindex="1" class="form-control" placeholder="Όνομα Χρήστη*" value="">
													</div>
											  	</div>
											  
											  	<div class="col-md-6" role="form">
													<div class="form-group">
														<input type="password" name="password" id="sign-up-password" tabindex="2" class="form-control" placeholder="Κωδικός*">
													</div>
												</div>
												
												<div class="col-md-6" role="form">
													<div class="form-group">
														<input type="password" name="confirm-password" id="sign-up-confirm-password" tabindex="2" class="form-control" placeholder="Επιβεβαίωση Κωδικού*">
													</div>
												</div>
												<div id="divCheckPasswordMatch" style="text-align:center; color:orange; margin-bottom:2em;">
												</div>
											  	<div class="col-md-6" role="form">
												  	<div class="form-group">
														<input type="email" name="email" id="sign-up-email" tabindex="2" class="form-control" placeholder="Διεύθυνση ηλ. ταχυδρομείου*" value="">
													</div>
											  	</div>
											  <div class="col-md-6" role="form">
													<div class="form-group">
														<input type="text" name="phonenumber" id="sign-up-phonenumber" tabindex="2" class="form-control" placeholder="Αριθμός Τηλεφώνου">
													</div>
												</div>												
											</div>  

											<div class="row">
												<div class="col-md-6" role="form">
													<div class="form-group">
														<input type="text" name="firstName" id="sign-up-firstname" tabindex="2" class="form-control" placeholder="Όνομα">
													</div>
												</div>
												
												<div class="col-md-6" role="form">
													<div class="form-group">
														<input type="text" name="lastName" id="sign-up-lastname" tabindex="2" class="form-control" placeholder="Επώνυμο">
													</div>
												</div>
											</div>
											<!-- row2 -->
											<div class="row">
												<div class="col-md-6" role="form">
												    <div class="input-group add-on">
													    <input type="text" name="academicID" id="sign-up-academic-id" tabindex="2" class="form-control" placeholder="Ακαδημαϊκό Α.Μ.*">
													        <span class="input-group-addon">
													            <a class='my-tool-tip' data-toggle="tooltip" data-placement="top" title="Εισάγετε τον Αριθμό Μητρώου που σας έχει δοθεί από την γραμματεία του τμηματός σας">
													                <i class='glyphicon glyphicon-question-sign'></i>
													            </a>
													        </span>
													</div>
												</div>
												<div class="col-md-6" role="form">
													<div class="input-group add-on">
														<input type="password" name="academicPass" id="sign-up-academic-pass" tabindex="2" class="form-control" placeholder="Ακαδημαϊκός Κωδικός*">
															<span class="input-group-addon">
													            <a class='my-tool-tip' data-toggle="tooltip" data-placement="top" title="Εισάγετε τον ακαδημαϊκό κωδικό που χρησιμοποιείτε">
													                <i class='glyphicon glyphicon-question-sign'></i>
													            </a>
													        </span>
													</div>
												</div>
												
											</div>
											<!-- row3 -->
											
											<div class="form-group">
												<div class="row">
													<div class="col-sm-6 col-sm-offset-3">
														<input id="register-submit" type="submit" name="register-form-btn" tabindex="4" value="Εγγραφή" class="btn btn-primary form-control"/>
													</div>
												</div>
											</div>
											<div id="empty-fields" style="text-align: center; color:orange;">
												Τα πεδία με αστερίσκο(*) είναι απαραίτητο να συμπληρωθούν
											</div>
										</form>
									
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
	