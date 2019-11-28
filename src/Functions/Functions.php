<?php

    namespace App\Functions;

    class Functions {

    public static function getSeitenGesamt($gesamt, $entries){
        return ceil($gesamt / $entries);
    }

    public static function getOffset($page){
        return ($page - 1) * 15;
    }

    public static function getArticleName($name){
        return strtolower(htmlentities (preg_replace('/\s+/', '_', $name)));
    }

    public static function getArticleTitleName($name){
        return ucwords(preg_replace('/[_]+/', ' ', $name));
    }

    public static function isMobile($userAgent) {
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $userAgent);
    }

}


