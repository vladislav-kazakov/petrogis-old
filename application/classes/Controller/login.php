<?php defined('SYSPATH') or die('No direct access allowed.');

class Controller_Login extends Controller {
    public function action_index()
    {
        // Handled from a form with inputs with names email / password
        $post = $this->request->post();
        $success = Auth::instance()->login($post['email'], $post['password']);
        if ($success) {
            // Login successful, send to app
            //print_r($this->request->referrer());exit;
            if ($this->request->referrer())
                HTTP::redirect($this->request->referrer());
            else
                HTTP::redirect("welcome");
            exit;
        } else {
            echo 'Login failed, send back to form with error message';
            // Login failed, send back to form with error message
        }
    }
}