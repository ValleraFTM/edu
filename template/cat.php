<?php

// category page templete


$out = '';
$out .= "<div>";
$out .= "<h2>Категория " . $cat[0]['title'] . "</h2>";
$out .= "<p>" . $cat[0]['description']. "</p>";
$out .= '</div>';
echo $out;
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