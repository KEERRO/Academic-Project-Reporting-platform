<?php
  if(!@$_GET['id']) redirect('./index.php?page=main');
  if(!ctype_alnum($_GET['id'])) die('no');
  if(@$_POST["back"]) redirect("./index.php?page=dashboard&id=".$_GET["id"]);
  if(@$_POST["upload"]){
    //var_dump($_FILES["pictures"]);
    $tmp_name = $_FILES["pictures"]["tmp_name"];
    // basename() may prevent filesystem traversal attacks;
    // further validation/sanitation of the filename may be appropriate
    $name = basename($_FILES["pictures"]["name"]);
    $dir = "./projects/".md5($_SESSION["usr"]["email"])."/".$_GET["id"];
    move_uploaded_file($tmp_name,$dir."/".$name);
  }
?>
<section>
    <style>
      .button-class {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
      }
    </style>
      <div class="col-sm-12" style="padding-top: 50px;">
        <div class=" text-center justify-content-center">
          <form action="" method="post" enctype="multipart/form-data">
          <p>Pictures:
          <input type="file" name="pictures" />
          <br>
          <br><br>
          <h4 style="margin-left: -5%;"><font color="red">JPG Format only!</font></h4>
          <input type="submit" value="Back" name="back"  class="button-class" style="margin-left: -5%;background-color: #669999;"/>
          <input type="submit" value="Upload" name="upload" class="button-class" style="background-color: #0066cc;"/>
          </p>
          </form>
        </div>
      </div>
</section>
  