<?php
define('DB_PATH', $_SERVER['DOCUMENT_ROOT'] . '/database/database.db');
$db = new PDO('sqlite:' . DB_PATH);