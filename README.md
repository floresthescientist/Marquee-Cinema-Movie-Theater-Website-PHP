# Marquee Cinema – PHP Header/Footer Assignment (CIS 344, Chapter 5)

A movie theater website built with PHP that uses a shared `header.php` and `footer.php`,
pulled into each content page with `include`.

## Files
| File | Purpose |
|------|---------|
| `header.php` | `<head>`, logo, nav bar (active link highlighted) |
| `footer.php` | Copyright (auto year), quick links, contact info, mobile-menu script |
| `functions.php` | Reusable functions in the `Marquee` namespace (Lesson 5 concepts) |
| `data.php` | Theater name + shared movie list |
| `index.php` | Home page: time-based greeting, Now Showing grid, promo |
| `showtimes.php` | Showtimes table with genre filter (`?genre=Horror`) |
| `contact.php` | Contact form with validation and thank-you message |
| `css/style.css` | Dark theater theme, hover effects, responsive layout |

## How to run
1. Copy the `marquee-cinema` folder into `xampp/htdocs/`.
2. Start **Apache** in the XAMPP Control Panel.
3. Open http://localhost/marquee-cinema/

## Lesson 5 concepts used
| Concept | Where |
|---------|-------|
| `require()` vs `include()` | Pages `require_once` functions/data, `include` header/footer |
| Defining functions | `functions.php` |
| Parameters + defaults | `getGreeting($hour = null)`, `renderMovieCard($movie, $showSummary = true)`, `formField(...)` |
| Scope (`global`, `static`) | `theaterName()`, screen counter in `renderMovieCard()` |
| Returning values | Every function in `functions.php` |
| Call by reference vs value | `markLateShows(&$movies)` vs `countShowtimes($movies)` |
| Recursion | `countShowtimes()` |
| Namespaces | `namespace Marquee;` + `use function Marquee\...` |
| Form generation function | `formField()` on the Contact page |
