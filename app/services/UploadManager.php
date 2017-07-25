<?php

namespace App\services;

use Upload\Storage\FileSystem as Storage;
use Upload\File as File;
use Upload\Validation\Mimetype as MimeType;
use Upload\Validation\Size as Size;

Class UploadManager {

    private $file;
    private $inputName = 'files';
    private $mimes = [
        'application/vnd.ms-excel',
        'text/plain',
        'text/rtf',
        'text/richtext'
    ];
    private $path = __DIR__.'/../../public/uploads/';
    private $maxsize = '8M';
    private $fileFinalName;

    /*
     *
     * Construct Class
     *
     * @param: $inputName
     *
     * */
    public function __construct($inputName)
    {
        $this->inputName = $inputName;
        $storage = new Storage($this->path);
        $this->file = new File($this->inputName, $storage);
    }

    /*
     *
     * Receive file input name
     * Set file new name
     * Runs file mimetype validation
     * Get uploaded file data to return for the controller to treat
     *
     * @return: json object
     *
     * */
    public function uploadFile()
    {
        $new_filename = uniqid();
        $this->file->setName($new_filename);

        $this->runValidation();

        $fileUploaded = $this->fileUploadedData();
        $this->fileFinalName = $this->path.$fileUploaded['name'];

        $upload = $this->tryUpload();

        return json_encode(['status' => $upload, 'realPath' => $this->fileFinalName]);
    }

    /*
     *
     * Uploaded file data
     *
     * @return: Array
     *
     * */
    private function fileUploadedData()
    {
        $data = [
            'name'       => $this->file->getNameWithExtension(),
            'extension'  => $this->file->getExtension(),
            'mime'       => $this->file->getMimetype(),
            'size'       => $this->file->getSize(),
            'md5'        => $this->file->getMd5(),
            'dimensions' => $this->file->getDimensions()
        ];
        return $data;
    }

    /*
     *
     * Validate mimetypes availables
     *
     * @return: boolean
     *
     * */
    private function runValidation()
    {
        $validations[] = new MimeType($this->mimes);
        $validations[] = new Size($this->maxsize);
        return $this->file->addValidations($validations);
    }

    /*
     *
     * Try to upload file
     *
     * @return: array
     *
     * */
    private function tryUpload()
    {
        try
        {
            $status['data']      = $this->file->upload();
            $status['errors']    = '';
            $status['completed'] = 1;
            return $status;
        }
        catch (\Exception $e)
        {
            $status['errors']    = $this->file->getErrors();
            $status['completed'] = 0;
            return $status;
        }
    }

}