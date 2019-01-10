<?php

namespace vendor\core;


use vendor\exceptions\RouterException;

class Router
{

    protected static $routes = [];
    protected static $route = [];

    const MESSAGE_404 = "Page not found";

    public static function add($regex, $route = [])
    {
        self::$routes[$regex] = $route;
    }

    public static function run($url)
    {
        self::dispatch($url);
    }

    protected static function matchRoute($url)
    {
        foreach (self::$routes as $pattern => $route)
        {
            if(preg_match("#$pattern#i", $url, $matches))
            {
                foreach ($matches as $k => $v)
                {
                    if(is_string($k))
                        $route[$k] = $v;
                }
                if(!isset($route['action']))
                    $route['action'] = "index";
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    protected static function dispatch($url)
    {
        $url = self::removeQueryString($url);
        try{
            if(!self::matchRoute($url))
                throw new RouterException(self::MESSAGE_404 . "<br>matchFalse", 404);
            $controller = "app\\controllers\\" . self::upperCase(self::$route['controller']) . "Controller";
            if(!class_exists($controller))
                throw new RouterException(self::MESSAGE_404 . "<br>contr", 100);
            $cObj = new $controller(self::$route);
            $action = self::lowerCase(self::$route['action']) . "_action";
            if(!method_exists($cObj, $action))
                throw new RouterException(self::MESSAGE_404 . "<br>act", 200);
            $cObj->$action();
            $cObj->getView();
        }catch (RouterException $re){
            self::requireErrorPage($re->getMessage(), $re->getCode());
            exit();
        }
    }

    protected static function removeQueryString($url)
    {
        if($url)
        {
            $params = explode('&', $url, 2);
            if(false === strpos($params[0], "="))
                return trim($params[0], '/');
            return '';
        }
    }

    protected static function upperCase($str)
    {
        return str_replace(["-", "_", " "], "", ucwords($str));
    }

    protected static function lowerCase($str)
    {
        return lcfirst(self::upperCase($str));
    }

    protected static function requireErrorPage($message, $code)
    {
        require_once "404.html";    //temp
        echo "$message";
    }

}