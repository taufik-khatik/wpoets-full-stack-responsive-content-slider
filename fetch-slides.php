<?php
include "db.php";

$tab = $_POST['tab'];

$q = $conn->query("SELECT * FROM slides WHERE tab_name='$tab'");

while ($row = $q->fetch_assoc()) {
    echo '
        <div class="slide" data-id="'.$row['id'].'" data-img="assets/uploads/'.$row['image'].'">
            <span class="tag">'.$row['tag'].'</span>
            <h3>'.$row['title'].'</h3>
            <a href="'.$row['link'].'">Learn More <i class="fa-solid fa-arrow-right"></i></a>
        </div>
    ';
}