<div class="container flex justify-between py-4 gap-6 md:py-3">
    <div class="flex items-center gap-x-12 xl:gap-x-24">
        <div class="block font-barlow font-bold text-black text-md  md:text-xs">
            <div 
                class="block max-w-24 md:max-w-40 header-logo-img"
                >
                <?php the_custom_logo(); ?>
            </div>
        </div>

        <!-- Search bar -->
        <div class="hidden lg:block">
            <div class="relative flex items-center border border-[#D0D5DD] rounded-lg">
                <svg class="absolute top-1/2 left-3 -translate-y-1/2" width="12" height="12" xmlns="http://www.w3.org/2000/svg" fill="none" aria-hidden="true">
                    <path d="M10.8999 10.9167L8.98789 9.00468M10.3536 5.72685C10.3536 8.29143 8.27459 10.3704 5.71 10.3704C3.14541 10.3704 1.06641 8.29143 1.06641 5.72685C1.06641 3.16226 3.14541 1.08325 5.71 1.08325C8.27459 1.08325 10.3536 3.16226 10.3536 5.72685Z" stroke="#080404" stroke-opacity="0.3" stroke-width="1.09261" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <form class="w-full relative header-form-cover" role="search" method="get" action="<?php echo home_url('/shop/'); ?>">
                    <label for="topbar-search" class="sr-only">Search site</label>
                    <input id="topbar-search" type="search" name="search" placeholder="Search" autocomplete="off" class="header-search-input bg-transparent border-[#D0D5DD] py-2 pl-9 pr-4 focus:outline-none focus:ring-2 focus:ring-primary-700 rounded-lg w-full text-sm min-w-[320px] xl:min-w-[420px] max-w-[100%]">
                    <div class="header-result-cover absolute z-50 bg-white w-full top-[100%] mt-2 hidden shadow rounded-lg max-h-96 overflow-auto">
                        <ul class="header-result-list"></ul>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="flex items-center gap-7">
        <!-- Phone Number -->
        <div>
            <span>Water Berry - 
                <?php 
                $link = get_field('phone_number','option');
                if( $link ): 
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>
                    <a class="text-black hover:underline hidden lg:block font-medium" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                <?php endif; ?>
            </span>
        <span>Milford - 
                <?php 
                $link = get_field('phone_number_milford','option');
                if( $link ): 
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>
                    <a class="text-black hover:underline hidden lg:block font-medium" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                <?php endif; ?>
            </span>
        </div>
        <div class="flex items-center gap-2">
            <div class="has-cart">
                <?php
                    $cart_count = WC()->cart->get_cart_contents_count();
                ?>
                <a class="cart-btn btn relative" id="cart-button" href="javascript:;">CART
                    <?php if($cart_count == 0){}else{ ?>
                    <span id="cart-count" class="font-inter cart-count absolute top-[7px] left-[10px] bg-primary h-3 w-3 !flex items-center justify-center tracking-[0em] text-white text-[8px] rounded-full">
                        <?= $cart_count; ?>
                    </span>
                    <?php } ?>
                </a>
            </div>
            
            <?php if ( is_user_logged_in() ) : ?>
                <div class="has-sign-in">
                    <a class="myaccount-btn btn btn-red" href="<?php echo site_url(); ?>/my-account/">My Account</a>
                </div>
            <?php else : ?>
                <div class="has-sign-in">
                    <a class="sign-btn btn" href="<?php echo site_url(); ?>/my-account/" >SIGN IN</a>
                </div>
            <?php endif; ?>
            
        </div>
    </div>
</div>
<div class="bg-black">
    <div class="container">
        <div class="mobile-humberger text-white text-sm font-medium lg:hidden py-5 md:py-8 flex items-center justify-center gap-3">
            <span>Menu</span>
            <img src="<?php echo site_url(); ?>/wp-content/uploads/2025/05/humberger.svg" alt="">
        </div>
        <div class="lg:block hidden font-medium">
            <?php
                wp_nav_menu( array(
                    'menu'           => 'Header Menu',
                    'menu_class'     => 'flex justify-between items-center gap-x-4 py-5 text-white text-sm',
                    'container'      => false,
                    'menu_id' => 'menu-header-menu',
                ) );
            ?>
        </div>
    </div>
</div>
