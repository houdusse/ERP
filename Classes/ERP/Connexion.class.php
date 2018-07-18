<?php
namespace shoudusse\ERP;
use \PDO;
class Connexion {
	private static $DB;
	public static function connect() {
	try {
		self::$DB = new \PDO('mysql:host=localhost;dbname=shoudusse_ERP;charset=utf8', 'root', '');
		self::$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(Exception $e) {
			die($e->getMessage());
		}
	}

	public static function getDB() {
		return self::$DB;
	}
}









?>