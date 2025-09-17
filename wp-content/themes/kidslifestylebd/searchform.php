<form role="search" method="get" id="searchform" class="d-flex mb-2" action="<?php echo esc_url(home_url('/')); ?>">
    <input type="search" class="form-control me-2"
        placeholder="Search"
        value="<?php echo get_search_query(); ?>"
        name="s"
        id="s"
        required>

    <button type="submit" class="">
        <svg class="icon icon-search" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M5.92188 10.0183C5.92188 7.85883 7.67181 6.10889 9.83132 6.10889" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M10.7553 18.0273C15.326 17.6274 18.7071 13.598 18.3072 9.02731C17.9073 4.45663 13.8779 1.07553 9.3072 1.47541C4.73652 1.87529 1.35542 5.90473 1.7553 10.4754C2.15518 15.0461 6.18462 18.4272 10.7553 18.0273Z" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M15.6953 15.8826L17.65 17.8373" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
    </button>
</form>