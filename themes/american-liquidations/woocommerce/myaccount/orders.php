<?php
defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_account_orders', $has_orders );

// Separate orders
$products_orders   = [];
$truckloads_orders = [];

if ( $has_orders ) {
    foreach ( $customer_orders->orders as $customer_order ) {
        $order = wc_get_order( $customer_order );
        $has_truckloads = false;
        foreach ( $order->get_items() as $item ) {
            $product = $item->get_product();
            if ( $product && has_term( 'truckloads', 'product_cat', $product->get_id() ) ) {
                $has_truckloads = true;
                break;
            }
        }
        if ( $has_truckloads ) {
            $truckloads_orders[] = $order;
        } else {
            $products_orders[] = $order;
        }
    }
}

// Helper: paginate array
function get_paginated_array($array, $per_page = 5, $page = 1) {
    $total = count($array);
    $pages = ceil($total / $per_page);
    $page = max(1, min($page, $pages));
    $offset = ($page - 1) * $per_page;
    return [
        'orders' => array_slice($array, $offset, $per_page),
        'total' => $total,
        'pages' => $pages,
        'current' => $page
    ];
}

function myaccount_orders_custom_table($orders, $wp_button_class = '') {
    if ( empty( $orders ) ) { return; }
    ?>
    <div class="order-table-responsive">
    <table class="woocommerce-orders-table woocommerce-MyAccount-orders shop_table my_account_orders account-orders-table">
        <thead>
            <tr>
                <th class="min-w-[240px]">Order Info</th>
                <th class="text-center whitespace-nowrap"># Tracking</th>
                <th class="text-center">Status</th>
                <th class="min-w-[100px] whitespace-nowrap"># Order ID</th>
                <th class="min-w-[100px]">Date</th>
                <th class="min-w-[100px]">Shipping</th>
                <th class="min-w-[100px]">Total</th>
                <th class="min-w-[220px]"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ( $orders as $order ) :
                $item_count = $order->get_item_count() - $order->get_item_count_refunded();
                ?>
                <tr class="woocommerce-orders-table__row woocommerce-orders-table__row--status-<?php echo esc_attr( $order->get_status() ); ?> order">
                    <!-- Order Info -->
                    <td>
                        <ul>
                        <?php foreach ( $order->get_items() as $item ) {
                            $product = $item->get_product();
                            if ($product) {
                                echo '<li>' . esc_html( $product->get_name() ) . '</li>';
                            }
                        } ?>
                        </ul>
                    </td>
                    <!-- # Tracking -->
                    <td class="text-center">
                        <?php
                        // Replace '_tracking_number' with your tracking plugin meta key, or use plugin APIs if necessary.
                        $tracking = $order->get_meta('_tracking_number');
                        echo $tracking ? esc_html($tracking) : '-';
                        ?>
                    </td>
                    <!-- Status -->
                    <td class="status-<?php echo esc_attr( $order->get_status() ); ?>">
                        <span>
                        <?php
                            $status = $order->get_status();
                            echo esc_html( $status === 'completed' ? 'Delivered' : wc_get_order_status_name( $status ) );
                        ?>
                        </span>
                    </td>
                    <!-- # Order ID -->
                    <td class="text-center lg:text-left">#<?php echo esc_html( $order->get_order_number() ); ?></td>
                    <!-- Date -->
                    <td class="uppercase whitespace-nowrap">
                        <?php
                        echo esc_html( wc_format_datetime( $order->get_date_created() ) );
                        ?>
                    </td>
                    <!-- Shipping -->
                    <td>
                        <?php
                        $shipping_methods = [];
                        foreach ( $order->get_shipping_methods() as $shipping ) {
                            $shipping_methods[] = esc_html( $shipping->get_name() );
                        }
                        echo $shipping_methods ? implode( ', ', $shipping_methods ) : '-';
                        ?>
                    </td>
                    <!-- Total -->
                    <td><?php echo wp_kses_post( $order->get_formatted_order_total() ); ?></td>
                    <!-- Actions -->
                    <td>
                        <?php

                        echo '<div class="flex items-center gap-2">';
                        // Receipt button (change to your PDF/receipt url if needed)
                        $order_id = $order->get_id();
                        $access_key = 'bae469a797';

                        if ( $access_key ) {
                            $pdf_url = add_query_arg( array(
                                'action'       => 'generate_wpo_wcpdf',
                                'document_type'=> 'invoice',
                                'order_ids'    => $order_id,
                                'access_key'   => $access_key,
                            ), admin_url( 'admin-ajax.php' ) );

                            echo '<a href="' . esc_url( $pdf_url ) . '" class="btn btn-red btn-small !capitalize !tracking-[0px] !font-semibold receipt-download whitespace-nowrap" target="_blank"><img src="'.site_url().'/wp-content/uploads/2025/06/receipt-icon.svg" /><span>Receipt</span></a>';
                        }
                        // View Details
                        echo '<a href="' . esc_url( $order->get_view_order_url() ) . '" class="btn btn-small !capitalize !tracking-[0px] !font-semibold whitespace-nowrap">View details</a>';
                        echo '</div>';
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    <?php
}

