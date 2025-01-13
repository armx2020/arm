<?php

namespace App\Services;

class ParseUrlService
{
    public static function parse_url_if_valid($url)
    {
        $arUrl = parse_url($url);

        $ret = null;

        if (!array_key_exists("scheme", $arUrl) || !in_array($arUrl["scheme"], array("http", "https"))) {
            $arUrl["scheme"] = "https";
        }


        if (array_key_exists("host", $arUrl) && !empty($arUrl["host"])) {
            $ret = sprintf(
                "%s://%s%s",
                $arUrl["scheme"],
                $arUrl["host"],
                $arUrl["path"]
            );
        } else if (preg_match("/^\w+\.[\w\.]+(\/.*)?$/", $arUrl["path"])) {
            $ret = sprintf("%s://%s", $arUrl["scheme"], $arUrl["path"]);
        }

        return $ret;
    }
}
