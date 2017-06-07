<?php
require_once ('constants.php');

function dbConnect()
{
  try
  {
    $db = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASSWORD);
  }
  catch(PDOException $exception)
  {
    return false;
  }
  return $db;
}



?>
