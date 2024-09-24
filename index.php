<?php include 'header.php'; ?>

<head>
  <!-- Swiper JS CSS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
</head>

<div class="homepage">
    <h1>Book Your Event, Just Like That.</h1>
    <div class="swiper-container">
        <!-- Swiper Wrapper -->
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <a href="#">
                    <img src="resources/deadpool.jpg" alt="Event 1">
                    <div class="text">Deadpool & Wolverine <br><br> On 26 September</div>
                </a>
            </div>
            <div class="swiper-slide">
                <a href="#">
                    <img src="resources/gallery1.jpg" alt="Event 2">
                    <div class="text">Random Event<br><br> On 26 September</div>
                </a>
            </div>
            <div class="swiper-slide">
                <a href="#">
                    <img src="resources/gallery5.jpg" alt="Event 3">
                    <div class="text">Random Event<br><br> On 26 September</div>
                </a>
            </div>
            <div class="swiper-slide">
                <a href="#">
                    <img src="resources/coldplay.jpg" alt="Event 4">
                    <div class="text">Coldplay Concert <br><br>Olympic Park Stadium <br><br>On 28 September</div>
                </a>
            </div>
        </div>
        <!-- Swiper Navigation -->
        <div class="swiper-button-prev prev"></div>
            <div class="swiper-button-next next"></div>

    </div> 

    <p><br>BookEvent is your go-to platform for discovering and booking the best events in town. Whether it's movies, concerts, workshops, or conferences, we make it easy for you to find and secure your spot at the most exciting happenings. Browse, book, and enjoy—all in one place!</p>
</div> 


<script>
    var swiper = new Swiper('.swiper-container', {
        loop: true, // Allows continuous looping
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        autoplay: {
            delay: 3000, // Slide change every 3 seconds
            disableOnInteraction: false, // Keep autoplay even after user interaction
        },
        speed: 1500, // Speed of transition between slides
        slidesPerView: 1, // One slide at a time
        spaceBetween: 0, // No space between slides
    });
</script>


<?php include 'footer.php'; ?>
