console.log("Je suis gallery.js !");

ajaxRequest("GET", "php/request.php/gallery", loadGallery);




function loadGallery(ajaxResponse)
{
  console.log(ajaxResponse);
  var data = JSON.parse(ajaxResponse);
  var gallery_zone = document.getElementById("gallery_rows");
  gallery_zone.innerHTML = "";

  for (var i = 0; i < data.length; i++)
  {
    var aR = 'ajaxRequest("GET", "php/request.php/big-picture/' + data[i]["ID_PHOTO"] + '", loadBigPicture)';
    var gallery_content = "<div class='col-xs-6 col-md-4'><a class='thumbnail' onclick='" + aR + "'>";
    gallery_content += "<img src='"+ data[i]['ADRESSE'] + "' alt='" + data[i]['TITRE'] + "' width='60%'></img>";
    gallery_content += "</a></div>";
    gallery_zone.innerHTML += gallery_content;
  }
}
