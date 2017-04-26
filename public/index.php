<?php
require_once '../vendor/autoload.php';
require_once '../db/dbconnect.php';
require_once '../pagination/pagination.php';

$result = $db->prepare("SELECT * FROM news");
$result->execute();

$per_page = (isset($_GET['page']) && !empty($_GET['page'])) ? $_GET['page'] : 0; // Where do we start?
$quantity_of_pages = (isset($_GET['quantity_of_pages']) && !empty($_GET['quantity_of_pages'])) ? $_GET['quantity_of_pages'] : 5; // How many per page?
$position = (($per_page-1) * $quantity_of_items);
//$stm = $db->prepare("SELECT * FROM news ORDER BY id DESC LIMIT $position, $quantity_of_items");
//$stm->execute();
/*foreach($feed->get_items($position, $quantity_of_pages) as $item) {
    $feed = $item->get_feed();
}*/
$pagination = new Perpage($feed->get_item_quantity(), $quantity_of_pages, $per_page);
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" charset="utf-8" />
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
    <title>RSS-reader</title>

</head>
<body>
<script src="js/jquery-3.2.0.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<div class="container">
    <div  class = "col-md-12">
    <div class="result">
      <?php  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo '<div = class="box"><p><h4><a href="'.$row["link"].'">'.$row["title"].'</a></h4></p><p>'.$row["description"] . '</p><p>' . $row["pub_date"] . '</p><p>' . $row["source"] . '</p></div>';
        }
        ?>
    </div>
        <div id="pagination-result">
            <?=$pagination->pagination()?>
        </div>
    </div>
</div>
    </body>
    </html>
