<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'config.php';
if(@$_SESSION["usr"]){
	redirect("./?page");
}
if(@$_POST["action"] === "reset_password"){
	if(@$_POST["email"]){
		$msg = resetPassword($_POST["email"]);
	}
}
if(@$_POST['action']==='Login'){
	if(@$_POST['Name'] AND @$_POST['Password']){
		$thisUser = uLogin($_POST['Name'] , $_POST['Password']);
		if($thisUser){
			$_SESSION['usr']=$thisUser;
			redirect('./?page');
		}else{
			$msg = "Login failed";
		}
	}
}elseif(@$_POST['action']==='Register'){
	if(@$_POST['Name']  AND @$_POST['Email']  AND @$_POST['Confirm_Password'] AND @$_POST['Password']){
		if($_POST['Confirm_Password'] !== @$_POST['Password']){
			$msg = "Password mismatch ";
		}else{
			$msg = uRegister($_POST['Name'],$_POST['Email'],$_POST['Confirm_Password'],$_POST['Password']);
		}
		
	}
}


?>

<!DOCTYPE HTML>
<html lang="en">

<head>
	<title>WandR'it</title>
	<meta charset="utf-8">
	<meta property="og:title" content="WandR'it">
	<meta property="og:site_name" content="WandR'it">
	<meta property="og:image" content="/images/2.png">
	<meta property="og:description" content="A nice easy to use reporting platforme">
	<meta property="og:url" content="#">
	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link href="//fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=devanagari,latin-ext"
	 rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/blur.css">
</head>

<body>
	<main id="myContainer" class="MainContainer">
	<div class="main-w3ls">
		<div class="left-content">
			<div class="w3ls-content">
				<div>
				<span><h3 class="desc" >Wandrit is an easy to use reporting platforme that help you organize your projects and cordinate with your clients.</h3>
				</span>
				</div>
			</div>
		</div>
		<div class="right-form-agile">
			<div class="sub-main-w3">
				<br><br><br><br><br>
				<h3>Login</h3>
				<br><?=(@$msg?'<h4><font color="'.(stripos($msg, "Success")?"green":"red").'">'.$msg.'</font></h4>':'')?><br>
				<form action="" method="post">
					<div class="form-style-agile">
						<div class="pom-agile">
							<span class="fa fa-user"></span>
							<input placeholder="Email" name="Name" type="text" required="">
						</div>
					</div>
					<div class="form-style-agile">
						<div class="pom-agile">
							<span class="fa fa-key"></span>
							<input placeholder="Password" name="Password" type="password" id="password1" required="">
						</div>
					</div>
					<input type="hidden" name="action" value="Login">
					<input type="submit" value="Submit">
				</form>
				<div class="alert alert-danger">
					<strong>Success!</strong> You should <a href="#" class="alert-link">read this message</a>.
				</div>
				

			<a class="" href="#!" data-toggle="modal" data-target="#exampleModal">Forgot Password ?</a><br>
            <!-- Open The Modal -->
            <span style="color:white">  Don't have an account ? </span> 
            <br>
             <button id="myBtn" class="btn"><span style="color:blue"> Sign up </span></button>
        </main>



<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content bg-dark2" >
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Reset password</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <form action="" method="post" class="jFORM">
			      <div class="modal-body">
			      	<div class="whereTo"><p></p></div>
			      	<div class="form-group">
					    <label for="exampleFormControlInput1">Email address</label>
					    <input name='email' type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
						<input type="hidden" name="action" value="reset_password">
					</div>
					


			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <button type="submit" class="btn btn-primary">Send</button>
			      </div>
		  	  </form>
		    </div>
		  </div>
		</div>




        <!-- Modal container it includes the overlay -->
        <div id="myModal" class="Modal is-hidden is-visuallyHidden">
            <!-- Modal content -->
            <div class="Modal-content">
                <span id="closeModal" class="Close">&times;</span>
                <div class="sub-main-w3 signup" >
                <form action="#" method="post">
                    <div class="form-style-agile">
						<h3 style="margin-left: 100px; padding: 10px;">Register Now</h3>
                        <label>Your Name</label>
                        <div class="pom-agile">
                            <span class="fa fa-user"></span>
                            <input placeholder="Your Name" name="Name" type="text" required="" value="<?=checkoutput(@$_POST['Name'])?>">
                        </div>
                    </div>
                    <div class="form-style-agile">
                        <label>Email</label>
                        <div class="pom-agile">
                            <span class="fa fa-envelope-open"></span>
                            <input placeholder="Email" name="Email" type="email" required="" value="<?=checkoutput(@$_POST['Email'])?>">
                        </div>
                    </div>
                    <div class="form-style-agile">
                        <label>Password</label>
                        <div class="pom-agile">
                            <span class="fa fa-key"></span>
                            <input placeholder="Password" name="Password" type="password" id="password1" required="" value="<?=checkoutput(@$_POST['Password'])?>">
                        </div>
                    </div>
                    <div class="form-style-agile">
                        <label>Confirm Password</label>
                        <div class="pom-agile">
                            <span class="fa fa-key"></span>
                            <input placeholder="Confirm Password" name="Confirm Password" type="password" id="password2" required="" value="<?=checkoutput(@$_POST['Password'])?>">
                        </div>
                    </div>
                    <div class="sub-agile">
                        <input type="checkbox" id="brand1" value="">
                        <label for="brand1">
                            <span style="color:white">I Accept to the Terms & Conditions</span></label>
                    </div>
                    <input type="hidden" name="action" value="Register">
                    <input type="submit" value="Submit">
                
            </div>
        </div>

        <script src="js/blur.js"></script>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>