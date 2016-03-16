<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
mb_internal_encoding("UTF-8");

session_start();

try {
	$db = new PDO('mysql:host=localhost;dbname=wc_invoices;charset=utf8', 'root', 'root');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->exec("SET NAMES utf8mb4");
} catch (PDOException $e) {
	$error_message = $e->getMessage();
	die("An error occured. ERR: ".$error_message);
}

$db_settings = $db->prepare("SELECT * FROM `settings`");
$db_settings->execute();
$db_settings = $db_settings->fetchAll(PDO::FETCH_ASSOC);

foreach ($db_settings as $setting => $value) {
	$db_settings[$value['setting_name']] = $value['setting_value'];
	unset($db_settings[$value['id']-1]);
}


define('BASE_PATH', $db_settings['base_path']);
define('BASE_URL', $db_settings['base_url']);

define('TEMPLATES_URL', BASE_URL.'templates/');
define('STATIC_URL', BASE_URL.'static/');

$global['project_name'] = 'ULVEMOSENSHANDELSSELSKAB / Administrationsside';

// $STH = $DB->prepare("SELECT * FROM users WHERE user = :s");
// $STH->execute(array(25));
// $User = $STH->fetch();

// $sth = $dbh->prepare('SELECT name, colour, calories FROM fruit WHERE calories < :calories AND colour = :colour');
// $sth->bindParam(':calories', $calories);
// $sth->bindParam(':colour', $colour);
// $sth->execute();

//$results = $sth->fetchAll(PDO::FETCH_ASSOC);

function pred($arr){
	echo '<pre>';
	var_dump($arr);
	echo '</pre>';
}