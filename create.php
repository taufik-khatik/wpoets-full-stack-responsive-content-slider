<?php include "includes/header.php"; ?>
<?php include "db.php"; ?>

<div class="container mt-4">

    <h3>Add New Slide</h3>
    <form method="POST" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="tab_name" class="form-label">Tab Name</label>
            <input type="text" name="tab_name" id="tab_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tab Icon (Font Awesome)</label>
            <input type="hidden" name="tab_icon" id="tab_icon" value="fas fa-users">
            <button id="iconpicker" class="btn btn-warning" role="iconpicker"></button>
            <div role="iconpicker"></div>
        </div>

        <div class="mb-3">
            <label for="tag" class="form-label">Tag</label>
            <input type="text" name="tag" id="tag" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="link" class="form-label">Link</label>
            <input type="text" name="link" id="link" class="form-control" placeholder="e.g., #" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" id="image" class="form-control" required>
        </div>

        <button class="btn btn-primary" name="submit">Save</button>
        <button class="btn btn-secondary" onclick="window.location='index.php'; return false;">Back</button>

    </form>

</div>

<?php
if (isset($_POST['submit'])) {
    
    $tab = $_POST['tab_name'];
    $tab_icon = $_POST['tab_icon'];
    $tag = $_POST['tag'];
    $title = $_POST['title'];
    $link = $_POST['link'];

    // Generate a unique filename
    $img = uniqid() . "." . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

    move_uploaded_file($_FILES['image']['tmp_name'], "assets/uploads/" . $img);

    $sql = "INSERT INTO slides (tab_name, tab_icon, tag, title, link, image)
            VALUES ('$tab', '$tab_icon', '$tag', '$title', '$link', '$img')";

    $conn->query($sql);

    header("Location: index.php");
}
?>

<script>
$(document).ready(function(){
    $('#iconpicker').iconpicker({
        iconset: 'fontawesome5',
        icon: 'fas fa-users',
        rows: 5,
        cols: 6,
        placement: 'bottom'
    });

    $('#iconpicker').on('change', function(e) {
        $('#tab_icon').val(e.icon);
    });
});
</script>

<?php include "includes/footer.php"; ?>