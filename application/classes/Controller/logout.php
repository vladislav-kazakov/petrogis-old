<?php defined('SYSPATH') or die('No direct access allowed.');

class Controller_Logout extends Controller {
    public function action_index()
    {
        // Handled from a form with inputs with names email / password
        Auth::instance()->logout();
        if ($this->request->referrer())
            HTTP::redirect($this->request->referrer());
        else
            HTTP::redirect("welcome");
        exit;
    }
}