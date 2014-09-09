<?php

class Cookie
{
    public function saveCookie($key, $value, $expire = -1)
    {
        setcookie($key, $value, $expire);
    }
    
    public function loadOnceCookie($key)
    {
        if (isset($_COOKIE[$key]))
        {
            $content = $_COOKIE[$key];
            setcookie($key, '', time()-3600);
            return $content;
        }
        else
        {
            return '';
        }
    }
}
