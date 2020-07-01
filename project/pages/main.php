<section>

	<div class="container">
		<div class="row bg-dark2">
		  <div class="col-sm-12 text-center justify-content-center" style="padding: 20px;">
		  	<div class=" text-center">
		  		
		  		<form class="form-inline text-center" style="margin-left:35%;">
				  <input class="form-control w-50 " type="text" style="background-color: #374150;border:0px;" placeholder="Search" aria-label="Search">
				  <i class="las la-search" style="margin-left: 10px;"></i>
				</form>
		        
		    </div>
		  </div>
		  <div class="col-sm-12" style="padding-top: 50px;">
		  	<div class=" text-center justify-content-center">
			  		
			  		<?php
			  			$dir="./projects/".md5($_SESSION['usr']['email']);
			  			$scandir = scandir($dir );
			  			foreach ($scandir as $key => $value) {

			  				if($value!="." AND $value!=".."){
			  		?>
			  			<a class="box2 elem" href="./index.php?page=dashboard&id=<?=$value?>" >
						   <b><p><font color="white"><?=checkoutput(explode("\n\n\n\n",file_get_contents($dir."/".$value."/info.txt"))[0])?></font></p></b>
						</a>
			  		<?php
			  				}
			  			}
			  		?>

					<a class="box2 elem" href="#!" data-toggle="modal" data-target="#exampleModal">
						<p><i class="las la-plus-circle" style="font-size: 1.3rem;"></i></p>
					</a>

			</div>	  	
		  </div>



		</div>
	</div>
	</section>
	<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content bg-dark2" >
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">New Client</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <form class="jFORM">
			      <div class="modal-body">
			      	<div class="whereTo"><p></p></div>
			      	<div class="form-group">
					    <label for="exampleFormControlInput1">Title</label>
					    <input name='title' type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
					</div>
			        <div class="form-group">
					    <label for="exampleFormControlInput1">Email address</label>
					    <input name='email' type="email" class="form-control" id="exampleFormControlInput1" placeholder="">
					</div>


			      </div>
			      <div class="modal-footer">
			      	<input type="hidden" name="action" value="newclient">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <button type="submit" class="btn btn-primary">Save changes</button>
			      </div>
		  	  </form>
		    </div>
		  </div>
		</div>