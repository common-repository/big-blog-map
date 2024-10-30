function validateForm()
{





var lat = $('#lat-external').val();
var lon = $('#lon-external').val();
var formattedAddress = $('#address-external').val();

$('#lat-internal').val(lat);
$('#lon-internal').val(lon);
$('#address-internal').val(formattedAddress);


if (lat==20 || lon==20)
  {
  
  alert('Please double click the map on place your blog article is writing about');

  return false;
  }


var x=document.forms["form"]["title"].value;
if (x==null || x=="")
  {

  vTitle = false;
  alert("Something's Missing");
  return false;
  }
  
  else {
  
  var titlePre = $('#title-internal').val();
  
  
  var titlePost = titlePre.replace(/&/g, "&amp;").replace(/>/g, "&gt;").replace(/</g, "&lt;").replace(/"/g, "&quot;").replace(/'/g, "");
  
  $('#title-internal').val(titlePost);
  
  
  
  }
  
  
  
  
  
  
  

  
    var x=document.forms["form"]["url"].value;
if (x==null || x=="")
  {

  vName = false;
   alert("Something's Missing");
  return false;
  }
  

  
   var x=document.forms["form"]["url"].value;

  if (x.search("http:") == -1){



         var x = "http://" + x
          $('#url-internal').val(x);
		  }
		  

  
  
  
      var x=document.forms["form"]["personal"].value;

  if (x!==""){


  if ((x.search("http://") == -1) && (x.search("https://") == -1)){



         var x = "http://" + x
          $('#personal-internal').val(x);
		  }

  }
  
  
  
  
        var x=document.forms["form"]["description"].value;

  if (x!==""){

    var descriptionPre = $('#description-internal').val();
  
  
  var descriptionPost = descriptionPre.replace(/&/g, "&amp;").replace(/>/g, "&gt;").replace(/</g, "&lt;").replace(/"/g, "&quot;").replace(/'/g, "");
  
  $('#description-internal').val(descriptionPost);
  
  
  }
  
  
  var x = $('#category-external').val();
  
  $('#category-internal').val(x);
  

  
  
  }