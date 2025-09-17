<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Kids Life Style BD
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php
    $topbar_email = get_theme_mod('stit_topbar_email');
    $topbar_phone = get_theme_mod('stit_topbar_phone');
    ?>
    <header>
        <div class="top-header d-none d-md-block d-lg-block py-2 border-bottom">
            <div class="container d-flex flex-column flex-lg-row justify-content-between align-items-center small">
                <?php if ($topbar_email || $topbar_phone) : ?>
                    <div class="d-flex flex-column flex-lg-row flex-md-row gap-3 mb-3 mb-lg-0">
                        <?php if ($topbar_email) : ?>
                            <a href="mailto:<?php echo esc_attr($topbar_email); ?>" class="text-decoration-none d-flex align-items-center">
                                <svg class="me-2" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_1174_850)">
                                        <path d="M24 16.5518C23.9516 16.8595 23.9154 17.1705 23.852 17.4754C23.368 19.8132 21.5622 21.547 19.2282 21.9113C18.9129 21.9603 18.592 21.9943 18.2734 21.9948C14.0838 22.0005 9.89426 22.0019 5.70422 21.9972C3.02535 21.9943 0.791009 20.2454 0.172159 17.6523C0.064083 17.1993 0.0128645 16.7222 0.0100452 16.256C-0.00546131 13.7515 0.00111719 11.2467 0.00299677 8.74227C0.00534624 5.95189 1.8431 3.67919 4.56567 3.11668C4.93735 3.03976 5.32501 3.00673 5.70516 3.00626C9.89473 2.9987 14.0843 2.9987 18.2743 3.00248C21.0519 3.00484 23.3144 4.86226 23.8717 7.59224C23.9295 7.87443 23.9577 8.1623 24 8.4478V16.5518ZM11.9848 20.1515C14.1186 20.1515 16.2524 20.153 18.3862 20.1496C18.5958 20.1496 18.8072 20.1322 19.0144 20.1015C20.7408 19.8472 22.1383 18.2318 22.1406 16.4811C22.1449 13.8275 22.1425 11.1735 22.1397 8.52C22.1397 8.35672 22.1214 8.19156 22.0955 8.02969C21.8014 6.18596 20.2441 4.84905 18.3876 4.84858C14.12 4.84716 9.85244 4.8481 5.58439 4.84858C5.45141 4.84858 5.31749 4.84291 5.18593 4.85754C3.29742 5.06518 1.84216 6.69326 1.84075 8.6007C1.83887 11.1995 1.83887 13.7983 1.84075 16.3971C1.84216 18.4682 3.5178 20.1492 5.58205 20.1515C7.71583 20.1539 9.84962 20.152 11.9834 20.152L11.9848 20.1515Z" fill="currentcolor"></path>
                                        <path d="M12.4222 13.9969C11.3295 14.037 10.0621 13.6906 8.95112 12.898C7.44568 11.8236 5.95127 10.7358 4.45303 9.65208C3.93282 9.27538 3.85267 8.7266 4.25387 8.32359C4.59652 7.97988 5.10953 7.94822 5.54576 8.25984C6.44365 8.90135 7.33578 9.55 8.23031 10.196C8.81003 10.6146 9.39023 11.0318 9.9685 11.4518C11.4706 12.5418 13.3484 12.5485 14.8721 11.4674C16.3747 10.4015 17.8768 9.33512 19.3784 8.26742C19.6313 8.08731 19.8919 7.94956 20.2326 8.01777C20.6136 8.094 20.8584 8.30085 20.9615 8.64457C21.0695 9.00433 20.9462 9.30971 20.6405 9.53439C20.0214 9.98956 19.3899 10.4305 18.7622 10.8758C17.8432 11.5285 16.9246 12.1816 16.0032 12.8316C14.9532 13.5725 14.0433 13.8886 12.4217 13.9964L12.4222 13.9969Z" fill="currentcolor"></path>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_1174_850">
                                            <rect width="24" height="24" fill="white"></rect>
                                        </clipPath>
                                    </defs>
                                </svg>
                                <span class="fw-semibold"><?php echo esc_html($topbar_email); ?></span>
                            </a>
                        <?php endif; ?>
                        <?php if ($topbar_phone) : ?>
                            <a href="tel:<?php echo esc_attr($topbar_phone); ?>" class="text-decoration-none d-flex align-items-center">
                                <svg class="me-2" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_1174_840)">
                                        <path d="M15.0822 24C14.8287 23.9662 14.5757 23.9276 14.3218 23.8999C12.6453 23.7146 11.0769 23.1772 9.61061 22.3672C6.0671 20.4104 3.33811 17.6384 1.44809 14.0563C0.751145 12.7357 0.278521 11.329 0.0904123 9.84471C-0.313552 6.65944 0.63828 3.92175 2.90358 1.65234C3.35269 1.2024 3.83895 0.754818 4.38541 0.441698C5.73462 -0.33076 7.37493 -0.0641844 8.48336 1.03926C9.04863 1.60203 9.60308 2.17655 10.142 2.76424C11.7522 4.52119 11.1855 7.22409 9.01007 8.20482C8.71097 8.33976 8.41564 8.48268 8.11326 8.60915C7.32038 8.94108 6.83177 9.97259 7.06455 10.8875C7.26395 11.6708 7.66321 12.3454 8.15841 12.9651C9.21793 14.2909 10.3903 15.5025 11.8369 16.4141C12.4115 16.7761 13.0304 17.0441 13.7344 16.9774C14.4281 16.9115 14.9891 16.6031 15.3334 15.9811C15.5106 15.6614 15.6498 15.3191 15.7942 14.9825C16.7282 12.8052 19.5211 12.219 21.2475 13.8433C21.7883 14.3525 22.3164 14.8758 22.8507 15.3915C23.4808 16.0004 23.8655 16.7291 23.9445 17.6097C23.9492 17.6605 23.9807 17.7094 24 17.7588V18.1339C23.9802 18.1913 23.9478 18.2477 23.9426 18.3065C23.8951 18.8627 23.7282 19.3841 23.4023 19.8321C23.114 20.2285 22.789 20.6027 22.4467 20.9539C20.8534 22.5872 18.9544 23.6309 16.6623 23.8984C16.4164 23.9271 16.1718 23.9657 15.9268 23.9995H15.0822V24ZM15.4815 22.1485C15.4852 22.1692 15.489 22.1899 15.4923 22.2111C16.13 22.1142 16.7785 22.062 17.403 21.9121C19.1487 21.4922 20.5148 20.4687 21.6656 19.1269C22.3587 18.3187 22.3169 17.4118 21.5518 16.6671C21.0528 16.1819 20.5524 15.6981 20.0511 15.2157C19.1948 14.3911 17.9156 14.6506 17.4458 15.7399C17.2944 16.0911 17.1279 16.4357 16.9699 16.7841C16.3835 18.0752 14.5405 19.086 12.8846 18.755C12.1063 18.5994 11.3859 18.3098 10.7336 17.8697C8.90379 16.636 7.37305 15.0958 6.14893 13.2608C5.67349 12.5485 5.36123 11.7639 5.22673 10.904C4.9803 9.33177 5.92414 7.64111 7.12522 7.07928C7.50002 6.90392 7.87295 6.72526 8.24964 6.55506C9.32421 6.07128 9.58051 4.81645 8.77164 3.95607C8.2628 3.41493 7.74692 2.88037 7.22538 2.35145C6.56935 1.68619 5.6227 1.63353 4.92575 2.25178C4.471 2.65517 4.02706 3.08018 3.63486 3.54375C2.44789 4.94621 1.83089 6.56729 1.8229 8.41874C1.81678 9.87574 2.14268 11.2589 2.75686 12.5622C4.58339 16.4372 7.44171 19.3112 11.3003 21.1702C12.6128 21.8025 14.0095 22.1565 15.481 22.1485H15.4815Z" fill="currentcolor"></path>
                                        <path d="M23.9995 5.68712C23.9521 5.98822 23.9166 6.29209 23.8549 6.59042C23.381 8.88052 21.6144 10.5717 19.3255 10.9328C16.3384 11.4043 13.5332 9.34371 13.0671 6.36044C12.6098 3.43165 14.534 0.643262 17.4787 0.0950968C20.5851 -0.483086 23.4345 1.64261 23.8968 4.6402C23.9318 4.86603 23.9655 5.09231 24 5.31814V5.68666L23.9995 5.68712ZM18.491 1.79686C16.4729 1.74837 14.79 3.47922 14.778 5.47746C14.7656 7.51449 16.4636 9.2084 18.4642 9.2181C20.4906 9.2278 22.1818 7.52881 22.1887 5.51579C22.196 3.49215 20.5049 1.75576 18.491 1.79686Z" fill="currentcolor"></path>
                                        <path d="M18.7305 4.96983C18.8959 4.96983 19.0274 4.9584 19.1571 4.97191C19.6322 5.02022 19.9869 5.4135 19.9997 5.9481C20.0111 6.43333 19.7363 6.9274 19.2603 6.96585C18.7587 7.00585 18.2492 7.01832 17.7503 6.96117C17.2875 6.90818 17.0175 6.49464 17.0083 5.94446C16.9977 5.31479 16.9968 4.68461 17.0083 4.05494C17.0193 3.45749 17.419 2.98628 17.8782 3.00031C18.3418 3.01433 18.7106 3.46476 18.7287 4.05338C18.738 4.34484 18.7305 4.63681 18.7305 4.97087V4.96983Z" fill="currentcolor"></path>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_1174_840">
                                            <rect width="24" height="24" fill="white"></rect>
                                        </clipPath>
                                    </defs>
                                </svg>
                                <span class="fw-semibold"><?php echo esc_html($topbar_phone); ?></span>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <div class="d-flex gap-3">
                    <?php if (get_theme_mod('stit_twitter_link')) : ?>
                        <a href="<?php echo esc_url(get_theme_mod('stit_twitter_link')); ?>" target="_blank">
                            <svg width="19" height="18" viewBox="0 0 19 18" fill="currentColor" class="icon icon-twitter" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.0462914 0L7.3819 9.92811L0 18H1.66179L8.1253 10.9338L13.3464 18H19L11.2522 7.51415L18.1236 0.00146392H16.4618L10.5102 6.50992L5.70131 0.00146392H0.0477214L0.0462914 0ZM2.48907 1.23845H5.08663L16.5558 16.7601H13.9582L2.48907 1.23845Z" fill="currentColor"></path>
                            </svg>
                        </a>
                    <?php endif; ?>

                    <?php if (get_theme_mod('stit_facebook_link')) : ?>
                        <a href="<?php echo esc_url(get_theme_mod('stit_facebook_link')); ?>" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" preserveAspectRatio="xMidYMid" width="20px" height="20px" viewBox="0 0 14.906 32" class="icon">
                                <path d="M14.874,11.167 L14.262,14.207 C14.062,15.208 13.100,15.992 12.072,15.992 L10.000,15.992 L10.000,30.000 C10.000,31.104 9.159,32.000 8.049,32.000 L5.030,32.000 C3.920,32.000 3.017,31.102 3.017,29.999 L3.017,15.992 L2.011,15.992 C0.901,15.992 -0.002,15.095 -0.002,13.991 L-0.002,10.990 C-0.002,9.887 0.901,8.989 2.011,8.989 L3.017,8.989 L3.017,6.003 C3.017,2.716 5.693,0.041 8.994,0.013 C9.015,0.012 9.033,0.001 9.055,0.001 L13.081,0.001 C13.636,0.001 14.000,0.448 14.000,1.000 L14.000,6.000 C14.000,6.553 13.636,7.004 13.081,7.004 L10.061,7.004 L10.060,8.989 L13.079,8.989 C13.645,8.989 14.167,9.228 14.509,9.644 C14.852,10.059 14.985,10.615 14.874,11.167 ZM9.092,10.990 C9.078,10.991 9.067,10.998 9.053,10.998 L9.053,10.998 C8.497,10.997 8.046,10.549 8.047,9.997 L8.047,9.990 C8.047,9.990 8.047,9.990 8.047,9.990 C8.047,9.990 8.047,9.990 8.047,9.990 L8.049,6.003 C8.049,5.450 8.499,5.003 9.055,5.003 L12.074,5.003 L12.074,2.002 L9.094,2.002 C9.077,2.002 9.063,2.011 9.045,2.011 C6.831,2.011 5.030,3.802 5.030,6.003 L5.030,10.005 C5.030,10.558 4.579,11.006 4.023,11.006 C3.996,11.006 3.973,10.992 3.946,10.990 L2.011,10.990 L2.011,13.991 L4.023,13.991 C4.579,13.991 5.030,14.439 5.030,14.992 C5.030,15.044 5.008,15.088 5.000,15.138 L5.000,30.000 L8.049,29.999 L8.049,15.002 C8.049,14.998 8.047,14.995 8.047,14.992 C8.047,14.439 8.497,13.991 9.053,13.991 L12.072,13.991 C12.145,13.991 12.275,13.886 12.288,13.816 L12.857,10.990 L9.092,10.990 Z" fill="currentColor"></path>
                            </svg>
                        </a>
                    <?php endif; ?>

                    <?php if (get_theme_mod('stit_pinterest_link')) : ?>
                        <a href="<?php echo esc_url(get_theme_mod('stit_pinterest_link')); ?>" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="22px" height="22px" class="icon" viewBox="0 0 48 48" version="1.1" id="Shopicons" x="0" y="0" xml:space="preserve">
                                <path d="M24 4C12.972 4 4 12.972 4 24s8.972 20 20 20 20-8.972 20-20S35.028 4 24 4zm0 36c-1.314 0-2.584-.177-3.806-.477l1.722-6.545c.14.167.287.326.443.479 1.678 1.64 4.144 2.183 6.594 1.451C33.102 33.671 36 29.185 36 24c0-6.617-5.383-12-12-12-6.51 0-10.005 3.922-11.02 7.281-1.534 5.078 1.324 8.798 1.446 8.954l3.158-2.455c-.069-.092-1.694-2.303-.776-5.343C17.428 18.391 19.682 16 24 16c4.411 0 8 3.589 8 8 0 2.895-1.439 6.255-4.19 7.075-.389.115-1.731.423-2.655-.479-.62-.605-1.861-2.626-.382-8.471l.162-.616-3.864-1.035c-.059.217-.115.433-.17.645l-4.467 16.974C11.418 35.388 8 30.086 8 24c0-8.822 7.178-16 16-16s16 7.178 16 16-7.178 16-16 16z" fill="currentColor"></path>
                            </svg>
                        </a>
                    <?php endif; ?>
                    
                    <?php if (get_theme_mod('stit_linkedin_link')) : ?>
                        <a href="<?php echo esc_url(get_theme_mod('stit_linkedin_link')); ?>" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"><path d="M3 9.4c0-2.24 0-3.36.436-4.216a4 4 0 0 1 1.748-1.748C6.04 3 7.16 3 9.4 3h5.2c2.24 0 3.36 0 4.216.436a4 4 0 0 1 1.748 1.748C21 6.04 21 7.16 21 9.4v5.2c0 2.24 0 3.36-.436 4.216a4 4 0 0 1-1.748 1.748C17.96 21 16.84 21 14.6 21H9.4c-2.24 0-3.36 0-4.216-.436a4 4 0 0 1-1.748-1.748C3 17.96 3 16.84 3 14.6zm5-1.775v.5"/><path d="M8 16.375V10.75m4 5.625V13.5m0 0v-2.75m0 2.75c0-1.288 1.222-2 2.4-2c1.6 0 1.6 1.375 1.6 2.875v2"/></g></svg>
                        </a>
                    <?php endif; ?>

                    <?php if (get_theme_mod('stit_instagram_link')) : ?>
                        <a href="<?php echo esc_url(get_theme_mod('stit_instagram_link')); ?>" target="_blank">
                            <svg aria-hidden="true" fill="currentColor" width="20px" height="20px" focusable="false" role="presentation" class="icon icon-instagram" viewBox="0 0 18 18">
                                <path fill="currentColor" d="M8.77 1.58c2.34 0 2.62.01 3.54.05.86.04 1.32.18 1.63.3.41.17.7.35 1.01.66.3.3.5.6.65 1 .12.32.27.78.3 1.64.05.92.06 1.2.06 3.54s-.01 2.62-.05 3.54a4.79 4.79 0 01-.3 1.63c-.17.41-.35.7-.66 1.01-.3.3-.6.5-1.01.66-.31.12-.77.26-1.63.3-.92.04-1.2.05-3.54.05s-2.62 0-3.55-.05a4.79 4.79 0 01-1.62-.3c-.42-.16-.7-.35-1.01-.66-.31-.3-.5-.6-.66-1a4.87 4.87 0 01-.3-1.64c-.04-.92-.05-1.2-.05-3.54s0-2.62.05-3.54c.04-.86.18-1.32.3-1.63.16-.41.35-.7.66-1.01.3-.3.6-.5 1-.65.32-.12.78-.27 1.63-.3.93-.05 1.2-.06 3.55-.06zm0-1.58C6.39 0 6.09.01 5.15.05c-.93.04-1.57.2-2.13.4-.57.23-1.06.54-1.55 1.02C1 1.96.7 2.45.46 3.02c-.22.56-.37 1.2-.4 2.13C0 6.1 0 6.4 0 8.77s.01 2.68.05 3.61c.04.94.2 1.57.4 2.13.23.58.54 1.07 1.02 1.56.49.48.98.78 1.55 1.01.56.22 1.2.37 2.13.4.94.05 1.24.06 3.62.06 2.39 0 2.68-.01 3.62-.05.93-.04 1.57-.2 2.13-.41a4.27 4.27 0 001.55-1.01c.49-.49.79-.98 1.01-1.56.22-.55.37-1.19.41-2.13.04-.93.05-1.23.05-3.61 0-2.39 0-2.68-.05-3.62a6.47 6.47 0 00-.4-2.13 4.27 4.27 0 00-1.02-1.55A4.35 4.35 0 0014.52.46a6.43 6.43 0 00-2.13-.41A69 69 0 008.77 0z"></path>
                                <path fill="currentColor" d="M8.8 4a4.5 4.5 0 100 9 4.5 4.5 0 000-9zm0 7.43a2.92 2.92 0 110-5.85 2.92 2.92 0 010 5.85zM13.43 5a1.05 1.05 0 100-2.1 1.05 1.05 0 000 2.1z">
                                </path>
                            </svg>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div id="navbar" class="bottom-nav">
            <nav class="navbar-dark navbar position-relative">
                <div class="container">
                    <div class="d-flex d-lg-none align-items-center w-100 justify-content-between">
                        <div class="d-flex align-items-center">
                            <button class="hamburger me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list fs-2" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                                </svg>
                            </button>
                            <a href="<?php echo home_url(); ?>" class="navbar-brand brand-text text-dark mb-0">
                                <?php
                                $logo_id_or_url = get_theme_mod('stit_logo');
                                if ($logo_id_or_url && (is_numeric($logo_id_or_url) || filter_var($logo_id_or_url, FILTER_VALIDATE_URL))) {
                                ?>
                                    <img src="<?php
                                                if (is_numeric($logo_id_or_url)) {
                                                    echo wp_get_attachment_url($logo_id_or_url);
                                                } else {
                                                    echo esc_url($logo_id_or_url);
                                                }
                                                ?>" alt="Main Logo" loading="lazy" decoding="async">
                                <?php } ?>
                            </a>
                        </div>
                        <ul class="right-icons d-flex align-items-center gap-3 list-unstyled">
                            <li>
                                <a href="#" class="icon-link">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.92188 10.0183C5.92188 7.85883 7.67181 6.10889 9.83132 6.10889" stroke="currentcolor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M10.7553 18.0273C15.326 17.6274 18.7071 13.598 18.3072 9.02731C17.9073 4.45663 13.8779 1.07553 9.3072 1.47541C4.73652 1.87529 1.35542 5.90473 1.7553 10.4754C2.15518 15.0461 6.18462 18.4272 10.7553 18.0273Z" stroke="currentcolor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M15.6953 15.8826L17.65 17.8373" stroke="currentcolor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </a>
                            </li>
                            <li class="d-none d-md-block d-lg-block">
                                <a href="#" class="icon-link">
                                    <svg width="22" height="21" viewBox="0 0 22 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.74634 7.57388C1.36639 4.80307 3.14298 2.06756 5.92221 1.77812C8.01895 1.55928 9.87646 2.70291 10.7173 4.43246C10.9178 4.84544 11.4736 4.84544 11.6742 4.43246C12.515 2.70291 14.3725 1.55928 16.4692 1.77812C19.2484 2.06756 21.0215 4.80307 20.6451 7.57388C19.7621 14.0368 11.1957 19.7513 11.1957 19.7513C11.1957 19.7513 2.62936 14.0368 1.74634 7.57388Z" stroke="currentcolor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="icon-link">
                                    <svg width="17" height="21" viewBox="0 0 17 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.3166 19.7513H3.40213C2.21719 19.7513 1.27974 18.7663 1.36473 17.6088L2.28218 6.66884C2.32468 6.15134 2.75966 5.75134 3.27963 5.75134H13.4391C13.9591 5.75134 14.3916 6.14884 14.4366 6.66884L15.354 17.6088C15.439 18.7663 14.5016 19.7513 13.3166 19.7513Z" stroke="currentcolor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M5.35938 8.75134V3.75134C5.35938 2.64634 6.25437 1.75134 7.35938 1.75134H9.35938C10.4644 1.75134 11.3594 2.64634 11.3594 3.75134V8.75134" stroke="currentcolor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </a>
                            </li>
                            <li class="d-none d-md-block d-lg-block">
                                <a href="#" class="icon-link">
                                    <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.0234 19.7513C14.994 19.7513 19.0234 15.7219 19.0234 10.7513C19.0234 5.78078 14.994 1.75134 10.0234 1.75134C5.05288 1.75134 1.02344 5.78078 1.02344 10.7513C1.02344 15.7219 5.05288 19.7513 10.0234 19.7513Z" stroke="currentcolor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M10.0227 11.5695C11.8302 11.5695 13.2955 10.1043 13.2955 8.29678C13.2955 6.4893 11.8302 5.02405 10.0227 5.02405C8.21525 5.02405 6.75 6.4893 6.75 8.29678C6.75 10.1043 8.21525 11.5695 10.0227 11.5695Z" stroke="currentcolor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M15.7447 17.7005C15.592 13.4687 13.092 11.5696 10.0247 11.5696C6.95741 11.5696 4.45741 13.4687 4.30469 17.7005" stroke="currentcolor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Desktop layout -->
                    <div class="d-none desktop-nav d-lg-flex w-100 align-items-center justify-content-between">
                        <?php
                        wp_nav_menu(array(
                            'theme_location'  => 'main_menu',
                            'menu_class'      => 'navbar-nav flex-row gap-3'
                        ));
                        ?>
                        <a href="<?php echo home_url(); ?>" class="navbar-brand brand-text text-dark mb-0">
                            <?php
                            $logo_id_or_url = get_theme_mod('stit_logo');
                            if ($logo_id_or_url && (is_numeric($logo_id_or_url) || filter_var($logo_id_or_url, FILTER_VALIDATE_URL))) {
                            ?>
                                <img src="<?php
                                            if (is_numeric($logo_id_or_url)) {
                                                echo wp_get_attachment_url($logo_id_or_url);
                                            } else {
                                                echo esc_url($logo_id_or_url);
                                            }
                                            ?>" alt="Main Logo" loading="lazy" class="img-fluid" decoding="async">
                            <?php } ?>
                        </a>

                        <!-- Right icons -->
                        <ul class="right-icons d-flex align-items-center gap-3 list-unstyled">
                            <!-- <li>
                                <a href="#" class="icon-link">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.92188 10.0183C5.92188 7.85883 7.67181 6.10889 9.83132 6.10889" stroke="currentcolor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M10.7553 18.0273C15.326 17.6274 18.7071 13.598 18.3072 9.02731C17.9073 4.45663 13.8779 1.07553 9.3072 1.47541C4.73652 1.87529 1.35542 5.90473 1.7553 10.4754C2.15518 15.0461 6.18462 18.4272 10.7553 18.0273Z" stroke="currentcolor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M15.6953 15.8826L17.65 17.8373" stroke="currentcolor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </a>
                            </li> -->
                            <li>
                                <a href="<?php echo esc_url(get_permalink(get_option('tinvwl_wishlist_page'))); ?>" class="icon-link">
                                    <svg width="22" height="21" viewBox="0 0 22 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.74634 7.57388C1.36639 4.80307 3.14298 2.06756 5.92221 1.77812C8.01895 1.55928 9.87646 2.70291 10.7173 4.43246C10.9178 4.84544 11.4736 4.84544 11.6742 4.43246C12.515 2.70291 14.3725 1.55928 16.4692 1.77812C19.2484 2.06756 21.0215 4.80307 20.6451 7.57388C19.7621 14.0368 11.1957 19.7513 11.1957 19.7513C11.1957 19.7513 2.62936 14.0368 1.74634 7.57388Z" stroke="currentcolor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="icon-link">
                                    <svg width="17" height="21" viewBox="0 0 17 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.3166 19.7513H3.40213C2.21719 19.7513 1.27974 18.7663 1.36473 17.6088L2.28218 6.66884C2.32468 6.15134 2.75966 5.75134 3.27963 5.75134H13.4391C13.9591 5.75134 14.3916 6.14884 14.4366 6.66884L15.354 17.6088C15.439 18.7663 14.5016 19.7513 13.3166 19.7513Z" stroke="currentcolor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M5.35938 8.75134V3.75134C5.35938 2.64634 6.25437 1.75134 7.35938 1.75134H9.35938C10.4644 1.75134 11.3594 2.64634 11.3594 3.75134V8.75134" stroke="currentcolor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="icon-link">
                                    <svg width="22" height="22" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.0234 19.7513C14.994 19.7513 19.0234 15.7219 19.0234 10.7513C19.0234 5.78078 14.994 1.75134 10.0234 1.75134C5.05288 1.75134 1.02344 5.78078 1.02344 10.7513C1.02344 15.7219 5.05288 19.7513 10.0234 19.7513Z" stroke="currentcolor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M10.0227 11.5695C11.8302 11.5695 13.2955 10.1043 13.2955 8.29678C13.2955 6.4893 11.8302 5.02405 10.0227 5.02405C8.21525 5.02405 6.75 6.4893 6.75 8.29678C6.75 10.1043 8.21525 11.5695 10.0227 11.5695Z" stroke="currentcolor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M15.7447 17.7005C15.592 13.4687 13.092 11.5696 10.0247 11.5696C6.95741 11.5696 4.45741 13.4687 4.30469 17.7005" stroke="currentcolor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <!-- Offcanvas menu for mobile -->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
            <div class="offcanvas-header bg-main-color">
                <h5 class="offcanvas-title text-white" id="offcanvasMenuLabel">Menu</h5>
                <button type="button" class="btn-close text-light" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body">
                <ul class="navbar-nav">
                    <li><a href="index.html">Home</a></li>

                    <!-- Shop with collapsible mega menu -->
                    <li>
                        <a class="d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#shopMega" role="button" aria-expanded="false" aria-controls="shopMega">
                            Shop <i class="bi bi-plus"></i>
                        </a>
                        <div class="collapse" id="shopMega">
                            <div class="p-3 pb-0">
                                <div class="row">
                                    <!-- Column 1 -->
                                    <div class="col-6 mb-3">
                                        <h6 class="fw-bold">Category 1</h6>
                                        <ul>
                                            <li><a href="shop/baby-owl.html">Baby Owl</a></li>
                                            <li><a href="#">Item 2</a></li>
                                            <li><a href="#">Item 3</a></li>
                                        </ul>
                                    </div>
                                    <!-- Column 2 -->
                                    <div class="col-6 mb-3">
                                        <h6 class="fw-bold">Category 2</h6>
                                        <ul>
                                            <li><a href="#">Item 1</a></li>
                                            <li><a href="#">Item 2</a></li>
                                            <li><a href="#">Item 3</a></li>
                                        </ul>
                                    </div>
                                    <!-- Column 3 -->
                                    <div class="col-6 mb-3">
                                        <h6 class="fw-bold">Category 3</h6>
                                        <ul>
                                            <li><a href="#">Item 1</a></li>
                                            <li><a href="#">Item 2</a></li>
                                            <li><a href="#">Item 3</a></li>
                                        </ul>
                                    </div>
                                    <!-- Column 4 -->
                                    <div class="col-6 mb-3">
                                        <h6 class="fw-bold">Category 4</h6>
                                        <ul>
                                            <li><a href="#">Item 1</a></li>
                                            <li><a href="#">Item 2</a></li>
                                            <li><a href="#">Item 3</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li><a href="blogs.html">Blogs</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </div>
        </div>

    </header>