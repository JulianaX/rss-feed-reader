<?php
require_once '../vendor/autoload.php';
require_once '../db/dbconnect.php';
require_once '../pagination/pagination.php';
require_once '../resource/rss.php';
$perPage = new PerPage();

$result = "SELECT * FROM news";
$paginationlink = "resource/getresult.php ?page=";

$page = 1;
if(!empty($_GET["page"])) {
    $page = $_GET["page"];
}
$start = ($page-1)*$perPage->perpage;
if($start < 0) $start = 0;

$query =  $result . " limit " . $start . "," . $perPage->perpage;
$faq = $db->prepare($query);
$faq2 = $faq->execute();

while($row = $faq2->fetchAll(PDO::FETCH_ASSOC)) {
    $resultset[] = $row;
}
if(!empty($resultset))
    return $resultset;

$faq3 = $db->prepare($result);
$faq4 = $faq3->execute();
if(empty($_GET["rowcount"])) {
    $_GET["rowcount"] = $faq4->rowCount();
}
$perpageresult = $perPage->perpage($_GET["rowcount"], $paginationlink);

$output = '';
foreach($row as $k=>$v) {
    $output .= '<div class="question"><input type="hidden" id="rowcount" name="rowcount" value="' . $_GET["rowcount"] . '" />' . $resultset[$k]["question"] . '</div>';
    $output .= '<div class="answer">' . $resultset[$k]["answer"] . '</div>';
}
if(!empty($perpageresult)) {
    $output .= '<div id="pagelink">' . $perpageresult . '</div>';
}
print $output;

//$per_page = (isset($_GET['page']) && !empty($_GET['page'])) ? $_GET['page'] : 1; // Where do we start?
//$quantity_of_pages = (isset($_GET['quantity_of_pages']) && !empty($_GET['quantity_of_pages'])) ? $_GET['quantity_of_pages'] : 5; // How many per page?
//$position = (($per_page-1) * $quantity_of_pages);
//$stm = $db->prepare("SELECT * FROM news ORDER BY id DESC LIMIT $position, $quantity_of_items");
//$stm->execute();
/*foreach($feed->get_items($position, $quantity_of_pages) as $item) {
$feed = $item->get_feed();
}*/
//$number_feeds = $feed->get_item_quantity();
