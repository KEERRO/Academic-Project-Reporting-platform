<?php

?>

<section>
	
	<div class="container pddtop">
		<div class="row bg-dark2">
		<h3>Profile settings</h3>

		<div class="container">
			<div class="row">
				<div class="col-sm-4">
		    		
					<label>Full name</label>
					<div class="form-group pass_show"> 
						<input type="text" class="form-control" value="<?=$_SESSION['usr']['fullname']?>" readonly> 
					</div> 
					<label>Email</label>
					<div class="form-group pass_show"> 
					<input type="text" class="form-control" value="<?=$_SESSION['usr']['email']?>" readonly>  
					</div> 
					<br>
					<br>
					<h3>Security settings</h3>
					<form name="f" action="../" method="post">
						<label>Current Password</label>
						<div class="form-group pass_show"> 
							<input type="password" id="current"  class="form-control" placeholder="Current Password"> 
						</div> 
						<label>New Password</label>
						<div class="form-group pass_show"> 
							<input type="password"  id="new" class="form-control" placeholder="New Password"> 
						</div> 
						<label>Confirm Password</label>
						<div class="form-group pass_show"> 
							<input type="password"  id="new_conf" class="form-control" placeholder="Confirm Password"> 
						</div>
						
						<input type="button" id="savepass" value="Submit">

					</form>
					<br>
			
					<div class=""  id="alrt" >
						
						</div>
				</div>  
			</div>
		</div>



		</div>
	</div>
	
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" ></script>
	<script language="javascript">
		$("#savepass").click(function() {
			var curr = document.getElementById("current").value;
			var New = document.getElementById("new").value;
			var new_conf = document.getElementById("new_conf").value;
			
			data = "current="+curr+"&new=" + New + "&new_conf=" + new_conf + "&reset=true";
			$.ajax({
			type: "POST",
			url: "./backend.php",
			data: data,
			success: function(resp) {
				//alert(resp);
				if(resp.indexOf("done")){
					var nod = document.getElementById("alrt");
					nod["class"] = "alert-success alerts";
					nod["style"] = "color: green;"
					nod.innerText= "Password successfully updated";
				}else if (resp == "mismatch"){
					var nod = document.getElementById("alrt");
					nod["class"] = "alert-danger alerts";
					nod["style"] = "color: red;"
					nod.innerText = "Password confirmation mismatch";
				}else{
					var nod = document.getElementById("alrt");
					nod["class"] = "alert-danger alerts";
					nod["style"] = "color: red;"
					nod.innerText = "An error occured while changing password please contact an administrator"; 
				};
			}
			});
			return false;
		});

	
	</script>
</section>