<?php

namespace App\Core;

/**
 * Class Config
 * @package App\Core
 */
class Config
{
    public $baseUrl = 'http://myblog.local/';
    public $tplDir = '../app/views/';

    public $dbHost = 'localhost';
    public $dbUser = 'root';
    public $dbPassword = '';
    public $dbName = 'myblog';
    public $dbPrefix = 'blog_';
    
    public $minLoginLength = 3;
    public $maxLoginLength = 255;
}