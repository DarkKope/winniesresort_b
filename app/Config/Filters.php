<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Filters extends BaseConfig
{
    public $aliases = [];

    public $globals = [
        'before' => [],
        'after' => [],
    ];

    public $methods = [];

    public $filters = [];
}