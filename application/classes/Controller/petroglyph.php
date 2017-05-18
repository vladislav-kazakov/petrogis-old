<?php defined('SYSPATH') or die('No direct access allowed.');

class Controller_Petroglyph extends Controller {
    public function action_index()
    {
        $logged_in = Auth::instance()->logged_in();
        if (!$logged_in) HTTP::redirect('welcome');

        $header = View::factory('header');
        $footer = View::factory('footer');
        $header->logged_in = $logged_in;
        $header->menu = 'petroglyph';
        $header->username = Auth::instance()->get_user();
        
        $petroglyphs = ORM::factory('Petroglyph')->find_all();
        $template = View::factory('petroglyph/list');
        $template->petroglyphs = $petroglyphs;
        $template->header = $header;
        $template->footer = $footer;
        $this->response->body($template->render());
        $_SESSION['referrer'] = $this->request->uri();
    }
    
    public function action_view()
    {
        $logged_in = Auth::instance()->logged_in();
        if (!$logged_in) HTTP::redirect('welcome');

        $header = View::factory('header');
        $footer = View::factory('footer');
        $header->logged_in = $logged_in;
        $header->menu = 'petroglyph';
        $header->username = Auth::instance()->get_user();

        $petroglyph_id = $this->request->param('id');
        $petroglyph = new Model_Petroglyph($petroglyph_id);

        $template = View::factory('petroglyph/view');
        $template->header = $header;
        $template->footer = $footer;
        $template->petroglyph = $petroglyph;

        $template->img_src = URL::base() ."data/petroglyph/image/" . $petroglyph->image;
        $_SESSION['referrer'] = $this->request->uri();
        $this->response->body($template->render());
    }
    public function action_admin()
    {
        $logged_in = Auth::instance()->logged_in();
        if (!$logged_in) HTTP::redirect('welcome');

        $template = View::factory('petroglyph/form');

        $header = View::factory('header');
        $footer = View::factory('footer');
        $template->header = $header;
        $template->footer = $footer;
        $header->logged_in = $logged_in;
        $header->menu = 'petroglyph';
        $header->username = Auth::instance()->get_user();

        $template->title = 'Petrogpyph';
        $petroglyph_id = $this->request->param('id');
        $petroglyph = new Model_Petroglyph($petroglyph_id);

        $post = $this->request->post();
        if ($post) {
            $petroglyph->name = $post['name'];
            if ($petroglyph->save())
            {
                if ($_FILES) $this->upload();
                HTTP::redirect($_SESSION['referrer']? $_SESSION['referrer'] : 'petroglyph');
            }
            else {
                $template->petroglyph = $post->as_array();
                $template->errors = $post->errors();
            }
        } else $template->petroglyph = $petroglyph->as_array();

        $this->response->body($template->render());
    }
    public function action_delete()
    {
        $petroglyph_id = $this->request->param('id');
        $petroglyph = ORM::factory('petroglyph', $petroglyph_id);
        if ($petroglyph->loaded()) $petroglyph->delete();
        HTTP::redirect('petroglyph');
    }

    public function upload()
    {
        // Check if it is already loguserged in!
        $logged_in = Auth::instance()->logged_in();
        if (!$logged_in) HTTP::redirect('welcome');

        if ($_FILES) {
          /*  $upload = Validation::factory($_FILES)
                ->rule('image', 'Upload::valid')
                ->rule('image', 'Upload::not_empty')
                ->rule('image', 'Upload::type', array(':value', array('jpg', 'png', 'gif')))
               ->rule('image', 'Upload::size', array(':value', '20M'));
*/
            if (true/*$upload->check()*/) {
                $name = $_FILES['image']['name']; // Save file name
                $fstype = '';
                if (preg_match("/\.\w+/i", $name, $matches)) $fstype = $matches[0];

                $fsname = uniqid(md5(Session::instance()->get('auth_user'))) . $fstype;
                $dir = DOCROOT . 'data' . DIRECTORY_SEPARATOR . 'petroglyph' . DIRECTORY_SEPARATOR . 'image' . DIRECTORY_SEPARATOR;

                if (!file_exists($dir)) mkdir($dir, '0777', TRUE);
                Upload::save($_FILES['image'], $fsname, $dir);

                $model_petroglyph = ORM::factory('Petroglyph', $this->request->param('id'));
                //remove old image file from fs
                if (file_exists($dir . $model_petroglyph->image)) unlink($dir . $model_petroglyph->image);

                $model_petroglyph->image = $fsname;
                $model_petroglyph->update();
            } else {
                //todo: handle file upload error
            }
        }
    }
}

