<?php

if (!function_exists('getYoutubeVideoId')) {
    function getYoutubeVideoId($url)
    {
        parse_str(parse_url($url, PHP_URL_QUERY)['query'] ?? '', $query);
        return $query['v'] ?? null;
    }
}
