<?php
class Perpage {
    private $items;
    private $quantity_of_items;
    private $quantity_of_pages;
    private $per_page;
    private $pages;

    public function __construct($items, $quantity_of_items, $quantity_of_pages, $per_page) {
        $this->items = $items;
        $this->quantity_of_items = $quantity_of_items;
        $this->quantity_of_pages = $quantity_of_pages;
        $this->per_page = $per_page;
    }

    public function items(){
        return $this->items;
    }

    function pagination() {
        $this->pages = ceil($this->quantity_of_items / $this->quantity_of_pages);
        if(isset($_POST["page"])){
            $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
            if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
        }else{
            $page_number = 1; //if there's no page number, set it to 1
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
}
?>