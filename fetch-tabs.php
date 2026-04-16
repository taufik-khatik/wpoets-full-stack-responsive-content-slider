<?php
include "db.php";

$q = $conn->query("SELECT DISTINCT tab_name, tab_icon FROM slides ORDER BY id ASC");

$first = true;
while ($row = $q->fetch_assoc()) {
    $tab = $row['tab_name'];
    $icon = $row['tab_icon'] ?: 'fa-circle';
    $active = $first ? 'active' : '';
    echo '<li class="nav-item '.$active.'" data-tab="'.htmlspecialchars($tab, ENT_QUOTES).'"><i class="fa-solid '.$icon.'"></i> '.$tab.'</li>';
    $first = false;
}