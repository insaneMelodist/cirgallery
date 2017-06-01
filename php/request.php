<?php
  $request = substr($_SERVER['PATH_INFO'], 1);
  //si la requete concerne un module (à savoir 'big-picture')
  if (is_dir('../'.$request))
  {
    // on extrait le nom du module
		$moduleName = substr($request, strrpos($request, '/') + 1);
    if ($moduleName == 'gallery')
    {
      sendHtmlAndJsData('gallery', $request, $moduleName);
    }
		//si c'est bien 'big-picture' on le charge
		if ($moduleName == 'big-picture')
		{
			sendHtmlAndJsData('big-picture', $request, $moduleName);
		}

  }
  else
	{
		$request = explode('/', $request);
		$requestType = $_SERVER['REQUEST_METHOD'];

			if ($data != NULL)
				sendJsonData($data);

		header ('HTTP/1.1 400 Bad Request');
		exit;
	}

  //----------------------------------------------------------------------------
	//--- sendHtmlAndJsData ------------------------------------------------------
	//----------------------------------------------------------------------------
  function sendHtmlAndJsData($divId, $modulePath, $moduleName)
	{
	  // Création des données à envoyer
	  $data = array ('html' => $modulePath.'/'.$moduleName.'.html',	'divId' => $divId, 'js' => $modulePath.'/'.$moduleName.'.js');
		sendJsonData($data);
	}

  //----------------------------------------------------------------------------
	//--- sendJsonData -----------------------------------------------------------
	//----------------------------------------------------------------------------
  function sendJsonData($data, $code = 200)
	{
	  // Envoi des données
	  header('Content-Type: text/plain; charset=utf-8');
	  header('Cache-control: no-store, no-cache, must-revalidate');
	  header('Pragma: no-cache');
		if ($code == 201)
      header('HTTP/1.1 201 Created');
		else
      header('HTTP/1.1 200 OK');
	  echo json_encode($data);
		exit;
	}

 ?>
