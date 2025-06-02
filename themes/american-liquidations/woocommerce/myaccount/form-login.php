<?php
defined( 'ABSPATH' ) || exit;
?> 
<?php 
if(is_wc_endpoint_url( 'register' )){
    wc_get_template( 'myaccount/form-register.php' );
}else{
    ?>
        <div class="page-description-header py-12">
            <div class="container">
                <h1 class="text-[36px] md:text-[48px]">Sign in</h1>
                <div class="mt-6">
                    <p>Track your orders, checkout faster, and sync your favorites. Just enter your email and we’ll send you a special link that will sign you in instantly.</p>
                </div>
            </div>
        </div>


        <div class="custom-login-wrapper bg-gray py-12 md:py-24">
            <div class="container">
                <?php do_action( 'woocommerce_before_customer_login_form' ); ?>
                <div class="login-flex-layout flex flex-row gap-12">

                    <!-- LEFT SIDE: Info Panels ("Tabs") -->
                    <aside class="login-page-info-tabs w-[300px] p-7 bg-white rounded-[15px]">
                        <ul class="space-y-10">
                            <li class="my-account-top text-sm">
                                <strong class="font-semibold mb-[5px] block">Guest Account</strong>
                                <div class="text-xs font-medium">You’re not signed in yet.</div>
                            </li>
                            <li class="my-account-cookies text-sm">
                                <strong class="font-semibold mb-[5px] block">Cookie Consent</strong>
                                <div class="text-xs font-medium">Only essential cookies allowed</div>
                            </li>
                            <li class="my-account-cart text-sm">
                                <strong class="font-semibold mb-[5px] block">Shopping Cart</strong>
                                <div class="text-xs font-medium">
                                    <?php
                                    if ( function_exists( 'WC' ) && WC()->cart ) {
                                        $cart_count = WC()->cart->get_cart_contents_count();
                                        if ( $cart_count > 0 ) {
                                            printf( _n( '%d product in cart', '%d products in cart', $cart_count, 'woocommerce' ), $cart_count );
                                        } else {
                                            echo 'Your Cart is empty';
                                        }
                                    } else {
                                        echo 'Your Cart is empty';
                                    }
                                    ?>
                                </div>
                            </li>
                        </ul>
                    </aside>

                    <!-- RIGHT SIDE: WooCommerce Login Form -->
                    <main class="login-form-section w-[calc(100%_-_300px)] custom-login-form-cover p-12 bg-white rounded-[15px]">
                        <form class="woocommerce-form woocommerce-form-login" method="post">

                            <?php do_action( 'woocommerce_login_form_start' ); ?>

                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide !mb-4">
                                <label for="username" class="text-sm font-semibold"><?php esc_html_e( 'Username or Email Address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text !border-[#080404]/5"
                                    name="username" id="username" autocomplete="username"
                                    value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" />
                            </p>
                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                <label for="password" class="text-sm font-semibold"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                                <input class="woocommerce-Input woocommerce-Input--text input-text !border-[#080404]/5" type="password"
                                    name="password" id="password" autocomplete="current-password" />
                            </p>

                            <?php do_action( 'woocommerce_login_form' ); ?>

                            <div class="form-row">
                                <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
                                    <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme"
                                        type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
                                </label>
                            </div>
                            <div class="flex items-center justify-between pt-10">
                                <div class="flex items-center gap-6">
                                    <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                                    <button type="submit"
                                        class="btn btn-red btn-arrow"
                                        name="login"
                                        value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Sign in', 'woocommerce' ); ?></button>
                                    <span class="text-sm">Don’t have an account? <a href="<?php echo site_url(); ?>/my-account/register/" class="font-bold">Sign Up</a></span>
                                </div>
                                <div class="text-black/60 font-bold text-sm">
                                    <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>">
                                        <?php esc_html_e( 'Forgot Password?', 'woocommerce' ); ?>
                                    </a>
                                </div>
                            </div>

                            <?php do_action( 'woocommerce_login_form_end' ); ?>

                        </form>
                    </main>

                </div>
            </div>
        </div>
    <?php
}?>


<?php 
do_action( 'woocommerce_after_customer_login_form' ); ?>