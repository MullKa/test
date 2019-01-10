<?php

namespace vendor\base;


use vendor\exceptions\ViewException;

class View
{

    public $route = [];
    public $view;
    public $layout;
    public $scripts = [];
    public $styles = [];

    const VIEW_ERROR = "View not found.";
    const LAYOUT_ERROR = "Layout not found.";

    public function __construct($route, $layout = '', $view = '')
    {
        $this->route = $route;
        if($layout === false)
            $this->layout = false;
        else
            $this->layout = $layout ?: LAYOUT;
        $this->view = $view;
    }

    public function render($vars)
    {
        try{
            extract($vars);
            $file_view = APP ."\\views\\" . $this->route['controller'] . "\\" . $this->view . ".php";
            ob_start();
            if(!is_file($file_view))
                throw new ViewException(self::VIEW_ERROR);
            require_once $file_view;
            $content = ob_get_clean();
            if(false !== $this->layout)
            {
                $file_layout = APP . "\\views\\layouts\\" . $this->layout . ".php";
                if(!is_file($file_layout))
                    throw new ViewException(self::LAYOUT_ERROR);
                $content = $this->getScripts($content);
                $scripts = [];
                if(!empty($this->scripts[0]))
                    $scripts = $this->scripts[0];
                $content = $this->getStyles($content);
                $styles = [];
                if(!empty($this->styles[0]))
                    $styles = $this->styles[0];
                require_once $file_layout;
            }

        }catch (ViewException $ve){
            echo $ve->getMessage();
            exit();
        }
    }

    protected function getScripts($content)
    {
        $pattern = "#<script.*?>.*?</script>#si";
        preg_match_all($pattern, $content, $this->scripts);
        if(!empty($this->scripts))
            $content = preg_replace($pattern, '', $content);
        return $content;
    }

    protected function getStyles($content)
    {
        $pattern = "#<link.*?>#si";
        preg_match_all($pattern, $content, $this->styles);
        if(!empty($this->styles))
            $content = preg_replace($pattern, '', $content);
        return $content;
    }

}