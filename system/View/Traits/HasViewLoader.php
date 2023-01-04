<?php

namespace  System\View\Traits;

use System\Config\Config;

trait HasViewLoader
{

    private $viewNameArray = [];

    private function viewLoader($dir)
    {
        $dir = trim($dir, " .");
        $dir = str_replace(".", "/", $dir);
        if(file_exists(Config::get('app.BASE_DIR')."/resources/view/$dir.blade.php"))
        {
            $this->registerView($dir);
            $content = htmlentities(file_get_contents(Config::get('app.BASE_DIR')."/resources/view/$dir.blade.php"));
            return $content;
        }
        else{
            throw new \Exception('view not Found!!!!');
        }
    }

    private function registerView($view)
    {
        array_push($this->viewNameArray, $view);
    }
}
