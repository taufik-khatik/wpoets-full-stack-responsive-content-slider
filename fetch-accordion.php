<?php
include "db.php";

$q = $conn->query("SELECT DISTINCT tab_name, tab_icon FROM slides ORDER BY id ASC");

$first = true;
while ($row = $q->fetch_assoc()) {
    $tab = $row['tab_name'];
    $icon = $row['tab_icon'] ?: 'fa-circle';
    $collapsed = $first ? '' : 'collapsed';
    echo '<div class="accordion-item">
        <button class="accordion-button '.$collapsed.'" data-tab="'.htmlspecialchars($tab, ENT_QUOTES).'"><i class="fa-solid '.$icon.'"></i> '.$tab.'</button>
    </div>';
    $first = false;
}