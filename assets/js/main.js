function loadTabs(callback) {
    $.get("fetch-tabs.php", function(data) {
        $("#tabs").html(data);
        if (callback) callback();
    });
}

function loadAccordion() {
    $.get("fetch-accordion.php", function(data) {
        $("#accordionTabs").html(data);
    });
}

function getCurrentSlide() {
    let currentSlide = $('#textSlider .slide.slick-current');
    if (!currentSlide.length) {
        currentSlide = $('#textSlider .slide:first');
    }
    return currentSlide;
}

function updateMainImage(index = 0) {
    let img = $('#textSlider .slide').eq(index).data('img');
    if (img) {
        $('#mainImage').attr('src', img);
        if ($(window).width() < 768) {
            $('.slider-text').css('background-image', 'url('+img+')');
        }
    }
}

function loadSlides(tab) {
    $.post("fetch-slides.php", { tab: tab }, function(response) {
        if ($('#textSlider').hasClass('slick-initialized')) {
            $('#textSlider').slick('unslick'); // reset only if initialized
        }

        $('#textSlider').html(response);

        $('#textSlider').slick({
            arrows: false,
            dots: false
        });

        updateMainImage(0);
    });
}

$(document).ready(function(){
    loadTabs(function(){
        let firstTab = $('#tabs .nav-item:first').data('tab');
        if (firstTab) {
            $('#tabs .nav-item:first').addClass('active');
            loadSlides(firstTab);
        }
    });
    loadAccordion();

    // sync image on slide change
    $('#textSlider').on('afterChange', function(event, slick, current){
        updateMainImage(current);

        // mobile background
        if($(window).width() < 768){
            $('.slider-text').css('background-image', 'url('+$('.slide').eq(current).data('img')+')');
        }
    });

    // TAB CLICK
    $(document).on('click', '#tabs .nav-item', function(){
        $('#tabs .nav-item').removeClass('active');
        $(this).addClass('active');

        let tab = $(this).data('tab');
        loadSlides(tab);
    });

    // MOBILE ACCORDION CLICK
    $(document).on('click', '.accordion-button', function(){
        $('.accordion-button').addClass('collapsed');
        $(this).removeClass('collapsed');
        let tab = $(this).data('tab');
        loadSlides(tab);
    });

    // ADD SLIDE BUTTON
    $(document).on('click', '#addSlide', function(){
        window.location.href = 'create.php';
    });

    // EDIT SLIDE BUTTON
    $(document).on('click', '#editSlide', function(){
        let currentSlide = getCurrentSlide();
        let slideId = currentSlide.data('id');
        if (slideId) {
            window.location.href = 'edit.php?id=' + slideId;
        }
    });

    // DELETE SLIDE BUTTON
    $(document).on('click', '#deleteSlide', function(){
        let currentSlide = getCurrentSlide();
        let tabName = $('#tabs .nav-item.active').text().trim();
        let slideId = currentSlide.data('id');
        if (slideId && confirm('Are you sure you want to delete [' + tabName + '] slide?')) {
            $.post("delete-slide.php", { id: slideId }, function(data) {
                if (data === 'success') {
                    window.location.href = 'index.php';
                } else {
                    alert('Unable to delete [' + tabName + '] slide.');
                }
            });
        }
    });

});