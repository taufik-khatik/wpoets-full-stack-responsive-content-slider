<?php
include "db.php";

if (!empty($_POST['id'])) {
    $id = intval($_POST['id']);
    $result = $conn->query("SELECT image FROM slides WHERE id=$id");
    if ($result && $row = $result->fetch_assoc()) {
        $image = $row['image'];
        if ($image && file_exists("assets/uploads/$image")) {
            @unlink("assets/uploads/$image");
        }
    }

    if ($conn->query("DELETE FROM slides WHERE id=$id")) {
        echo 'success';
    } else {
        echo 'error';
    }
} else {
    echo 'error';
}
