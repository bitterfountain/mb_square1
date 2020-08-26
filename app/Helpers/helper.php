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