// GET current page for each section from URL (use defaults if not set)
$products_page   = isset( $_GET['products_page'] )   ? max( 1, intval( $_GET['products_page'] ) ) : 1;
$truckloads_page = isset( $_GET['truckloads_page'] ) ? max( 1, intval( $_GET['truckloads_page'] ) ) : 1;

// Paginate both arrays
$products_paginated   = get_paginated_array( $products_orders, 10, $products_page );
$truckloads_paginated = get_paginated_array( $truckloads_orders, 10, $truckloads_page );

// Helper to output pagination links
function woocommerce_custom_orders_pagination($current, $pages, $base_url, $param_name) {
    if ( $pages < 2 ) return;
    echo '<nav class="woocommerce-pagination flex my-3 gap-3 items-center justify-center text-sm">';
    if ( $current > 1 ) {
        echo '<a class="btn btn-small btn-red btn-prev" href="' . esc_url( add_query_arg( $param_name, $current - 1, $base_url ) ) . '">' . esc_html__('Prev','woocommerce') . '</a> ';
    }
    echo '<span style="padding:0 6px;">' . sprintf( __( 'Page %d of %d', 'woocommerce' ), $current, $pages ) . '</span>';
    if ( $current < $pages ) {
        echo '<a class="btn btn-small btn-red btn-next" href="' . esc_url( add_query_arg( $param_name, $current + 1, $base_url ) ) . '">' . esc_html__('Next','woocommerce') . '</a>';
    }
    echo '</nav>';
}

// Base URL
$base_url = strtok( $_SERVER["REQUEST_URI"], '?' ); // Strip query
$base_url = esc_url( add_query_arg( $_GET, $base_url ) ); // Restore current query params

?>

<?php if ( $has_orders ) : ?>

    <?php if ( ! empty( $products_orders ) ) : ?>
        <h4 class="mb-5"><?php echo esc_html_x( 'Products', 'my account', 'woocommerce' ); ?></h4>
        <?php myaccount_orders_custom_table( $products_paginated['orders'], $wp_button_class ); ?>
            <?php
            woocommerce_custom_orders_pagination(
                $products_paginated['current'],
                $products_paginated['pages'],
                remove_query_arg('products_page'),
                'products_page'
            );
            ?>
    <?php endif; ?>


    <div class="h-10 md:h-20"></div>

    <?php if ( ! empty( $truckloads_orders ) ) : ?>
        <h4 class="mb-5"><?php echo esc_html_x( 'Truckloads', 'my account', 'woocommerce' ); ?></h4>
        <?php myaccount_orders_custom_table( $truckloads_paginated['orders'], $wp_button_class ); ?>
        <?php
        woocommerce_custom_orders_pagination(
            $truckloads_paginated['current'],
            $truckloads_paginated['pages'],
            remove_query_arg('truckloads_page'),
            'truckloads_page'
        );
        ?>
    <?php endif; ?>

<?php else : ?>

    <?php wc_print_notice(
        esc_html__( 'No order has been made yet.', 'woocommerce' ) .
        ' <a style="display: initial;" class="btn btn-red btn-small' . esc_attr( $wp_button_class ) .
        '" href="' . esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ) . '">' .
        esc_html__( 'Browse products', 'woocommerce' ) . '</a>',
        'notice'
    ); ?>

<?php endif; ?>

<?php do_action( 'woocommerce_after_account_orders', $has_orders ); ?>