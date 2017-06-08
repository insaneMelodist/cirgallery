<?php
require_once ('database.php');

	$db = dbConnect();
	if(!$db)
	{
	  header ('HTTP/1.1 503 Service unavailable');
	  exit;
	}

  $request = substr($_SERVER['PATH_INFO'], 1);
  //si la requete concerne un module
  if (is_dir('../'.$request))
  {
    // on extrait le nom du module
		$moduleName = substr($request, strrpos($request, '/') + 1);
    //si le module est 'gallery'
    if ($moduleName == 'gallery')
    {
      sendHtmlAndJsData('gallery', $request, $moduleName);
    }
		//si c'est bien 'big-picture' on le charge
		if ($moduleName == 'big-picture')
		{
			sendHtmlAndJsData('big-picture', $request, $moduleName);
		}
    if ($moduleName == 'comments')
    {
      sendHtmlAndJsData('comments', $request, $moduleName);
    }
  }
  else
	{
		$request = explode('/', $request);
		$requestType = $_SERVER['REQUEST_METHOD'];

    if ($request[0] == 'gallery')
		{
			$data = dbRequestPics($db);
		}

		if ($request[0] == 'big-picture')
		{
			$id = $request[1];
			$data = dbRequestPicture($db, $id);
		}

		if ($request[0] == 'comments')
		{
			if($requestType=='GET'){
				$id = $request[1];
				$data = dbRequestComms($db, $id);
			}
			if($requestType=='PUT'){
				$id = $request[1];
				dbInsertComms($db, $id, $_GET['comm']);
			}
		}

		if ($data != NULL)
		{
			sendJsonData($data);
		}

		header ('HTTP/1.1 400 Bad Request');
		exit;
	}

	//----------------------------------------------------------------------------
	//--- debug_to_console -------------------------------------------------------
	//----------------------------------------------------------------------------
	function debug_to_console($donnee)
	{
    $output = $donnee;
    if ( is_array( $output ) )
		{
        $output = implode( ',', $output);
		}

    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
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

	//----------------------------------------------------------------------------
	//--- dbRequestPics ----------------------------------------------------------
	//----------------------------------------------------------------------------
	function dbRequestPics($db)
	{
  	try
  	{
    	$request = "select * from PHOTO";
    	$statement = $db->prepare($request);

    	$statement->execute();
    	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
  	}
  	catch (PDOException $exception)
  	{
    	return false;
  	}
  	return $result;
	}

	//----------------------------------------------------------------------------
	//--- dbRequestPicture -------------------------------------------------------
	//----------------------------------------------------------------------------
	function dbRequestPicture($db, $id)
	{
  	try
  	{
    	$request = "select * from PHOTO where ID_PHOTO=".$id;
    	$statement = $db->prepare($request);

    	$statement->execute();
    	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
  	}
  	catch (PDOException $exception)
  	{
    	return false;
  	}
  	return $result;
	}

	//----------------------------------------------------------------------------
	//--- dbRequestComms ---------------------------------------------------------
	//----------------------------------------------------------------------------
	function dbRequestComms($db, $id)
	{
		try
  	{
    	$request = "select * from COMMENTAIRE where ID_PHOTO=".$id;
    	$statement = $db->prepare($request);

    	$statement->execute();
    	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
  	}
  	catch (PDOException $exception)
  	{
    	return false;
  	}
  	return $result;
	}

        function dbInsertComms($db, $id, $comm)
	{
		try
  	{
    	$request = "insert into COMMENTAIRE (ID_PHOTO, TEXTE) values(:id,:comm)";
    	$statement = $db->prepare($request);
    	$statement->bindParam(":id",$id,PDO::PARAM_INT);
    	$statement->bindParam(":text",$comm,PDO::PARAM_INT);

    	$statement->execute();
    	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
  	}
  	catch (PDOException $exception)
  	{
    	return false;
  	}
  	return $result;
	}

 ?>
