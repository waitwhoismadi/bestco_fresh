<?php

if (! function_exists('get_file')) {
    function get_file($link)
    {
        return url('storage/app/store/'.$link);

    }
}
