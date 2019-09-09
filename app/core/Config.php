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

    public $dbHost = '';
    public $dbUser = '';
    public $dbPassword = '';
    public $dbName = '';
    public $dbPrefix = '';
    
    public $minLoginLength = 3;
    public $maxLoginLength = 255;
}
