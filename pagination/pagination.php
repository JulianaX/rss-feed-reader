<?php
class Pagination {
    public $nextlink;
    public $prevlink;
    public $start;
    public $length;
    public $begin;
    public $end;
    public $max;


    function __construct( $start, $length, $max) {
       // $this->nextlink = $nextlink;
        //$this->prevlink = $prevlink;
        $this->start = $start;
        $this->length = $length;
        $this->max = $max;
    }

    function perpage() {
$next = (int) $this->start + (int) $this->length;
$prev = (int) $this->start - (int) $this->length;

// наступна сторінка
        $this->nextlink = '<a href="?start=' . $next . '&length=' . $this->length . '"> &raquo;</a>';
if ($next > $this->max)
{
    $this->nextlink = 'Next &raquo;';
}

// Create the PREVIOUS link
        $this->prevlink = '<a href="?start=' . $prev . '&length=' . $this->length . '">&laquo; </a>';
if ($prev < 0 && (int) $this->start > 0)
{
    $this->prevlink = '<a href="?start=0&length=' . $this->length . '">&laquo; </a>';
}
else if ($prev < 0)
{
    $this->prevlink = '&laquo; ';
}

// Normalize the numbering for humans
        $this->begin = (int) $this->start + 1;
        $this->end = ($next > $this->max) ? $this->max : $next;

 }
}
/*class T {
    private $quantity_of_items;
    private $quantity_of_pages;
    private $per_page;
    private $pages;

    public function __construct($quantity_of_items, $quantity_of_pages, $per_page) {
        $this->quantity_of_items = $quantity_of_items;
        $this->quantity_of_pages = $quantity_of_pages;
        $this->per_page = $per_page;
    }

    function pagination() {
        $this->pages = ceil($this->quantity_of_items / $this->quantity_of_pages);
        if(isset($_POST["page"])){
            $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
            if(!is_numeric($page_number)){die('Invalid page number!');}
        }else{
            $page_number = 1;
        }
        if ($this->per_page > 1){
            $page_number = $this->per_page - 1;
        }
        $start = '<a href="?page=' . ($page_number) .'">&laquo;</a>';
        for ($i = 1; $i <= $this->pages; $i++) {
            if ($i == $this->per_page){
                $start .= '<a href="#" class = "paging">' . $i . '</a>';
            }else{
                $start .= '<a href="?page=' . $i . '">' . $i . '</a>';
            }
        }
        $end = $this->pages;
        if ($this->per_page < $this->pages){
            $end = $this->per_page + 1;
        }
        $start .= '<a href="?page=' . $end . '">&raquo;</a>';
        return $start;
    }
}*/
