<div class="container flex justify-between py-4 gap-6 md:py-3">
    <div class="flex items-center gap-x-24">
        <div class="block font-barlow font-bold text-black text-md  md:text-xs">
            <a 
                class="block max-w-40 md:max-w-20"
                href="<?php echo esc_url( home_url( '/' ) ); ?>" 
                >
                <?php the_custom_logo(); ?>
            </a>
        </div>

        <!-- Search bar -->
        <div class="hidden lg:block">
            <div class="relative flex items-center border border-alt-200 rounded-lg">
                <svg class="absolute top-1/2 left-3 -translate-y-1/2" width="12" height="12" xmlns="http://www.w3.org/2000/svg" fill="none" aria-hidden="true">
                    <path d="M10.8999 10.9167L8.98789 9.00468M10.3536 5.72685C10.3536 8.29143 8.27459 10.3704 5.71 10.3704C3.14541 10.3704 1.06641 8.29143 1.06641 5.72685C1.06641 3.16226 3.14541 1.08325 5.71 1.08325C8.27459 1.08325 10.3536 3.16226 10.3536 5.72685Z" stroke="#080404" stroke-opacity="0.3" stroke-width="1.09261" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <form class="w-full" role="search" method="get" action="/">
                    <label for="topbar-search" class="sr-only">Search site</label>
                    <input id="topbar-search" type="search" name="s" placeholder="Search" autocomplete="off" class="bg-transparent py-2 pl-9 pr-4 focus:outline-none focus:ring-2 focus:ring-primary-700 rounded-lg w-full text-sm min-w-[320px] xl:min-w-[420px] max-w-[100%]">
                </form>
            </div>
        </div>
    </div>

    <div class="flex items-center gap-7">
        <!-- Phone Number -->
        <a href="tel:2035874132" class="text-black hover:underline hidden lg:block" itemprop="telephone" aria-label="Call us at 203-587-4132">203-587-4132</a>
        <div class="flex items-center gap-2">
            <div class="has-cart">
                <a class="cart-btn btn" href="">CART</a>
            </div>
            <div class="has-sign-in">
                <a class="sign-btn btn" href="">SIGN IN</a>
            </div>
        </div>
    </div>
</div>
<div class="bg-black md:overflow-x-hidden ">
    <div class="container">
        <div class="mobile-humberger text-white text-sm font-medium lg:hidden py-8 flex items-center justify-center gap-3">
            <span>Menu</span>
            <img src="<?php echo site_url(); ?>/wp-content/uploads/2025/05/humberger.svg" alt="">
        </div>
        <div class="lg:block hidden font-medium">
            <?php
                wp_nav_menu( array(
                    'menu'           => 'Header Menu',
                    'menu_class'     => 'flex justify-between items-center gap-x-4 py-5 text-white',
                    'container'      => false,
                ) );
            ?>
        </div>
    </div>
</div>