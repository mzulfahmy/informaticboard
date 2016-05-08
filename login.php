<?php
session_start();
include "includes/config.php";

if(isset($_SESSION['token'])) {
	echo '<script type="text/javascript">window.location.href = "dashboard.php"</script>';

}

$error = '';
if(isset($_POST['login'])){
	$user = $_POST['username'];
	$pass = $_POST['password'];
	$user = mysqli_real_escape_string($dbc, $user);
	$pass = mysqli_real_escape_string($dbc, $pass);
	$pass = md5($pass);

	if(!$user){
		$error = "Please insert your usenamer";

	}

	elseif (!$pass){
		$error = "Please insert your password";
	}

	else {
		$loginsql = "SELECT * FROM user WHERE username = '".$user."' AND password = '".$pass."' ";

		$query = mysqli_query($dbc, $loginsql);
		$userrow = mysqli_num_rows($query);
		$userarray = mysqli_fetch_array($query);

		if($userrow == 0){
			$error = "Invalid access";
			echo '<script type="text/javascript">window.location.href = "login.php"</script>';

		}
		else {
			$_SESSION['token'] = $user;
			header('Location: dashboard.php');

		}
	}
}

else {
	include "header.php";
		echo '
		<div class="row">
			<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
    			<img src="images/logo.png">
				<div class="login-panel panel panel-default">
					<div class="panel-heading">Log in</div>
					<div class="panel-body">
						<form role="form" method="POST" action="">
							'.$error.'
							<fieldset>
								<div class="form-group">
									<input class="form-control" placeholder="Username" name="username" type="username" autofocus="">
								</div>
								<div class="form-group">
									<input class="form-control" placeholder="Password" name="password" type="password" value="">
								</div>
								<div class="checkbox">
								</div>
								<button class="btn btn-primary" name="login" type="submit">Login</button>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
		';

		include "footer.php";
	
}

?>