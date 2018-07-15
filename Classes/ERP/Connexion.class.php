<?php
namespace shoudusse\ERP;
use \PDO;
class Connexion {
	public static function connect() {
	try {
		$DB = new \PDO('mysql:host=localhost;dbname=shoudusse_ERP;charset=utf8', 'root', '');
		$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(Exception $e) {
			die($e->getMessage());
		}
		return $DB;
	}
}









?>