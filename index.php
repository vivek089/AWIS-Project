<?php include 'header.php'; ?>

<div class="homepage">
    <h1>Book Your Event, Just Like That.</h1>

    <!-- Slideshow container -->
    <div class="slideshow-container">
        <div class="slides">
			<a href="#">
            	<img src="resources/deadpool.jpg" alt="Event 1">
            	<div class="text">Deadpool & Wolverine <br><br> On 26 September</div>
			</a>
        </div>
		<div class="slides">
			<a href="#">
            	<img src="resources/gallery1.jpg" alt="Event 2">
            	<div class="text">Random Event<br><br> On 26 September</div>
			</a>
        </div>
		<div class="slides">
			<a href="#">
            	<img src="resources/gallery5.jpg" alt="Event 3">
            	<div class="text">Random Event<br><br> On 26 September</div>
			</a>
        </div>
        <div class="slides">
			<a href="#">
            	<img src="resources/coldplay.jpg" alt="Event 4">
            	<div class="text">Coldplay Concert <br><br>Olympic Park Stadium <br><br>On 28 September</div>
			</a>
        </div>

        <!-- Navigation buttons -->
        <a class="prev" onclick="plusSlides(-1)"><i class="fa-solid fa-angle-left"></i></a>
        <a class="next" onclick="plusSlides(1)"><i class="fa-solid fa-angle-right"></i></a>
    </div>

	<p><br>BookEvent is your go-to platform for discovering and booking the best events in town. Whether it's movies, concerts, workshops, or conferences, we make it easy for you to find and secure your spot at the most exciting happenings. Browse, book, and enjoy—all in one place!</p>
</div>
<script>
	let slideIndex = 0;
let slides = document.getElementsByClassName("slides");
let totalSlides = slides.length;
let slideTimer; // Store the timer reference

function showSlides(n) {
    // Reset slideIndex if out of bounds
    if (n >= totalSlides) {
        slideIndex = 0;
    } else if (n < 0) {
        slideIndex = totalSlides - 1;
    } else {
        slideIndex = n;
    }

    // Apply the sliding effect by adjusting the transform property
    for (let i = 0; i < totalSlides; i++) {
        slides[i].style.transform = `translateX(${-(slideIndex * 100)}%)`;
    }

    // Reset and restart the timer after slide change
    clearTimeout(slideTimer);
    slideTimer = setTimeout(() => showSlides(slideIndex + 1), 4000);
}

// Function to move to the next or previous slide when icons are clicked
function plusSlides(n) {
    showSlides(slideIndex + n);
}

// Start automatic sliding
slideTimer = setTimeout(() => showSlides(slideIndex + 1), 4000);

</script>

	<br><br><br>

<?php include 'footer.php'; ?>
