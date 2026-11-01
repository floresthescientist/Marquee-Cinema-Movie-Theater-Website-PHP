<?php
/**
 * showtimes.php - Showtimes page
 * ------------------------------------------------------------
 * Lists every movie with all of its showtimes.
 * Includes a genre filter that uses the URL (?genre=Horror)
 * and highlights late shows using a call-by-reference function.
 * ------------------------------------------------------------
 */

require_once 'functions.php';
require_once 'data.php';

use function Marquee\{formatRuntime, markLateShows};

$pageTitle   = "Showtimes";
$currentPage = "showtimes";

include 'header.php';

// Pass $movies BY REFERENCE: the function adds 'late_times' to our actual array
markLateShows($movies);

// Read the selected filter from the URL; default is "All"
$selected = isset($_GET['genre']) ? $_GET['genre'] : "All";

// Filter options that match words in the movie genres
$filters = ["All", "Action", "Comedy", "Horror", "Family"];
?>

<h1 class="page-title">Today's Showtimes</h1>

<!-- Genre filter buttons -->
<div class="filters">
    <?php foreach ($filters as $filter): ?>
        <a href="showtimes.php?genre=<?php echo urlencode($filter); ?>"
           class="filter-btn <?php echo ($filter === $selected) ? 'active' : ''; ?>">
            <?php echo $filter; ?>
        </a>
    <?php endforeach; ?>
</div>

<p class="legend"><span class="time-chip late">🌙 Late</span> = starts at 9 PM or later</p>

<!-- Showtimes table -->
<table class="showtimes">
    <thead>
        <tr>
            <th>Movie</th>
            <th>Rating</th>
            <th>Runtime</th>
            <th>Times</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $shown = 0; // counts how many movies match the filter

        foreach ($movies as $movie):
            // Skip movies that don't match the chosen genre
            if ($selected !== "All" && stripos($movie['genre'], $selected) === false) {
                continue;
            }
            $shown++;
        ?>
            <tr>
                <td><?php echo $movie['poster'] . " " . $movie['title']; ?></td>
                <td><span class="badge"><?php echo $movie['rating']; ?></span></td>
                <td><?php echo formatRuntime($movie['runtime']); ?></td>
                <td>
                    <?php foreach ($movie['times'] as $time): ?>
                        <?php $isLate = in_array($time, $movie['late_times']); ?>
                        <span class="time-chip <?php echo $isLate ? 'late' : ''; ?>">
                            <?php echo ($isLate ? '🌙 ' : '') . $time; ?>
                        </span>
                    <?php endforeach; ?>
                </td>
            </tr>
        <?php endforeach; ?>

        <?php if ($shown === 0): ?>
            <!-- Message when no movies match the filter -->
            <tr><td colspan="4">No movies found for that genre today.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<?php include 'footer.php'; ?>
