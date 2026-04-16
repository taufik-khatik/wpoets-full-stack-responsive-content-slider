<?php include "includes/header.php"; ?>
<?php include "db.php"; ?>

<div class="main-wrapper">

    <!-- HEADER -->
    <div class="top-section text-center">
        <h1>WPoets Responsive Content Slider</h1>
        <p>A dynamic web application for managing interactive <br> learning content with tabs, sliders, and responsive design.</p>
    </div>

    <div class="container content-section">

        <div class="row g-0 main-box">

            <!-- LEFT TABS -->
            <div class="col-md-3 left-tabs d-none d-md-block">
                <ul class="nav flex-column nav-pills" id="tabs">
                    <!-- Tabs loaded dynamically -->
                </ul>
            </div>

            <!-- MOBILE ACCORDION -->
            <div class="col-12 d-md-none mobile-accordion">
                <div class="accordion" id="accordionTabs">
                    <!-- Accordion loaded dynamically -->
                </div>
            </div>

            <!-- SLIDER TEXT -->
            <div class="col-md-5 slider-text">
                <div id="textSlider">
                    <!-- Slides loaded dynamically -->
                </div>
            </div>

            <!-- IMAGE COLUMN -->
            <div class="col-md-4 image-box d-none d-md-block">
                <img id="mainImage" src="" alt="Slide image" />
            </div>

        </div>

        <!-- Icons Buttons -->
        <div class="text-end mt-3">
            <button title="Add New Slide" id="addSlide" class="btn btn-primary"><i class="fa-solid fa-plus"></i></button>
            <button title="Edit Current Slide" id="editSlide" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></button>
            <button title="Delete Current Slide" id="deleteSlide" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
        </div>

    </div>
</div>

<?php include "includes/footer.php"; ?>