<?php

class BooksManager extends AbstractEntityManager {

    public function __construct() {
        parent::__construct();
    }

    public function getLatestBooks($limit) {
        $stmt = $this->db->prepare("SELECT * FROM books ORDER BY created_at DESC LIMIT ?");
        $stmt->bindValue(1, (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}