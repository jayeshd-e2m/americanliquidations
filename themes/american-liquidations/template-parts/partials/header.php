<div class="container flex justify-between py-4 gap-1 md:flex-wrap md:py-3" aria-label="<?php echo esc_attr( __( 'Site branding and search', 'amliq' ) ); ?>">
    <div class="flex items-center gap-x-24">
        <a 
            class="block font-barlow font-bold text-secondary-700 text-md max-w-40 md:text-xs md:max-w-20 "
            href="<?php echo esc_url( home_url( '/' ) ); ?>" 
            >
            <?php echo esc_html( get_bloginfo( 'name' ) ); ?>
        </a>

        <!-- Search bar -->
        <div class="lg:hidden">
            <?php get_template_part( 'templates/partials/search-bar' ) ?>
        </div>
    </div>

    <div class="flex items-center gap-7">
        <!-- Phone Number -->
        <?php
        /**
         * Phone link with proper sanitization, accessibility, and WP coding standards.
         */
        $phone_number = '203-587-4132';
        $tel_href     = 'tel:' . esc_attr( preg_replace( '/\D+/', '', $phone_number ) );
        ?>
        <a
            href="<?php echo $tel_href; ?>" 
            class="text-secondary-700 hover:underline md:hidden" 
            itemprop="telephone" 
            aria-label="<?php echo esc_attr( sprintf( __( 'Call us at %s', 'amliq_theme' ), $phone_number ) ); ?>" 
            >
            <?php echo esc_html( $phone_number ); ?>
        </a>
        <div class="flex items-center gap-2">
            <?php 
                get_template_part(
                    'templates/partials/button',
                    '',
                    [
                        'text'  => __( 'CART', 'amliq' ),
                        'href'  => '#',
                        'class' => 'is-style-outline has-color-style-primary has-cart is-extra-small-on-md',
                        'link_class' => '',
                    ]
                );
            ?>
            <?php 
                get_template_part(
                    'templates/partials/button',
                    '',
                    [
                        'text'  => __( 'SIGN IN', 'amliq' ),
                        'href'  => '#',
                        'class' => 'is-style-fill has-color-style-primary has-user is-extra-small-on-md',
                        'link_class' => '',
                    ]
                );
            ?>
        </div>
    </div>
