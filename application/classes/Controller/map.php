<?php defined('SYSPATH') or die('No direct access allowed.');

class Controller_Map extends Controller_Template {
    public $template = 'map';
    public function action_index()
    {
        $logged_in = Auth::instance()->logged_in();
        if (!$logged_in) HTTP::redirect('welcome');

        $header = View::factory('header');
        $footer = View::factory('footer');
        $this->template->header = $header;
        $this->template->footer = $footer;
        $header->logged_in = $logged_in;
        $header->menu = 'map';
        $header->username = Auth::instance()->get_user();

        $petroglyphs = ORM::factory('Petroglyph')->find_all();
        $this->template->petroglyphs = $petroglyphs;


    }
}