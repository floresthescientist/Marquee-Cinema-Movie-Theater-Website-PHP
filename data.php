<?php
/**
 * data.php
 * ------------------------------------------------------------
 * Site settings and movie data shared by every page.
 * Keeping it in one file means we only update movies in one place.
 * (In a later project this could come from a MySQL database.)
 * Helper functions live in functions.php.
 * ------------------------------------------------------------
 */

// Global variable read by theaterName() in functions.php (see "global" keyword)
$theaterName = "Marquee Cinema";

$movies = [
    [
        "title"    => "Starfall Protocol",
        "genre"    => "Sci-Fi / Action",
        "rating"   => "PG-13",
        "runtime"  => 128,
        "poster"   => "🚀",
        "summary"  => "A rookie pilot uncovers a secret that could end the war between two planets.",
        "times"    => ["12:30 PM", "3:45 PM", "7:00 PM", "10:15 PM"],
    ],
    [
        "title"    => "The Last Bakery on Elm",
        "genre"    => "Comedy / Drama",
        "rating"   => "PG",
        "runtime"  => 104,
        "poster"   => "🥐",
        "summary"  => "Three siblings fight to save their late grandmother's bakery from closing.",
        "times"    => ["11:00 AM", "1:50 PM", "4:30 PM", "7:20 PM"],
    ],
    [
        "title"    => "Hollow Creek",
        "genre"    => "Horror",
        "rating"   => "R",
        "runtime"  => 97,
        "poster"   => "🌲",
        "summary"  => "A camping trip turns terrifying when the forest starts whispering back.",
        "times"    => ["5:15 PM", "8:00 PM", "10:45 PM"],
    ],
    [
        "title"    => "Paws of Thunder",
        "genre"    => "Animated / Family",
        "rating"   => "G",
        "runtime"  => 92,
        "poster"   => "🐾",
        "summary"  => "A tiny dog with a big voice sets out to win the city's talent show.",
        "times"    => ["10:30 AM", "12:45 PM", "3:00 PM", "5:30 PM"],
    ],
];
