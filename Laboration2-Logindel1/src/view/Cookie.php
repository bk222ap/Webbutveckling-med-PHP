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

    public function cookieIsset($key)
    {
        return isset($_COOKIE[$key]);
    }

    public function unsetCookie($key)
    {
        setcookie($key, '', time()-3600);
    }    

    public function loadCookie($key)
    {
        if (isset($_COOKIE[$key]))
        {
            return $_COOKIE[$key];
        }
        else
        {
            return '';
        }
    }
}