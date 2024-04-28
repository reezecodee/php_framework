<?php

namespace Framework;

use Database\Database;

class Application
{
    public static Application $app;
    public Database $db;

    public function __construct()
    {
        self::$app = $this;
        $this->db = new Database();
    }
}
