<?php

require_once "core/function_db.php";
// main page templated from

echo "<pre>";
$query = "SELECT * FROM info";
$result = select($query);
//print_r ($result);

for ($i = 0; $i < count($result); $i++) {
    $out = '';
    $out .= "<div>";
    $out .= "<h4>" . $result[$i]['title'] . "</h4>";
    $out .= "<p>" . $result[$i]['descr_min']. "</p>";
    $out .= '<img src="/static/images/'.$result[$i]['image'].'" width=200>';
    $out .= '<div><a href="/article/'.$result[$i]['URL'].'">читать полностью</a></div>';
    $out .= '</div>';
    echo $out;
}
echo "</pre>";