<?php

//article page 


//print_r($result);

$out = '';
$out .= "<div>";
$out .= "<h2>" . $result[0]['title'] . "</h2>";
$out .= "<p>" . $result[0]['description']. "</p>";
$out .= '<img src="/static/images/'.$result[0]['image'].'" width=500>';
$out .= '</div>';
echo $out;