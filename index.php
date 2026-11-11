<?php
/**
 * index.php - home page
 * ------------------------------------------------------------
 * shows a welcome banner and a "now showing" grid of movies.
 * demonstrates require (critical files) vs include (layout files).
 * ------------------------------------------------------------
 */

// 1. require_once: the page cannot work without these files.
//    if one is missing, require stops with a fatal error,
//    while include would only warn and keep going.
require_once 'functions.php';
require_once 'data.php';

// bring in the namespaced functions this page uses
use function Marquee\{getGreeting, renderMovieCard, countShowtimes};

// 2. set page-specific variables used inside header.php
$pageTitle   = "Home";
$currentPage = "home";

// 3. include the shared header
include 'header.php';
?>

<!-- hero banner -->
<section class="hero">
    <!-- getGreeting() is called with no argument, so its default (current hour) is used -->
    <h1><?php echo getGreeting(); ?>, movie fans!</h1>
    <p>Grab your popcorn — here's what's playing at Marquee Cinema today,
       <strong><?php echo date('l, F j'); ?></strong>.</p>

    <!-- countShowtimes() adds up every showtime recursively -->
    <p class="hero-stats">
        🎟️ <?php echo countShowtimes($movies); ?> showtimes across
        <?php echo count($movies); ?> screens today
    </p>
    <a href="showtimes.php" class="btn">View Showtimes</a>
</section>

<!-- now showing grid: renderMovieCard() returns the html for each card -->
<section>
    <h2 class="section-title">Now Showing</h2>
    <div class="movie-grid">
        <?php foreach ($movies as $movie): ?>
            <?php echo renderMovieCard($movie); ?>
        <?php endforeach; ?>
    </div>
</section>

<!-- snack bar promo -->
<section class="promo">
    <h2>🍿 Tuesday Deal</h2>
    <p>Every Tuesday: $6 tickets and free popcorn refills all day.</p>
</section>

<?php
// 4. include the shared footer
include 'footer.php';
?>
