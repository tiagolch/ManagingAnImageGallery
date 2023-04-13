<?php

class SingletonDBConnection {

    private static $instance;
    private $db;

    private function __construct($dbFile) {

        $this->db = new SQLite3($dbFile);
        $this->createTable();

    }

    public static function getInstance($dbFile) {

        if (!self::$instance) {
            self::$instance = new SingletonDBConnection($dbFile);

        }

        return self::$instance;
    }

    private function createTable() {

        $this->db->exec('CREATE TABLE IF NOT EXISTS 
                            images (
                                id INTEGER PRIMARY KEY AUTOINCREMENT, 
                                title TEXT, 
                                farm INTEGER, 
                                server TEXT, 
                                photo_id TEXT, 
                                secret TEXT
                            )'
                        );

    }

    public function insertImages($photos) {

        foreach ($photos as $photo) {

            $title = $this->db->escapeString($photo['title']);
            $farm = $photo['farm'];
            $server = $this->db->escapeString($photo['server']);
            $photo_id = $this->db->escapeString($photo['id']);
            $secret = $this->db->escapeString($photo['secret']);

            $this->db->exec("INSERT INTO images (title, farm, server, photo_id, secret) 
                                        VALUES ('$title', $farm, '$server', '$photo_id', '$secret')");   

        }
    }

    public function close() {

        $this->db->close();

    }

}

?>
