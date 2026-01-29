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

    public function getAllBooks() {
        $stmt = $this->db->prepare("SELECT * FROM books");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function searchBooksByTitleAndAuthor($searchTerm) {
        $stmt = $this->db->prepare("SELECT * FROM books WHERE title LIKE ? OR author LIKE ?");
        $likeTerm = '%' . $searchTerm . '%';
        $stmt->bindValue(1, $likeTerm, PDO::PARAM_STR);
        $stmt->bindValue(2, $likeTerm, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getBookById($bookId) {
        $stmt = $this->db->prepare("SELECT * FROM books WHERE id = ?");
        $stmt->bindValue(1, (int)$bookId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function updateBook($bookId, $title, $author, $description, $isAvailable) {
        $stmt = $this->db->prepare("UPDATE books SET title = ?, author = ?, description = ?, is_available = ? WHERE id = ?");
        $stmt->bindValue(1, $title, PDO::PARAM_STR);
        $stmt->bindValue(2, $author, PDO::PARAM_STR);
        $stmt->bindValue(3, $description, PDO::PARAM_STR);
        $stmt->bindValue(4, $isAvailable, PDO::PARAM_BOOL);
        $stmt->bindValue(5, (int)$bookId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}