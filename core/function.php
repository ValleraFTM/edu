<?php
function explodeURL($url) {
    return explode("/", $url);
}

function getArticle($url) {
    $query = "SELECT * FROM info WHERE URL='".$url."'";
    return select($query);
}
function getCat($url) {
    $query = "SELECT * FROM category WHERE URL='".$url."'";
    return select($query);
}

function getCatArticle($cid) {
    $query = "SELECT * FROM info WHERE cid='".$cid."';";
    return select($query);
}

function isLoginExist($login) {
    $query = "SELECT id FROM users WHERE login='".$login."'";
    $result = select($query);
    if (count($result) === 0) return false;
    return true;
}
function createUser($login, $password) {
    $password = md5(md5(trim($password)));
    $login = trim($login);
    $query = "INSERT INTO `users`(`login`, `password`) VALUES ('".$login."', '".$password."');";
    return execQuery($query);
}
function login($login, $password) {
    $password = md5(md5(trim($password)));
    $login = trim($login);
    $query = "SELECT `id`, `login` FROM `users` WHERE `login`='".$login."' AND `password`='".$password."';";
    $result = select($query);
    if (count($result) > 0) return $result;
    return false;
}   
function generateCode($length = 7) {
    $chars = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890";
    $code = "";
    $clen = strlen($chars) - 1;
    while (strlen($code) < $length) {
        $code .= $chars[(mt_rand(0, $clen))];
    }
    return $code;
}
function updateUser($id, $hash, $ip) {
    if(is_null($ip)) {
        $query = "UPDATE `users` SET `hash`='".$hash."' WHERE `id`=".$id.";";
    }else {
        $query = "UPDATE `users` SET `hash`='".$hash."', `ip`=INET_ATON('".$ip."') WHERE `id`=".$id.";";
    }
    return execQuery($query);
}

function getUser() {
    var_dump($_COOKIE);
    if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])) {
        $query = "SELECT id, login, hash, INET_NTOA(ip) as ip FROM `users` WHERE id=".intval($_COOKIE['id'])."LIMIT 1";
        $user = select($query);
        if(count($user) === 0) {
            return false;
        }
        else {
            $user = $user[0];
            if ($user['hash'] !== $_COOKIE['hash']) {
                clearCookies();
                return false;
            }
            if (!is_null($user['ip'])) {
                if ($user['ip'] !== $_SERVER['REMOTE_ADDR']) {
                    clearCookies();;
                    return false;
                }
            }
            $_GET['login'] = $user['login'];
            return true;
        }
    }
    else {
        clearCookies();
        return false;
    }
}
function clearCookies() {
    setcookie('id', "", time()-60*60*24*30, "/");
    setcookie('hash', "", time()-60*60*24*30, "/", null, null, true);
    unset($_GET['login']);
}
?>