/* Example
  public function action_upload() {
    // Create modelfiles object
    $modelfiles = New Model_File();

    // Check if it is already loguserged in!
    if (!Auth::instance()->logged_in()) {
        // Redirect to his home page
        return $this->request->redirect(URL::site(Route::get('user')->uri(array('action' => 'login'))));
    }
    if ($_FILES) {
        $files_array = array();
        $uploaded_files = count($_FILES['file']['name'], 0);
        for ($i = 0; $i < $uploaded_files; $i++) {
        foreach ($_FILES['file'] as $key => $value) {
            $files_array['file'][$key] = $value[$i];
        }
        // Create Validation object
        $upload = Validation::factory($files_array)
            ->rule('file', 'Upload::valid')
            ->rule('file', 'Upload::not_empty')
            ->rule('file', 'Upload::type', array(':value', array('jpg', 'png', 'gif', 'pdf', 'xls', 'docx', 'xlsx', 'zip')))
            ->rule('file', 'Upload::size', array(':value', '2M'));

        if ($upload->check()) {
            // If validation is OK
            $name = $upload['file']['name']; // Save file name
            $fstype = '';
            if (preg_match("/\.\w+/i", $name, $matches)) {
            $fstype = $matches[0];
            }

            //
            $type = $upload['file']['type']; // Save file tipe: 'immage/jpeg'
            $size = $upload['file']['size']; // Save file size: 406b

            // Create uniq name for the file(solve the UTF-8 and cirillyc problem)
            // we will have file name like:
            // 21232f297a57a5a743894a0e4a801fc34e92dd9e397bc.pdf
            $fsname = uniqid(md5(Session::instance()->get('auth_user'))).$fstype;

            //
            $path = Kohana::config('fm')->get('path');

            // Store internal path
            $int_dir = date('Y').DIRECTORY_SEPARATOR.date('m').DIRECTORY_SEPARATOR.date('d').DIRECTORY_SEPARATOR;

            // Store fullpath path
            $directory = $path.$int_dir;

            if (file_exists($directory) && is_dir($directory)) {
            $filename = Upload::save($upload['file'], $fsname, $directory);
            }
            else {
            $directory = $modelfiles->_make_directory($directory, '0777', TRUE);
            $filename = Upload::save($upload['file'], $fsname, $directory);
            }
            // Get user id
            //array('id', 'name', 'path', 'user_id', 'nicename', 'mimetype', 'created', 'weight', 'category_id');
            $modeluser = New Model_User();
            $user_id = $modeluser->get(Session::instance()->get('auth_user'));

            //
            $data = array('name' => $fsname,
            'path' => $int_dir,
            'mimetype' => $type,
            'user_id' => $user_id,
            'nicename' => $name,
            'size' => $size,
            'created' => time());

            // Insert data to mysql
            $modelfiles->insert($data);

        }
        else {
            $err = $upload->errors('upload');
            $file_errors[$i] = $err['file'];
        }
        $sum_errors = array_merge($sum_errors, $file_errors);
        }
    }
    //
    $errors = array_merge($errors, $sum_errors);
    //
    $files = $modelfiles->get(Session::instance()->get('auth_user'));
    $count = count($files);

    if ($count == 0) {
        unset($files);
    }
    $this->template->content = View::factory('filemanager')
        ->bind('files', $files)
        ->bind('count', $count)
        ->bind('errors', $errors);
    }

*/