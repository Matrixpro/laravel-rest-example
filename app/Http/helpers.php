<?php

use Illuminate\Support\Facades\File;

// put_fixture('meta_data.json', $response_from_api_as_array);
if (!function_exists("put_fixture")) {
    function put_fixture($file_name, $content = [], $json = true)
    {
        if ($json) {
            $content = json_encode($content, 128);
        }
        File::put(
            base_path(sprintf("tests/fixtures/%s", $file_name)),
            $content
        );
        return true;
    }
}

// get_fixture('meta_data.json', $response_from_api_as_array)
if (!function_exists("get_fixture")) {
    function get_fixture($file_name)
    {
        $results = File::get(base_path(sprintf(
            "tests/fixtures/%s",
            $file_name
        )));
        return json_decode($results, true);
    }
}