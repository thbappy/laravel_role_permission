<?php
if (!function_exists('database_formatted_date')) {
    function database_formatted_date($value = null) {

        $date = date('Y-m-d', strtotime($value));

        return $date;
    }
}
