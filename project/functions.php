	<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
		function checkinput($input){
			global $con;
			return @mysqli_real_escape_string($con,$input);
		}
		function checkoutput($input){
			return @htmlspecialchars($input);
		}
		function redirect($url){
			header("location: ".$url);
			exit;
		}
		function generateRandomString($length = 10) {
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			return $randomString;
		}

	// MYSQL DB FUNCTIONS
		function sqlArray($column,$table,$other="") { 
			global $con;
			$sql=mysqli_query($con,"SELECT $column FROM $table $other");
			//echo "SELECT $column FROM $table $other";
			$array=array();
			if($sql){
				while($row=mysqli_fetch_array($sql)){
					$array[]=$row;
				}
			}
			return($array);
		}
		function sqlAssoc($column,$table,$other="") { 
			global $con;
			$sql=mysqli_query($con,"SELECT $column FROM $table $other");
			//echo "SELECT $column FROM $table $other";
			$array=array();
			if($sql){
				while($row=mysqli_fetch_assoc($sql)){
					$array[]=$row;
				}
			}
			return($array);
		}
		function sqlRow($column,$table,$other=""){
			global $con;
			$sql=mysqli_query($con,"SELECT $column FROM $table $other");
			//echo "SELECT $column FROM $table $other";
			$row=FALSE;
			if($sql){
				$row=mysqli_fetch_row($sql);
			}
			return($row);
		}
		function sqlRows($column,$table,$other=""){
			global $con;
			$sql=mysqli_query($con,"SELECT $column FROM $table $other");
			//echo "SELECT $column FROM $table $other";
			$row=FALSE;$array=array();
			if($sql){
				while($row=mysqli_fetch_row($sql)){
					$array[]=$row[0];
				}
			}
			return($array);
		}
		function sqlNumRows($column,$table,$other=""){
			global $con;
			$sql=mysqli_query($con,"SELECT $column FROM $table $other");
			$row=FALSE;
			if($sql){
				$row=mysqli_num_rows($sql);
			}
			return($row);
		}
		function sqlUpdate($table,$column,$other=""){
			global $con;
			$sql=mysqli_query($con,"UPDATE $table SET $column $other");
		// echo "UPDATE $table SET $column $other";
			$row=FALSE;
			if($sql){
				$row=mysqli_affected_rows($con);
			}
			return($row);
		}
		
		function sqlDelete($table,$other=""){
			global $con;
			$sql=mysqli_query($con,"DELETE FROM $table $other");
			$row=FALSE;
			if($sql){
				$row=mysqli_affected_rows($con);
			}
			return($row);
		}
		function sqlInsert($table,$values){
			global $con;
			$sql=mysqli_query($con,"INSERT INTO $table VALUES($values)");
			//echo "INSERT INTO $table VALUES($values)";
			$row=FALSE;
			if($sql){
				$row=mysqli_insert_id($con);
			}
			return $row;
		}
		function sendMail($to_email, $subject, $content){
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->Mailer = "smtp";
			$mail->SMTPAuth   = TRUE;
			$mail->SMTPSecure = "tls";
			$mail->Port       = 587;
			$mail->Host       = "smtp.gmail.com";
			$mail->Username   = "smtp.wandrit@gmail.com";
			$mail->Password   = "wandrit123";
			$mail->IsHTML(true);
			$mail->AddAddress($to_email, "");
			$mail->SetFrom("smtp.wandrit@gmail.com", "WANDR'IT services");
			$mail->Subject = $subject;
			$content = "<b>".$content."</b>";
			$mail->MsgHTML($content); 
			if(!$mail->Send()) {
				return FALSE;
			} else {
				return TRUE;
			}
		}
		function uLogin($email,$pass){
			$thisUser = sqlArray("*","users","WHERE email = '".checkinput($email)."' ");
			if(@$thisUser){
				return ($thisUser[0]['password']===md5($pass)?$thisUser[0]:FALSE);
			}
			return FALSE;
		}
		function uRegister($name,$email,$password){
			if(emailExists($email)){
				return "Email exists ";
			}else{
				$dir = './projects/'.md5($email);
				if (!file_exists($dir)) {
					mkdir($dir, 0777, true);
				}
				return( sqlInsert("users (id, email, fullname, password)"," NULL, '".checkinput($email)."', '".checkinput($name)."', '".md5($password)."'  ")>0?'Registration Success':FALSE );
			}
		}
		function emailExists($email){
			return (sqlNumRows("id","users","WHERE email='".checkinput($email)."'  ")>0?TRUE:FALSE);
		}
		function apiputs($status,$msg){
			header('Content-Type: application/json');
			$status=($status===1)?"OK":"NO";
			echo json_encode(array(
				"status"=>$status,
				"msg"=>$msg
			));
			exit;
		}
		function newClient($title,$email){
			$dir = './projects/'.md5($_SESSION['usr']['email']).'/'.md5($title.uniqid());
			//var_dump($dir);
			if (!file_exists($dir)) {
				mkdir($dir, 0777, true);
				file_put_contents($dir.'/info.txt', $title."\n\n\n\n".$email);
				file_put_contents($dir.'/file.md', "");
				system("./bin/md2pdf-linux-amd64 -o ".$dir.'/file.pdf '.$dir.'/file.md ');
				$res = sendMail($email,"Reporting phase started", "Dear client,<br>Wandr'it services want to inform you that ".$_SESSION["usr"]["fullname"]." started the reporting phase.<br> you can follow the progress of building the report step by step using this unique link: http://".$_SERVER["HTTP_HOST"]."/project/".$dir.'/file.pdf');
				if($res){
					return TRUE;
				}else{
				return FALSE;
				}
			}
		}
		function updatePassword($email, $newpass){
			$res = sqlUpdate("users","password='".md5($newpass)."'", "WHERE email='".checkinput($email)."'");
			//echo $res;
			if($res){
				return "donesuccess";
			}else{
				return "error";
			}
		}
		function getName(){
			$name = $_SESSION["usr"]["fullname"];
			$kek = explode(" ", $name);
			$res = "";
			foreach($kek as $word){
				$res = $res . $word[0];
			}
			return $res;
		}
		function deliverWork($id){
			$dir = './projects/'.md5($_SESSION['usr']['email'])."/".$id;
			$cont = file_get_contents($dir."/info.txt");
			$email = explode("\n\n\n\n",$cont)[1];
			$res = sendMail($email, "Reporting phase finished","Dear client,<br>Wandr'it services want to inform you that ".$_SESSION["usr"]["fullname"]." finished the reporting phase.<br> Please find your final report via this unique link: http://".$_SERVER["HTTP_HOST"]."/project/".$dir."/file.pdf");
			if($res){
				return "done";
			}else{
				return "error";
			}
		}
		function generatePassword(){
			srand(time());
			$charset = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!"#$%&\'()*+,-./:;<=>?@[\\]^_`{|}~ \t\n\r\x0b\x0c';
			$pass = "";
			for($i = 0 ; $i<12 ; $i++){
				$pass = $pass.$charset[rand()%strlen($charset)];
				$charset = str_shuffle($charset);
			}
			return $pass;
		}
		function resetPassword($email){
			if(emailExists($email)){
				$new = generatePassword();
				$msg = updatePassword($email,$new);
				sendMail($email,"Password reset","Dear client,<br>Wandr'it services want to inform you that your passowrd changed.<br>you can use this password to login: ".$new."<br> And feel free to change it in settings section in your profile");
			}
			return $msg;
		}
		