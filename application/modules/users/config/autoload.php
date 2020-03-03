<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();

$autoload['libraries'] = array('database','form_validation');

$autoload['helper'] = array('url', 'form', 'rest','date');

$autoload['language'] = array('api');

$autoload['config'] = array('rest');