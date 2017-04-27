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

// попередня сторінка
        $this->prevlink = '<a href="?start=' . $prev . '&length=' . $this->length . '">&laquo; </a>';
if ($prev < 0 && (int) $this->start > 0)
{
    $this->prevlink = '<a href="?start=0&length=' . $this->length . '">&laquo; </a>';
}
else if ($prev < 0)
{
    $this->prevlink = '&laquo; ';
}

        $this->begin = (int) $this->start + 1;
        $this->end = ($next > $this->max) ? $this->max : $next;

 }
}

