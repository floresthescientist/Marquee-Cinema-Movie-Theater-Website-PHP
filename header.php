<?php
/**
 * header.php
 * ------------------------------------------------------------
 * Shared header included at the top of every page.
 * Contains: <head> section, site logo/title, and navigation bar.
 *
 * Each page should, BEFORE including this file:
 *   - require_once 'functions.php' and 'data.php'
 *   - set $pageTitle   (text shown in the browser tab)
 *   - set $currentPage (used to highlight the active nav link)
 * ------------------------------------------------------------
 */

// Import the namespaced function this file uses
use function Marquee\theaterName;

// Set the time zone so date() shows local (Eastern) time.
// Without this, XAMPP may default to Europe/Berlin and show the wrong greeting.
date_default_timezone_set('America/New_York');

// Fallback values in case a page forgets to set them
if (!isset($pageTitle))   { $pageTitle = theaterName(); }
if (!isset($currentPage)) { $currentPage = ""; }

// Navigation links stored in an array so we can loop through them
// (adding a new page only requires adding one line here)
$navLinks = [
    "home"      => ["label" => "Home",      "url" => "index.php"],
    "showtimes" => ["label" => "Showtimes", "url" => "showtimes.php"],
    "contact"   => ["label" => "Contact",   "url" => "contact.php"],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?> | <?php echo theaterName(); ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- ===== SITE HEADER ===== -->
<header class="site-header">
    <div class="container header-inner">

        <!-- Logo / site title -->
        <a href="index.php" class="logo">
            <span class="logo-icon">🎬</span>
            <span class="logo-text">Marquee<span class="accent">Cinema</span></span>
        </a>

        <!-- Hamburger button (only visible on small screens) -->
        <button class="nav-toggle" id="navToggle" aria-label="Toggle menu">☰</button>

        <!-- Navigation bar built from the $navLinks array -->
        <nav class="main-nav" id="mainNav">
            <ul>
                <?php foreach ($navLinks as $key => $link): ?>
                    <li>
                        <a href="<?php echo $link['url']; ?>"
                           class="<?php echo ($key === $currentPage) ? 'active' : ''; ?>">
                            <?php echo $link['label']; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>
</header>

<!-- ===== MAIN CONTENT (each page fills this in) ===== -->
<main class="container">
