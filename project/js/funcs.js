function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}

$(function() {
  $("#filecontent").hide();
  $("#loading").hide();
  $("#alert").hide();
  $("#result_link").hide();
    $("#edit").click(function() {
      // validate and process form here
      $("#filecontent").hide();
      $("#mdcontent").show();
      return false;
      
    });

    $("#preview").click(function() {
      $("#filecontent").show();
      document.getElementById("filecontent").innerHTML = "";
     
      text = document.getElementById("mdcontent").value
      var md = new Remarkable();
      md.set({
          html: true,
          breaks: true
      });
      html = md.render(text);
      document.getElementById("filecontent").innerHTML = html;
      $("#mdcontent").hide();

      document.querySelectorAll('pre code').forEach((block) => {
        hljs.highlightBlock(block);
      });
      document.querySelectorAll('p code').forEach((block) => {
        block.classList.add("plainstyle");
        
      });
      var nods = document.getElementById("filecontent").childNodes;
      for(var i = 0 ; i<nods.length ; i++){
        x = nods[i].childNodes;
        for(var j = 0 ; j < x.length ; j++){
          if(x[j].nodeName == "IMG"){
            to_prepare = x[j];
            kek = to_prepare.src;
            filename =  kek.slice(kek.lastIndexOf("/"));
            var to_append = document.createElement("BR");
            to_prepare.src = "./projects/" + document.getElementById("userID").value + "/" + document.getElementById("projectID").value + filename ;
            to_prepare.appendChild(to_append);
            to_prepare.appendChild(to_append);
          }
        }
      }

      return false;
      
    });

    /*$("form").submit(function(e){
      e.preventDefault();
      return false;
    });*/


      $("#delete").click(function() {

      var projectID = document.getElementById("projectID").value;
      data = "id="+projectID + "&delete=true";
      $.ajax({
        type: "POST",
        url: "./backend.php",
        data: data,
        success: function(resp) {
          if(resp.indexOf("done")){
            document.location.href = "/project/index.php?page";
          }else{
            //alert("error");
          }
        }

      });
      return false;
      
    });




    $("#save").click(async function() {

      $("#mdcontent").hide();
      $("#filecontent").hide();
      $("#mdcontent").show();
      $("#loading").show();
      await sleep(1000);
      var mdcont = document.getElementById("mdcontent").value
      var projectID = document.getElementById("projectID").value
      data = "id="+projectID+"&mdcontent=" + btoa(mdcont);
      $.ajax({

        type: "POST",
        url: "./backend.php",
        data: data,
        success: function(resp) {
          //alert(resp);
          if(resp.indexOf("done")){
            $("#loading").hide();
            $('label#alert').show();
            $('label#alert').removeClass();
            $('label#alert').addClass("label label-success");
            $('label#alert').text("Saved successfully").hide().fadeIn(2500,function(){
            $('label#alert').hide();
            });
          }else{
            $("#loading").hide();
            $('label#alert').show();
            $('label#alert').removeClass();
            $('label#alert').addClass("label label-warning");
            $('label#alert').text("Error while saving please resave after 15 seconds").hide().fadeIn(2500,function(){
            $('label#alert').hide();
            });
          }
        }

      });
      return false;
      
    });


    $("#deliver").click(function() {
      $("#save").click();
      setTimeout(()=>{
        
      var ID = document.getElementById("projectID").value
      data = "id=" + ID + "&deliver=true"
      $.ajax({
        type: "POST",
        url: "./backend.php",
        data: data,
        success: function(resp) {
          //alert(resp);
          if(resp.indexOf("done")){
            $("#loading").hide();
            $('label#alert').show();
            $('label#alert').removeClass();
            $('label#alert').addClass("label label-success");
            $('label#alert').text("Delivered successfully").hide().fadeIn(2500,function(){
            $('label#alert').hide();
            });
          }else{
            $("#loading").hide();
            $('label#alert').show();
            $('label#alert').removeClass();
            $('label#alert').addClass("label label-warning");
            $('label#alert').text("Error while delivering please redo it after 15 seconds").hide().fadeIn(2500,function(){
            $('label#alert').hide();
            });
          }
        }
    
      });},3000);
      return false;
      
    });

    $("#upload").click(function() {
      ID = document.getElementById("projectID").value;
      if(confirm("Please save before leaving. If you saved press OK"))
        document.location.href="./index.php?page=upload&id=" + ID ;
      return false;
      
    });


  });
