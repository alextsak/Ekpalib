<?php 
include_once '../database/Model/User.php';

session_start();

if(isset($_POST['login-form'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	//echo $username;
	
	$user = new User();
	$message = $user->Login($username, $password);
	if($message == "User found"){
		$_SESSION['username'] = $username;
		//echo "Welcome " . $username . " ! ";
		header("Location: ../index.php");
	}
	else {
		echo $message;
	}
}
if(isset($_POST['register-form'])){
	$reg_array = array();
	array_push($reg_array,$_POST['username'], $_POST['password'],$_POST['firstName'], $_POST['lastName'], $_POST['phonenumber'], $_POST['email'], $_POST['academicID'], $_POST['academicPass']);
	$user = new User();
	$username = $_POST['username'];
	$message = $user->RegisterUser($reg_array);
	if($message == "registered"){
		//echo "Welcome " . $username . " ! ";
		$_SESSION['username'] = $username;
		header("Location: ../index.php");
	}
	else {
		echo 'Something went wrong :(';
	}
}

?>
<!DOCTYPE html>
<html>
	<head>
		<base href="http://localhost:5555/Ekpalib/">
	 	<link rel="stylesheet" href="css/login-signup.css" type="text/css" media="all">
	 	<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
	 	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  		<script src="js/Login-Signup.js"></script>
  		<script src="bootstrap/bootstrap.js"></script>
	</head>
	
	<body>
		<div class="container">
		    	<?php include_once '../inc/header.php';?>
		    	<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<div class="panel panel-login">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-6">
										<a href="#" class="active" id="login-form-link">Login</a>
									</div>
									<div class="col-xs-6">
										<a href="#" id="register-form-link">Register</a>
									</div>
								</div>
								<hr>
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-12">
										<form id="login-form" style="display: block;" method="POST" action="">
											<div class="form-group">
												<input type="text" name="username" id="log-in-username" tabindex="1" class="form-control" placeholder="Username" value="">
											</div>
											<div class="form-group">
												<input type="password" name="password" id="log-in-password" tabindex="2" class="form-control" placeholder="Password">
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col-sm-6 col-sm-offset-3">
														 <input id="login-submit" type="submit" name="login-form" value="Log in" tabindex="4" class="form-control btn btn-primary"/> 
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col-lg-12">
														<div class="form-group text-center">
															<label>Alternatively, you can enter as guest!</label> 
														</div>
														<!-- <div class="col-sm-4 col-sm-offset-4">
															<button  name="guest-submit" id="guest-submit" tabindex="4" class="form-control btn btn-primary ">Enter as guest</button>
														</div> -->
													</div>
												</div>
											</div>
										</form>
										<form id="register-form"  role="form" style="display:none;" method="POST" action="">
											<div class="row">
											  	<div class="col-md-12" role="form">
												  	<div class="form-group">
														<input type="text" name="username" id="sign-up-username" tabindex="1" class="form-control" placeholder="Username*" value="">
													</div>
											  	</div>
											  
											  	<div class="col-md-6" role="form">
													<div class="form-group">
														<input type="password" name="password" id="sign-up-password" tabindex="2" class="form-control" placeholder="Password*">
													</div>
												</div>
												
												<div class="col-md-6" role="form">
													<div class="form-group">
														<input type="password" name="confirm-password" id="sign-up-confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password*">
													</div>
												</div>
												
											  	<div class="col-md-6" role="form">
												  	<div class="form-group">
														<input type="email" name="email" id="sign-up-email" tabindex="2" class="form-control" placeholder="Email Address*" value="">
													</div>
											  	</div>
											  <div class="col-md-6" role="form">
													<div class="form-group">
														<input type="text" name="phonenumber" id="sign-up-phonenumber" tabindex="2" class="form-control" placeholder="Phone Number">
													</div>
												</div>
											  	
												
												
											</div>  
											<!-- row1 -->
										
											<div class="row">
												<div class="col-md-6" role="form">
													<div class="form-group">
														<input type="text" name="firstName" id="sign-up-firstname" tabindex="2" class="form-control" placeholder="Firstname">
													</div>
												</div>
												
												<div class="col-md-6" role="form">
													<div class="form-group">
														<input type="text" name="lastName" id="sign-up-lastname" tabindex="2" class="form-control" placeholder="Lastname">
													</div>
												</div>
												
												
											</div>
											<!-- row2 -->
											<div class="row">
												<div class="col-md-6" role="form">
													<div class="form-group">
														<input type="text" name="academicID" id="sign-up-street" tabindex="2" class="form-control" placeholder="Academic ID*">
															<i id="questionMark" class="glyphicon glyphicon-question-sign form-control-feedback" 
																		data-toggle="tooltip" title="first tooltip"></i>
													</div>
												</div>
												<div class="col-md-6" role="form">
													<div class="form-group">
														<input type="password" name="academicPass" id="sign-up-street" tabindex="2" class="form-control" placeholder="Academic Password*">
														

													</div>
												</div>
												
											</div>
											<!-- row3 -->
											
											<div class="form-group">
												<div class="row">
													<div class="col-sm-6 col-sm-offset-3">
														<input id="register-submit" type="submit" name="register-form" tabindex="4" value="Register" class="btn btn-primary form-control"/>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
		</div>
	</body>
</html>