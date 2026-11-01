<?php
/**
 * footer.php
 * ------------------------------------------------------------
 * Shared footer included at the bottom of every page.
 * Contains: closing </main>, copyright, contact links,
 * extra navigation, and the script for the mobile menu.
 * ------------------------------------------------------------
 */

// Import the namespaced function this file uses
use function Marquee\theaterName;
?>
</main>
<!-- ===== END MAIN CONTENT ===== -->

<!-- ===== SITE FOOTER ===== -->
<footer class="site-footer">
    <div class="container footer-grid">

        <!-- Column 1: About -->
        <div>
            <h4><?php echo theaterName(); ?></h4>
            <p>Big screens, bigger stories. Serving movie lovers since 1998.</p>
        </div>

        <!-- Column 2: Additional navigation -->
        <div>
            <h4>Quick Links</h4>
            <ul>
                <li><a href="index.php">Now Showing</a></li>
                <li><a href="showtimes.php">Showtimes</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>
        </div>

        <!-- Column 3: Contact info -->
        <div>
            <h4>Contact</h4>
            <ul>
                <li>📍 333 Broadway, Gotham</li>
                <li>📞 <a href="tel:9143171169">(914) 317-1169</a></li>
                <li>✉️ <a href="mailto:floresadonis333@gmail.com">floresadonis333@gmail.com</a></li>
            </ul>
        </div>
    </div>

    <!-- Copyright: date('Y') keeps the year current automatically -->
    <p class="copyright">
        &copy; <?php echo date('Y'); ?> <?php echo theaterName(); ?>. All rights reserved.
    </p>
</footer>

<!-- Toggles the navigation menu on small screens -->
<script>
    document.getElementById('navToggle').addEventListener('click', function () {
        document.getElementById('mainNav').classList.toggle('open');
    });
</script>

</body>
</html>
