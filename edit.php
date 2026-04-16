<?php include "includes/header.php"; ?>
<?php include "db.php"; ?>

<?php
$id = $_GET['id'];
$row = $conn->query("SELECT * FROM slides WHERE id=$id")->fetch_assoc();
?>

<div class="container mt-4">

    <h3>Edit Slide</h3>
    <form method="POST" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="tab_name" class="form-label">Tab Name</label>
            <input type="text" name="tab_name" id="tab_name" value="<?php echo $row['tab_name']; ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tab Icon (Font Awesome)</label>
            <input type="hidden" name="tab_icon" id="tab_icon" value="<?php echo $row['tab_icon']; ?>">
            <button id="iconpicker" class="btn btn-warning" role="iconpicker"></button>
        </div>

        <div class="mb-3">
            <label for="tag" class="form-label">Tag</label>
            <input type="text" name="tag" id="tag" value="<?php echo $row['tag']; ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" value="<?php echo $row['title']; ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="link" class="form-label">Link</label>
            <input type="text" name="link" id="link" value="<?php echo $row['link']; ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" id="image" class="form-control">
            <small class="form-text text-warning">Leave empty to keep current image</small>
        </div>

        <button class="btn btn-primary" name="submit">Update</button>
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

    $img = $row['image'];
    if ($_FILES['image']['name']) {
        $img = uniqid() . "." . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        move_uploaded_file($_FILES['image']['tmp_name'], "assets/uploads/" . $img);
    }

    $sql = "UPDATE slides SET tab_name='$tab', tab_icon='$tab_icon', tag='$tag', title='$title', link='$link', image='$img' WHERE id=$id";
    $conn->query($sql);

    header("Location: index.php");
}
?>

<script>
$(document).ready(function(){
    $('#iconpicker').iconpicker({
        iconset: 'fontawesome5',
        icon: '<?php echo $row['tab_icon']; ?>',
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