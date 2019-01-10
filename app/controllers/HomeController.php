<?php

namespace app\controllers;


use app\models\Home;

class HomeController extends AppBase
{
    public function index_action()
    {
        $page_name = "home";
        $this->set(compact('page_name'));
    }
}