</div>
<div class="bg-secondary-700 md:overflow-x-hidden ">
    <div class="container">
        <button 
            class="hidden items-center py-6 w-fit mx-auto justify-center gap-2.5 lm:flex md:py-5"
            type="button"
            tabindex="0"
            aria-label="Open Mobile Menu"
            onclick="(function(cb){ cb.checked = !cb.checked; })(document.getElementById('amliq-mobile_nav__trigger'));"
        >
            <span class="font-inter text-white text-sm">Menu</span>
            <svg class="w-4 h-4" width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1.06592 7.96386C0.891188 7.96386 0.744825 7.90465 0.62683 7.78625C0.508835 7.66784 0.449632 7.52148 0.449221 7.34716C0.44881 7.17284 0.508013 7.02648 0.62683 6.90807C0.745647 6.78966 0.89201 6.73046 1.06592 6.73046H10.9331C11.1078 6.73046 11.2544 6.78966 11.3728 6.90807C11.4912 7.02648 11.5502 7.17284 11.5498 7.34716C11.5494 7.52148 11.4902 7.66805 11.3722 7.78686C11.2542 7.90568 11.1078 7.96468 10.9331 7.96386H1.06592ZM1.06592 4.88036C0.891188 4.88036 0.744825 4.82116 0.62683 4.70276C0.508835 4.58435 0.449632 4.43799 0.449221 4.26367C0.44881 4.08935 0.508013 3.94298 0.62683 3.82458C0.745647 3.70617 0.89201 3.64697 1.06592 3.64697H10.9331C11.1078 3.64697 11.2544 3.70617 11.3728 3.82458C11.4912 3.94298 11.5502 4.08935 11.5498 4.26367C11.5494 4.43799 11.4902 4.58456 11.3722 4.70337C11.2542 4.82219 11.1078 4.88119 10.9331 4.88036H1.06592ZM1.06592 1.79687C0.891188 1.79687 0.744825 1.73767 0.62683 1.61926C0.508835 1.50086 0.449632 1.35449 0.449221 1.18017C0.44881 1.00585 0.508013 0.859492 0.62683 0.741086C0.745647 0.62268 0.89201 0.563477 1.06592 0.563477H10.9331C11.1078 0.563477 11.2544 0.62268 11.3728 0.741086C11.4912 0.859492 11.5502 1.00585 11.5498 1.18017C11.5494 1.35449 11.4902 1.50106 11.3722 1.61988C11.2542 1.7387 11.1078 1.7977 10.9331 1.79687H1.06592Z" fill="white"/>
            </svg>    
        </button>
        <input id="amliq-mobile_nav__trigger" class="amliq-mobile_nav__trigger hidden peer" type="checkbox" autocomplete="off" hidden>
        <div class="bg-secondary-700/70 w-screen absolute left-0 top-0 h-screen z-10 hidden peer-checked:block" aria-hidden="true"></div>
        <nav aria-label="Primary navigation" class="amliq-main_nav bg-secondary-700 lm:shadow-md lm:z-20 lm:h-screen lm:absolute lm:left-0 lm:top-0 lm:w-11/12 lm:-translate-x-full lm:overflow-auto lm:max-h-screen lm:transition peer-checked:lm:translate-x-0">
            <div class="hidden lm:block">
                <div aria-label="<?php echo esc_attr( __( 'Top promotional links', 'amliq' ) ); ?>" class="bg-primary-700 space-y-6 p-6">
                    <a href="#" class="block text-white text-sm text-center md:text-left">
                        <?php echo esc_html__( 'Visit Our Pallet Outlet in Waterbury, CT!', 'amliq' ); ?>
                    </a>

                    <a href="#" class="block text-white text-sm text-center md:text-left">
                        <?php echo esc_html__( 'Over 150 Pallets available', 'amliq' ); ?>
                    </a>

                    <a href="#" class="block text-white text-sm text-center md:text-left">
                        <?php echo esc_html__( 'Open to the Public 7 Days per week', 'amliq' ); ?>
                    </a>

                    <?php
                    get_template_part(
                        'templates/partials/button',
                        '',
                        [
                            'text'  => __( 'GET DIRECTIONS', 'amliq' ),
                            'href'  => '#',
                            'class' => 'is-style-fill has-color-style-secondary has-arrow has-force_hover__outline_secondary md:mx-auto is-medium-small-on-md',
                        ]
                    );
                    ?>
                </div>
                <div class="bg-white p-4 space-y-3.5">
                    <div class="flex justify-between items-center">
                        <a 
                            href="<?php echo esc_url( home_url( '/' ) ); ?>" 
                            class="block font-barlow font-bold text-secondary-700 text-sm max-w-28"
                            >
                            <?php echo esc_html( get_bloginfo( 'name' ) ); ?>
                        </a>
                        <button 
                            class="text-white w-fit" 
                            type="button" 
                            aria-label="Close Mobile Menu"
                            onclick="(function(cb){ cb.checked = !cb.checked; })(document.getElementById('amliq-mobile_nav__trigger'));"
                        >
                            <svg class="stroke-secondary-700 hover:stroke-primary-700" width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.9998 15.1589L1.68262 1.8418M14.9998 1.8418L1.68262 15.1589" stroke-width="1.90476" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Separator -->
                    <span aria-hidden="true" class="block border-t border-secondary-200 w-full"></span>

                    <!-- Search bar -->
                    <?php get_template_part( 'templates/partials/search-bar' ) ?>

                    <div class="flex justify-between items-center gap-3">
                        <!-- Phone Number -->
                        <?php
                        /**
                         * Phone link with proper sanitization, accessibility, and WP coding standards.
                         */
                        $phone_number = '203-587-4132';
                        $tel_href     = 'tel:' . esc_attr( preg_replace( '/\D+/', '', $phone_number ) );
                        ?>
                        <a
                            href="<?php echo $tel_href; ?>" 
                            class="text-secondary-700 hover:underline" 
                            itemprop="telephone" 
                            aria-label="<?php echo esc_attr( sprintf( __( 'Call us at %s', 'amliq_theme' ), $phone_number ) ); ?>" 
                            >
                            <?php echo esc_html( $phone_number ); ?>
                        </a>
                        <div class="flex items-center gap-2">
                            <?= get_template_part(
                                'templates/partials/button',
                                '',
                                [
                                    'text'  => __( 'CART', 'amliq' ),
                                    'href'  => '#',
                                    'style' => 'radial',
                                    'class' => 'is-style-outline has-color-style-primary has-cart',
                                    'link_class' => 'amliq-md__px_2'
                                ]
                                ); ?>
                            <?= get_template_part(
                                'templates/partials/button',
                                '',
                                [
                                    'text'  => __( 'SIGN IN', 'amliq' ),
                                    'href'  => '#',
                                    'style' => 'primary',
                                    'class' => 'is-style-fill has-color-style-primary has-user',
                                    'link_class' => 'amliq-md__px_2'
                                ]
                                ); ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                $item_class = 'text-white group-hover:underline cursor-pointer lg:text-sm lg:text-left lm:block lm:w-full lm:py-4 lm:px-7 lm:group-hover:bg-white lm:group-hover:text-secondary-700';
            ?>
            <div class="lm:bg-secondary-700">
                <ul class="flex justify-evenly items-center gap-x-4 py-5 text-white/30 lm:block">
                    <li class="group">
                        <a class="<?= esc_attr( $item_class ) ?>" href="/">Home</a>
                    </li>
                    <li class="group lm:hidden" aria-hidden="true">
                        <span class="block border-l border-white/30 h-8"></span>
                    </li>
                    <li class="group">
                        <a class="<?= esc_attr( $item_class ) ?>" href="/auctions">Auctions</a>
                    </li>
                    <li class="group amliq-has_submenu">
                        <button class="<?= esc_attr( $item_class ) ?>" href="/shop" aria-haspopup="true" aria-expanded="false">
                            Shop
                        </button>
                        <ul class="bg-secondary-700 -left-4 top-full pb-3 lm:pl-9 lm:pb-0" aria-label="Shop submenu">
                            <li>
                                <a class="block text-white px-4 pt-3 hover:underline lm:py-3 lm:hover:bg-white lm:hover:text-secondary-700" href="/shop/amazon">
                                    Amazon
                                </a>
                            </li>
                            <li>
                                <a class="block text-white px-4 pt-3 hover:underline lm:py-3 lm:hover:bg-white lm:hover:text-secondary-700" href="/shop/ebay">
                                    Ebay
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="<?= esc_attr( $item_class ) ?>" href="/buy-truckloads">
                            Buy Truckloads
                        </a>
                    </li>
                    <li class="lm:hidden" aria-hidden="true">
                        <span class="block border-l border-white/30 h-8"></span>
                    </li>
                    <li>
                        <a class="<?= esc_attr( $item_class ) ?>" href="/buy-truckloads">
                            Sell to Us
                        </a>
                    </li>
                    <li class="lm:hidden" aria-hidden="true">
                        <span class="block border-l border-white/30 h-8"></span>
                    </li>
                    <li>
                        <a class="<?= esc_attr( $item_class ) ?>" href="/buy-truckloads">
                            Learn
                        </a>
                    </li>
                    <li>
                        <a class="<?= esc_attr( $item_class ) ?>" href="/buy-truckloads">
                            Social Media
                        </a>
                    </li>
                    <li>
                        <a class="<?= esc_attr( $item_class ) ?>" href="/buy-truckloads">
                            Testimonials
                        </a>
                    </li>
                    <li class="lm:hidden" aria-hidden="true">
                        <span class="block border-l border-white/30 h-8"></span>
                    </li>
                    <li class="amliq-has_submenu">
                        <button class="<?= esc_attr( $item_class ) ?>" href="/support" aria-haspopup="true" aria-expanded="false">
                            Support
                        </button>
                        <ul class="bg-secondary-700 -left-4 top-full pb-3" aria-label="Support submenu">
                            <li>
                                <a class="block text-white px-4 pt-3 hover:underline" href="/contact/">
                                    Contact
                                </a>
                            </li>
                            <li>
                                <a class="block text-white px-4 pt-3 hover:underline" href="/about/">
                                    About
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="lm:hidden" aria-hidden="true">
                        <span class="block border-l border-white/30 h-8"></span>
                    </li>
                    <li>
                        <a class="<?= esc_attr( $item_class ) ?>" href="/buy-truckloads">
                            Electronics Recycling
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>