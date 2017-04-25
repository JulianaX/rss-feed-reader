<?php
require_once '../vendor/autoload.php';
require_once '../db/dbconnect.php';

$sql = "INSERT IGNORE INTO news (title, link, description, source, pub_date) VALUES ( ?, ?, ?, ?, ?)";

$stmt = $db->prepare($sql);

$feed = new SimplePie();//створення і налашт об'єкта SimplePie
$feed->enable_cache(false);//відключення кешування

$feed->set_feed_url('http://tsn.ua/rss/');//шлях до rss-каналу array('http://tsn.ua/rss/','https://rss.unian.net/site/news_ukr.rss')
$success = $feed->init();//обробка параметрів конфігураціїї

//сторінка обслуговується з правильними заголовками
$feed->handle_content_type();
$items = $feed->get_items();//повертає масив новин

foreach ($items as $item) {
    $stmt->execute([         //запуск підготовленого запиту на виконання
        $item->get_title(),   //повертає заголовок новини
        $item->get_permalink(),     //повертає посилання на новину
        $item->get_description(),   //опис новини
        $feed->get_link(),         //ссилка на головний сайт
        $item->get_date("Y-m-d H:i:s"), //дата
    ]);
};
?>
