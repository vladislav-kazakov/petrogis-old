<?php defined('SYSPATH') OR die('No Direct Script Access');
 
class Controller_Welcome extends Controller_Template
{
    public $template = 'site';
 
    public function action_index()
    {
        $logged_in = Auth::instance()->logged_in();
        $header = View::factory('header');
        $footer = View::factory('footer');
        $this->template->header = $header;
        $this->template->footer = $footer;
        $header->logged_in = $logged_in;
        $header->username = Auth::instance()->get_user();
        $header->menu = 'home';

        $this->template->message = 'hello, world!';
    }
}