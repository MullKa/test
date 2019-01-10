<?php

namespace app\controllers;


class HomeController extends App
{
    public function index_action()
    {
        $page_name = "home";
        $this->set(compact('page_name'));
    }
}