<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package Kids Life Style BD
 */
get_header();
?>

<style>
    .error-404-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        text-align: center;
        position: relative;
        padding: 50px 20px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .error-404-container .error-code {
        font-size: 12rem;
        color: rgba(0, 0, 0, 0.05);
        font-weight: 900;
        position: absolute;
        top: 80px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 0;
    }

    .error-404-container .error-title {
        font-size: 3rem;
        color: #2e7d32;
        font-weight: bold;
        z-index: 1;
        margin-top: 140px;
    }

    .error-404-container .error-subtitle {
        font-size: 1.5rem;
        font-weight: 600;
        margin-top: 2rem;
        z-index: 1;
    }

    .error-404-container .error-description {
        color: #666;
        margin-bottom: 2rem;
        z-index: 1;
    }

    .error-404-container .search-form-wrapper {
        max-width: 400px;
        width: 100%;
        margin: 0 auto;
        z-index: 1;
    }

    .error-404-container form {
        display: flex;
        border: 1px solid #ccc;
        border-radius: 5px;
        overflow: hidden;
    }

    .error-404-container input[type="search"] {
        padding: 12px 15px;
        flex-grow: 1;
        border: none;
        outline: none;
        font-size: 1rem;
    }

    .error-404-container button {
        background-color: #2e7d32;
        color: #fff;
        padding: 0 15px;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
    }

    .error-404-container button:hover {
        background-color: #256428;
    }

    .error-404-container svg {
        fill: white;
    }
</style>

<main class="error-404-container">
    <div class="error-code">404</div>
    <div class="error-title">NOT FOUND</div>
    <div class="error-subtitle">This is somewhat embarrassing, isn’t it?</div>
    <div class="error-description">It looks like nothing was found at this location. Maybe try a search in blogs?</div>

    <div class="search-form-wrapper">
        <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
            <input type="search" name="s" placeholder="Search for blogs" required />
            <button type="submit" aria-label="Search">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                    <path
                        d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.38 5.37-1.41 1.42-5.38-5.38zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z" />
                </svg>
            </button>
        </form>
    </div>
</main>

<?php get_footer(); ?>
