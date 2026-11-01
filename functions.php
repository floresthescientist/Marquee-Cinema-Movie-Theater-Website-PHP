<?php
/**
 * functions.php
 * ------------------------------------------------------------
 * Reusable helper functions for the Marquee Cinema site.
 * Pages load this file with require_once (the site cannot run
 * without it, so require is safer than include here).
 *
 * Lesson 5 concepts shown in this file:
 *   - Namespaces .............. namespace Marquee (below)
 *   - Defining functions ...... every function in this file
 *   - Parameters / defaults ... getGreeting(), renderMovieCard(), formField()
 *   - Returning values ........ formatRuntime(), getGreeting(), etc.
 *   - Scope (global/static) ... theaterName(), renderMovieCard()
 *   - Call by reference ....... markLateShows()
 *   - Call by value ........... countShowtimes()
 *   - Recursion ............... countShowtimes()
 * ------------------------------------------------------------
 */

// Namespace keeps our function names from clashing with other code.
// Pages bring them in with:  use function Marquee\functionName;
namespace Marquee;

/**
 * Converts a runtime in minutes to "2h 8m" format.
 * Parameter: $minutes (int)   Returns: string
 */
function formatRuntime($minutes) {
    $hours = floor($minutes / 60);
    $mins  = $minutes % 60;
    return $hours . "h " . $mins . "m";
}

/**
 * Returns a greeting based on the hour of the day.
 * DEFAULT PARAMETER: if no hour is passed in, the current hour is used.
 */
function getGreeting($hour = null) {
    if ($hour === null) {
        $hour = (int) date('G');   // 0-23
    }

    if ($hour < 12) {
        return "Good morning";
    } elseif ($hour < 18) {
        return "Good afternoon";
    }
    return "Good evening";
}

/**
 * Returns the theater's name.
 * SCOPE: variables created outside a function are not visible inside it.
 * The "global" keyword gives this function access to $theaterName,
 * which is defined in data.php.
 */
function theaterName() {
    global $theaterName;
    return $theaterName;
}

/**
 * Builds the HTML for one movie card and RETURNS it as a string.
 * DEFAULT PARAMETER: $showSummary is true unless the caller passes false.
 * STATIC VARIABLE: $screen keeps its value between calls, so each card
 * gets the next screen number (1, 2, 3...) without using a global.
 */
function renderMovieCard($movie, $showSummary = true) {
    static $screen = 0;
    $screen++;

    $html  = '<article class="movie-card">';
    $html .= '  <div class="poster">' . $movie['poster']
           . '    <span class="screen-tag">Screen ' . $screen . '</span></div>';
    $html .= '  <div class="movie-info">';
    $html .= '    <h3>' . htmlspecialchars($movie['title']) . '</h3>';
    $html .= '    <p class="meta"><span class="badge">' . $movie['rating'] . '</span> '
           . htmlspecialchars($movie['genre']) . ' · ' . formatRuntime($movie['runtime']) . '</p>';

    if ($showSummary) {
        $html .= '    <p>' . htmlspecialchars($movie['summary']) . '</p>';
    }

    // Show only the first showtime as a teaser
    $html .= '    <p class="next-show">Next show: ' . $movie['times'][0] . '</p>';
    $html .= '  </div>';
    $html .= '</article>';

    return $html;
}

/**
 * Counts every showtime across all movies.
 * RECURSION: the function calls itself on a smaller list each time
 * until the list is empty (the "base case").
 * CALL BY VALUE: $movies is a copy, so array_shift() below does NOT
 * change the caller's original $movies array.
 */
function countShowtimes($movies) {
    // Base case: no movies left
    if (empty($movies)) {
        return 0;
    }

    // Take the first movie off the copy, then recurse on the rest
    $first = array_shift($movies);
    return count($first['times']) + countShowtimes($movies);
}

/**
 * Adds a 'late_times' list to each movie (shows starting at or after
 * $cutoffHour, default 9 PM).
 * CALL BY REFERENCE: the & means we change the caller's actual array
 * instead of a copy, so nothing needs to be returned.
 */
function markLateShows(array &$movies, $cutoffHour = 21) {
    foreach ($movies as &$movie) {          // & lets us edit each movie in place
        $movie['late_times'] = [];
        foreach ($movie['times'] as $time) {
            if ((int) date('G', strtotime($time)) >= $cutoffHour) {
                $movie['late_times'][] = $time;
            }
        }
    }
    unset($movie);   // break the reference left over from the loop
}

/**
 * Form-generation function: returns a label plus an input or textarea.
 * DEFAULT PARAMETERS: $type defaults to "text", $value to empty.
 * Output is escaped with htmlspecialchars() to block injected HTML.
 */
function formField($label, $name, $type = 'text', $value = '') {
    $safeValue = htmlspecialchars($value);
    $html = '<label for="' . $name . '">' . $label . '</label>';

    if ($type === 'textarea') {
        $html .= '<textarea id="' . $name . '" name="' . $name . '" rows="5">'
               . $safeValue . '</textarea>';
    } else {
        $html .= '<input type="' . $type . '" id="' . $name . '" name="' . $name
               . '" value="' . $safeValue . '">';
    }

    return $html;
}
