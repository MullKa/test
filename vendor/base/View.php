<?php

namespace vendor\base;


use vendor\exceptions\ViewException;

class View
{

    public $route = [];
    public $view;
    public $layout;

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
                require_once $file_layout;
            }

        }catch (ViewException $ve){
            echo $ve->getMessage();
            exit();
        }
    }

}