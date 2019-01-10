<?php

namespace app\controllers;


class ProfileController extends App
{
    public function index_action()
    {
        $page_name = "profile";
        $profile_id = (isset($this->route['id'])) ? $this->route['id'] : "self" ;
        $this->set(compact('page_name', 'profile_id'));
    }

    public function edit_action()
    {
        $page_name = "profile|edit";
        $profile_id = (isset($this->route['id'])) ? $this->route['id'] : "none" ;
        $this->set(compact('page_name', 'profile_id'));
    }
}