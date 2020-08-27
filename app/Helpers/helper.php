<?php

function simpleResponse($msg,$code)
{
    if (is_object($msg) && get_class($msg)=='ErrorException') {
        $str  = $msg->getMessage();
        $str .= "\nScript: " . $msg->getFile();
        $str .= "\nLine: " . $msg->getLine();
        $msg = $str;
    }
    return response($msg, $code);
}

function apiResponseError($msg,$label_res='message')
{
    return response()->json([
        "error"    => 1,
        $label_res => $msg,
    ]);                                
}



function apiResponse($msg, $cookies=null)
{
    $result = [];

    if (!is_array($msg) && is_object($msg)) {
        $result[] = $msg;
        $msg = $result;
    }

    if ($cookies) {
        return response()->json([
                "error"  => 0,
                "data"   => $msg, 
            ])                           
            ->withCookie($cookies[0])
            ->withCookie($cookies[1]);

    } else {        
        return response()->json([
            "error"  => 0,
            "data"   => $msg, 
        ]);                           
    }                         
}
