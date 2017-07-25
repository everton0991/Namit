<?php

namespace App\services;

use App\services\NameFinder;
use RTFLex\io\StreamReader;
use RTFLex\tokenizer\RTFTokenizer;
use RTFLex\tree\RTFDocument;

Class FileTypeManager{

    public $file;
    public $namesToCheck;

    public function __construct($filePath)
    {
        $this->file   = new \SplFileObject($filePath);
        $this->finder = new NameFinder;
    }

    public function checkNamesFromFile()
    {
        switch ($this->file->getExtension())
        {
            case $this->file->getExtension() == 'rtf':
                $this->readRTF();
                    break;

            case $this->file->getExtension() == 'txt':
                $this->readTXT();
                    break;
        }
        return $this->finder->callRegistroURL($this->namesToCheck);
    }

    public function readTXT()
    {
        foreach($this->file as $row => $content)
        {
            $this->namesToCheck[] = preg_replace('/\s+/', '', $content);;
        }
    }

    public function readRTF()
    {
        $reader = new StreamReader($this->file->getPath().'/'.$this->file->getFilename());
        $tokenizer = new RTFTokenizer($reader);
        $doc = new RTFDocument($tokenizer);

        $replaceSpaces = preg_replace('/\s+/', "\n", $doc->extractText());
        $returnArrayFromStr = explode("\n",$replaceSpaces);
        $this->namesToCheck = array_filter($returnArrayFromStr);
    }

}