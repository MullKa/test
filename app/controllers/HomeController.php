<?php

namespace app\controllers;


use app\models\Home;

class HomeController extends App
{
    public function index_action()
    {
        $home = new Home();
        $res = $home->query("SELECT * FROM user");
        var_dump($res);
        $page_name = "home";
        $this->set(compact('page_name'));
    }
}