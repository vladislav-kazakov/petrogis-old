<?php defined('SYSPATH') OR die('No Direct Script Access');
 
class Controller_Welcome extends Controller_Template
{
    public $template = 'site';
 
    public function action_index()
    {
        $this->template->message = 'hello, world!';
    }
}