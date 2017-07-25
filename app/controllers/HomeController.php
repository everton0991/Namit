<?php

namespace App\controllers;

use App\services\NameFinder;
use App\services\UploadManager;
use App\services\FileTypeManager;

Class HomeController {

    public $input;

    public function __construct()
    {
        $request = ($_REQUEST) ? $_REQUEST : json_decode(file_get_contents('php://input'));
        $this->input  = $request;
        $this->finder = new NameFinder;
    }

    public function index()
    {
        include('dist/views/home.php');
    }

    public function search()
    {
        $searchResult = $this->finder->callRegistroURL($this->input->field);
        include('dist/views/results.php');
    }

    public function upload()
    {
        $uploadManager = new UploadManager('qqfile');
        $uploaded = json_decode($uploadManager->uploadFile());

        if($uploaded->status->completed)
        {
            $uploadResult = [
                'completed' => $uploaded->status->completed,
                'filePath' => $uploaded->realPath,
                'data' => $uploaded->status->data,
                'errors' => $uploaded->status->errors,
                'success' => true,
            ];
        }
        else
        {
            $uploadResult = [
                'errors' => $uploaded->status->errors
            ];
        }

        echo json_encode($uploadResult);
    }

    public function treatment()
    {
        if(array_key_exists('filePath', $this->input))
        {
            $names = new FileTypeManager($this->input->filePath);
            $searchResult = $names->checkNamesFromFile();
            include('dist/views/results.php');
        }
        return ($this->input->errors);
    }

}
