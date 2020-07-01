<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'config.php';

if(!@$_SESSION['usr']['email']) redirect('./login.php');


if(@$_GET['page']==='' OR @$_GET['page']==='main'){
	$page = 'main.php';
}elseif(@$_GET['page']==='settings'){
	$page = 'settings.php';
}elseif(@$_GET['page']==='dashboard'){
	$page = 'dashboard.php';
}elseif(@$_GET['page']==='upload'){
	$page = 'upload.php';
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
	<link href="css/icons/css/line-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/mystyles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.0.3/styles/default.min.css">
    
</head>

<body class="bg-dark2">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark2 bg-border">
	  <a class="navbar-brand" href="../"><img src="images/logo.png" width = "110" height="60"></img></a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item active">
	        <a class="nav-link" href="./index.php?page=main ">Home <span class="sr-only">(current)</span></a>
	      </li>
	      
	    </ul>
		
		<div class="form-inline my-2 my-lg-0">
		<div class="dropdown">
			<button class="btn btn-secondary dropdown-toggle dali" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<?=checkoutput(strtoupper(getName()))?>
			</button>
			<div class="dropdown-menu dali2" aria-labelledby="dropdownMenuButton">
				<a class="dropdown-item" href="./index.php?page=settings">Settings</a>
				<a class="dropdown-item" href="./logout.php">Logout</a>
			</div>
		</div>
		</div>


	  </div>
	</nav>

	


	<?php include 'pages/'.$page; ?>
	


	<script src="https://code.jquery.com/jquery-3.5.1.min.js" ></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

		<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.0.3/highlight.min.js"></script>
		<script src="https://cdn.jsdelivr.net/remarkable/1.7.1/remarkable.min.js"></script>
	    <script src="js/funcs.js"></script>
	<script>
            $(document).ready(function() {
                $(".jFORM").on("submit", function(e){
                    e.preventDefault();
                    whereTo = $(this).children().find('.whereTo');
                    var formData = new FormData($(this)[0]);
                    $.ajax({
                      url: "./backend.php",
                      type: 'POST',
                      data : formData,
                      processData: false,  
                      contentType: false, 
                      success: function(data){
						//alert(data);
                        resp=data;
                        if(resp.status=='OK'){
                          whereTo.removeClass('alert-danger');
                          whereTo.addClass('alert-success');
                          whereTo.children('p').text(resp.msg);
                          whereTo.css('display','');
                          setTimeout(function() { location.reload(); }, 1000);
                        }else{
                          whereTo.removeClass('alert-success');
                          whereTo.addClass('alert-danger');
                          whereTo.children('p').text(resp.msg);
                          whereTo.css('display','');
                        }
                      }
                    });
                    return false;
                });
            });
    </script>
</body>

</html>