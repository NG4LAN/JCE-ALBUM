<?php

namespace app\Models;

use config\DBConnection;
use PDO;

class AlbumModel
{
    private $db;

    public function __construct(DBConnection $db)
    {
        $this->db = $db->getConnection();
    }

    // Add your custom methods below to interact with the database.
    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM album");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM album WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($desc, $imageFileName)
    {
        $stmt = $this->db->prepare("INSERT INTO album (description, image) VALUES (:description, :image)");
        $stmt->bindParam(':description', $desc, PDO::PARAM_STR);
        $stmt->bindParam(':image', $imageFileName, PDO::PARAM_STR);
        return $stmt->execute();
    }
    public function update($id, $desc, $imageFileName)
    {
        if ($imageFileName) {
            $stmt = $this->db->prepare("
                UPDATE album 
                SET description = :description, image = :image 
                WHERE id = :id
            ");
            $stmt->bindParam(':image', $imageFileName, PDO::PARAM_STR);
        } else {
            $stmt = $this->db->prepare("
                UPDATE album 
                SET description = :description,
                WHERE id = :id
            ");
        }

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':description', $desc, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM album WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
