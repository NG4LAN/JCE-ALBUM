<?php

namespace app\Controllers;

use config\DBConnection;
use app\Models\AlbumModel;

class AlbumController
{
    private $AlbumModel;

    public function __construct()
    {
        $db = new DBConnection();
        $this->AlbumModel = new AlbumModel($db);
    }

    public function index()
    {
        $album = $this->AlbumModel->getAll();
        echo $GLOBALS['templates']->render('Album', ['album' => $album]);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $desc = $_POST['desc'] ?? '';
            $imageFileName = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $imageFileName = uniqid() . '_' . basename($_FILES['image']['name']);
                $uploadPath = $uploadDir . $imageFileName;

                move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath);
            }
            $this->AlbumModel->create($desc, $imageFileName);
        }
        header("Location: /");
        exit;
    }
    public function edit($id)
    {
        $album = $this->AlbumModel->find($id);
        echo $GLOBALS['templates']->render('AlbumUpdate', ['album' => $album]);
    }
    // public function update($id, $desc, $completed)
    // {
    //     $this->AlbumModel->update($id, $desc, $completed);
    //     header("Location: /");
    //     exit;
    // }
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? '';
            $desc = $_POST['desc'] ?? '';
            $imageFileName = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $imageFileName = uniqid() . '_' . basename($_FILES['image']['name']);
                $uploadPath = $uploadDir . $imageFileName;

                move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath);
            }
            $this->AlbumModel->update($id, $desc, $imageFileName);
        }
        header("Location: /");
        exit;
    }
    public function delete($id)
    {
        $this->AlbumModel->delete($id);
        header("Location: /");
        exit;
    }

    // Add your custom controllers below to handle business logic.
}
