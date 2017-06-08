/*
fonctionne exactement comme le chargement de la galerie
*/

function loadComments(ajaxResponse)
{
  console.log(ajaxResponse);
  var data = JSON.parse(ajaxResponse);
  var comments_zone = document.getElementById("posted_comments");
  comments_zone.innerHTML = "";

  for (var i = 0; i < data.length; i++)
  {
    var comment_content = "<div class='breadcrumb'><span>";
    comment_content += data[i]['TEXTE'];
    comment_content += "</span></div>";
    comments_zone.innerHTML += comment_content;
  }
}

function addComm(){

  var comm = document.getElementById('comm').value;
  document.getElementById('comm').value='';
  if (comm!='') {
    console.log(comm);
  }
  ajaxRequest("PUT", "php/request.php/comments/1", loadComments, "comm="+comm);
}
