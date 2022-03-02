<?php

if (!function_exists('thisSuccess')) {
    function thisSuccess($msg, $content=null, $code=200) {
        return response()->json([
            'status' => true,
            'content' => $content,
            'message' => $msg
        ], $code);
    }
}

if (!function_exists('thisError')) {
    function thisError($msg, $content=null, $code=400) {
        return response()->json([
            'status' => false,
            'content' => $content,
            'message' => $msg
        ], $code);
    }
}