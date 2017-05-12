<?php defined('SYSPATH') or die('No direct access allowed.');

class Controller_Petroglyph extends Controller_Template {
    public $template = 'petroglyph';
    public function action_index()
    {
        $header = View::factory('header');
        $footer = View::factory('footer');

        $petroglyphs = ORM::factory('Petroglyph')->find_all();

        $this->template->petroglyphs = $petroglyphs;
        $this->template->header = $header;
        $this->template->footer = $footer;
    }
}