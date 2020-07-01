<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'config.php';

if(@$_POST["deliver"] === "true" AND @$_POST["id"]){
	$res = deliverWork($_POST["id"]);
	echo $res;
	die();
}

if(@$_POST["delete"]==="true" AND @$_POST["id"]){
	$currmail = $_SESSION["usr"]["email"];
	$hashed = md5($currmail);
	$prev = count(scandir("./projects/".$hashed."/"));
	$path = "./projects/".$hashed."/".$_POST["id"];
	//echo $path;
	system("rm -r ".checkinput($path));
	$now = count(scandir("./projects/".$hashed."/"));
	if($now != $prev){
		echo "done";
	}else{
		echo "errorrrrrreeer";
	}
	die();
}

if(@$_POST['action']==='newclient'){
	if(@$_POST['title'] AND @$_POST['email']){
		if(newClient(@$_POST['title'],@$_POST['email'])){
			apiputs(1,'SUCCESS');
		}
		apiputs(0,'FAIL');
	}else{
		apiputs(0,'FAIL');
	}
}

//echo gettype($_POST["reset"]);
if(@$_POST['reset'] === 'true'){
	$msg = "";
	if(isset($_POST['current']) AND isset($_POST['new']) AND isset($_POST['new_conf'])){
		
		if($_POST['new'] !== $_POST['new_conf']){
			$msg = "mismatch";
		}
		else{
			
			$thisUser = uLogin($_SESSION['usr']['email'] , $_POST['current']);
			//var_dump($thisUser);
			if($thisUser){
				$msg = updatePassword($_SESSION['usr']['email'], $_POST['new']);
			}else{
				$msg = "error";
			}
		}
	}
	echo $msg;	
	die();
}


if(@$_POST['mdcontent'] AND @$_POST['id']){
	if(!ctype_alnum($_POST['id'])) die('no');

	$myfile = fopen('./projects/'.md5($_SESSION['usr']['email']).'/'.$_POST['id'].'/file.md' , "w") or die("error");
	$kek = $_POST["mdcontent"];
	$data = base64_decode($kek);
	fwrite($myfile, $data) or die("error");
	fclose($myfile);
	system("./bin/md2pdf-linux-amd64 -o ".'./projects/'.md5($_SESSION['usr']['email']).'/'.$_POST['id'].'/file.pdf '.'./projects/'.md5($_SESSION['usr']['email']).'/'.$_POST['id'].'/file.md');
	echo "done";

}else{
	echo "fill the document";
}

