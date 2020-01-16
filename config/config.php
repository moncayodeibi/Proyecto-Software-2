<?php
// Conectando, seleccionando la base de datos

date_default_timezone_set('America/Guayaquil');

$dbhost = 'localhost';
$dbname= 'escollan_software2';
$dbuser = 'escollan';
$dbpass = 'diente$deleon109H';

$db = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);


try {
	$jarvis = new db("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
	}
	catch (PDOException $e){
	echo __LINE__ . " Error!: " . $e->getMessage() . "<br/>";

		try {
			$jarvis = new db("mysql:host='localhost';dbname=$dbname", $dbuser, $dbpass);
			}
		catch (PDOException $e){
			echo __LINE__ . " Error!: " . $e->getMessage() . "<br/>"; die();
			}
	}

class db extends PDO {
  public function last_row_count() {
    return $this->query("SELECT FOUND_ROWS()")->fetchColumn();
  }
}

function run_in_background($path,$log='>>')
{
	if (substr(php_uname(), 0, 7) == "Windows")
	{
		 pclose(popen('start /B php.exe '.$path.' >> '.$log, "r"));
	}
	else {
		 exec($path.' 2>nul >nul');
	}
}
function FETCH_SQL($sql,$show_exception=1)
{

	global $jarvis;
	try
	{
		$jarvis->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$sqlit = $jarvis->prepare($sql);
		$sqlit->execute();
	}
	catch(PDOException $exception)
	{
		if($show_exception)flush_it(" <hr>exception: ".$exception->getMessage() . "<br>sql is $sql<hr>",1);

	}

	return $sqlit;

}
function FETCH_OBJ($sql)
{
	$sth = FETCH_SQL($sql);
	$result = $sth->fetch(PDO::FETCH_OBJ);
	return $result;
}
function FETCH_VAR($sql)
{
	$sth = FETCH_SQL($sql);
	$result = $sth->fetch(PDO::FETCH_NUM);

	return $result[0];
}
function FETCH_ARRAY($sql)
{
	$sth = FETCH_SQL($sql);
	while($result = $sth->fetch(PDO::FETCH_NUM))
	{
		$results[]=$result[0];
	}

	return $results;}

?>
