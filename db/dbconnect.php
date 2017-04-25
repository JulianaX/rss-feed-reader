<?php
require_once '../vendor/autoload.php';
require_once '../rss/rss.php';

$db = new PDO("mysql:host=localhost; dbname=data_news; charset=utf8", "root", "123");
