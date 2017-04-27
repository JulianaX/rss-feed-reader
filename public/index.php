<?php
require_once '../vendor/autoload.php';
require_once '../db/dbconnect.php';
require_once '../pagination/pagination.php';
require_once '../resource/rss.php';
//while ($row = $result->fetchAll())
//echo '<div = class="box"><p><h4><a href="'.$row["link"].'">'.$row["title"].'</a></h4></p><p>'.$row["description"] . '</p><p>' . $row["pub_date"] . '</p><p>' . $row["source"] . '</p></div>';

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
<div class="container">
   <div  class = "col-md-12">
       <?php
       // якщо є помилки
       if ($feed->error())
       {
           echo '<div class="sp_errors">' . "\r\n";
           echo '<p>' . htmlspecialchars($feed->error()) . "</p>\r\n";
           echo '</div>' . "\r\n";
       }
       ?>
       <div class="pagination">
           <?php foreach($feed->get_items($start, $finish) as $item): {
           echo '<div = class="box"><p><h4><a href="'.$item->get_permalink().'">'.$item->get_title().'</a></h4></p><p>'.$item->get_description(). '</p><p>' . $item->get_date("Y-m-d H:i:s") . '</p><p>' . $feed->get_link() . '</p></div>';
       }
       endforeach;?>
           <p><?php echo $pagination->begin; ?>&ndash;<?php echo $pagination->end; ?> of <?php echo $pagination->max; ?> feeds | <?php echo $pagination->prevlink; ?> | <?php echo $pagination->nextlink; ?> | <a href="<?php echo '?start=' . $pagination->start . '&length=3'; ?>">3</a>, <a href="<?php echo '?start=' . $pagination->start . '&length=10'; ?>">10</a>, or <a href="<?php echo '?start=' . $pagination->start . '&length=20'; ?>">20</a></p>
       </div>
   </div>
</div>
</body>
</html>