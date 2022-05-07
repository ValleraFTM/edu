<?php
/** login page template */


if (!getUser()) {
    header("location: /admin");
}
echo "<h1>Admin panel </h1>";


for ($i = 0; $i < count($result); $i++) {
    $out = '';
    $out .= "<div>";
    $out .= "<p>" . $result[$i]['title'] . "</p>";
    $out .= '<img src="/static/images/'.$result[$i]['image'].'" width=50>';
    $out .= '<a href="/admin/delete'.$result[$i]['id'].'" onclick="return confirm(\'точно??\')">удалить</a>';
    $out .= '</div>';
    echo $out;
}
?>