<?php
	if(!@$_GET['id']) redirect('./index.php?page=main');
	if(!ctype_alnum($_GET['id'])) die('no');
?>
<section>
	
	<div class="container">
		<div class="row bg-dark2">
		  
		  <div class="col-sm-12" style="padding-top: 50px;">
		  	<div class=" text-center justify-content-center">
			  	
			  		<div style="display: inline-flex;">
						<div class="wrapper"><button class="btn btn-secondary" id="edit">Edit</button></div>
						<div class="wrapper"><button style="margin-left:5px;" class="btn btn-secondary" id="preview" align="center">Preview</button></div>

						<div class="wrapper"><button style="margin-left:5px;" class="btn btn-secondary" id="save" align="center">Save</button></div>
						<div class="wrapper"><button style="margin-left:5px;" class="btn btn-secondary" id="deliver" align="center">Deliver</button></div>
						<div class="wrapper"><button style="margin-left:5px;" class="btn btn-secondary" id="delete" align="center">Delete</button></div>
						<div class="wrapper"><button style="margin-left:5px;" class="btn btn-secondary" id="upload" align="center">Upload image</button></div>
					</div>
					<br>
					<br>
					<br>
					<center>
						<img src="https://media.giphy.com/media/3oEjI6SIIHBdRxXI40/source.gif" width="100" height="100" align="center" id="loading">
					</center>
					<center>
						<label id="alert" class="label label-success"></label>
					</center>
				
				<br>
				<br>
				<input type="hidden" name="ok" id="projectID" value="<?=checkoutput($_GET['id'])?>">
				<input type="hidden" name="okk" id="userID" value="<?=checkoutput(md5($_SESSION['usr']['email']))?>">
				</div>
				<div id="filecontent" class="display_res">
				</div>

				<center>
					<div class="textarea-wrapper">
						<textarea id="mdcontent" cols="100" rows="33"><?=checkoutput(file_get_contents('./projects/'.md5($_SESSION['usr']['email']).'/'.$_GET['id'].'/file.md'))?></textarea>
					</div>
					<br>
					<a href="" id="result_link" onclick="open_tab()">Click this link to download the pdf</a>
				</center>
				  	
		  </div>



		</div>
	</div>
</section>
	