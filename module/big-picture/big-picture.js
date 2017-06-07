ajaxRequest('GET', 'php/request.php/module/comments', loadHtmlAndJs);
/*on a deja preload le htmlandjs dans loading!!
il ne nous reste qu'à faire la requete avec la donnée*/


/*function loadTestResponse(ajaxResponse)
{
  var data;
  console.log(ajaxResponse);

  data = JSON.parse(ajaxResponse);

  console.log(data);
}*/

function loadBigPicture(ajaxResponse)
{
  console.log(ajaxResponse);
  var data = JSON.parse(ajaxResponse);
  var title = document.getElementById("bp_title");
  var divimg = document.getElementById("bp_divimg");
  title.innerHTML = '';
  divimg.innerHTML = '';

  var bp_img = "<img src='" + data[0]['ADRESSE'] + "' alt='" + data[0]['TITRE'] + "' width='80%'></img>";

  title.innerHTML = data[0]['TITRE'];
  divimg.innerHTML = bp_img;
  ajaxRequest('GET', 'php/request.php/comments/' + data[0]["ID_PHOTO"], loadComments);
}
