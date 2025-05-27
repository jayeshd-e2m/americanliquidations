<?php
function my_acf_register_block_types() {

	acf_register_block_type(array(
        'name'              => 'american-hero-block',
        'title'             => __('Hero Section'),
        'description'       => __('A custom Hero block with ACF fields.'),
        'render_template'   => 'template-parts/blocks/hero-block/hero-block.php',
        'category'          => 'formatting',
        'icon'              => 'block-default',
        'keywords'          => array('Hero','Block'),
        'mode'              => 'edit',
    ));

    acf_register_block_type(array(
        'name'              => 'american-new-arrival-block',
        'title'             => __('New Arrival Section'),
        'description'       => __('A custom New Arrival block with ACF fields.'),
        'render_template'   => 'template-parts/blocks/new-arrival-block/new-arrival-block.php',
        'category'          => 'formatting',
        'icon'              => 'block-default',
        'keywords'          => array('Arrival','New','Block'),
        'mode'              => 'edit',
    ));

    acf_register_block_type(array(
        'name'              => 'american-our-brand-block',
        'title'             => __('Our Brand Section'),
        'description'       => __('A custom Our Brand block with ACF fields.'),
        'render_template'   => 'template-parts/blocks/our-brand-block/our-brand-block.php',
        'category'          => 'formatting',
        'icon'              => 'block-default',
        'keywords'          => array('Brand','Our Brand','Block'),
        'mode'              => 'edit',
    ));

    acf_register_block_type(array(
        'name'              => 'american-two-block',
        'title'             => __('Two Block Section'),
        'description'       => __('A custom Two Block with ACF fields.'),
        'render_template'   => 'template-parts/blocks/two-block/two-block.php',
        'category'          => 'formatting',
        'icon'              => 'block-default',
        'keywords'          => array('two','Block'),
        'mode'              => 'edit',
    ));

    acf_register_block_type(array(
        'name'              => 'american-home-testimonial-block',
        'title'             => __('Home Testimonial Section'),
        'description'       => __('A custom Home Testimonial with ACF fields.'),
        'render_template'   => 'template-parts/blocks/home-testimonial-block/home-testimonial-block.php',
        'category'          => 'formatting',
        'icon'              => 'block-default',
        'keywords'          => array('Testimonial','Block'),
        'mode'              => 'edit',
    ));

    acf_register_block_type(array(
        'name'              => 'american-truck-load-block',
        'title'             => __('Truck Load Section'),
        'description'       => __('A custom Truck Load with ACF fields.'),
        'render_template'   => 'template-parts/blocks/truck-load-block/truck-load-block.php',
        'category'          => 'formatting',
        'icon'              => 'block-default',
        'keywords'          => array('Truck','Load','Block'),
        'mode'              => 'edit',
    ));

    acf_register_block_type(array(
        'name'              => 'american-page-description-block',
        'title'             => __('Page Title & Description Section'),
        'description'       => __('A custom Page Title & Description with ACF fields.'),
        'render_template'   => 'template-parts/blocks/page-description-block/page-description-block.php',
        'category'          => 'formatting',
        'icon'              => 'block-default',
        'keywords'          => array('title','description','Block'),
        'mode'              => 'edit',
    ));

    acf_register_block_type(array(
        'name'              => 'american-two-column-block-block',
        'title'             => __('Two Column Section'),
        'description'       => __('A Two Column with ACF fields.'),
        'render_template'   => 'template-parts/blocks/two-column-block/two-column-block.php',
        'category'          => 'formatting',
        'icon'              => 'block-default',
        'keywords'          => array('two','column','Block'),
        'mode'              => 'edit',
    ));

    acf_register_block_type(array(
        'name'              => 'american-contact-top-block',
        'title'             => __('Contact Top Section'),
        'description'       => __('A Contact Top with ACF fields.'),
        'render_template'   => 'template-parts/blocks/contact-top-block/contact-top-block.php',
        'category'          => 'formatting',
        'icon'              => 'block-default',
        'keywords'          => array('contact','top','Block'),
        'mode'              => 'edit',
    ));

    acf_register_block_type(array(
        'name'              => 'american-contact-form-block',
        'title'             => __('Contact Form Section'),
        'description'       => __('A Contact Form with ACF fields.'),
        'render_template'   => 'template-parts/blocks/contact-form-block/contact-form-block.php',
        'category'          => 'formatting',
        'icon'              => 'block-default',
        'keywords'          => array('contact','form','Block'),
        'mode'              => 'edit',
    ));

    acf_register_block_type(array(
        'name'              => 'american-faq--block',
        'title'             => __('FAQs Section'),
        'description'       => __('A FAQs with ACF fields.'),
        'render_template'   => 'template-parts/blocks/faqs-block/faqs-block.php',
        'category'          => 'formatting',
        'icon'              => 'block-default',
        'keywords'          => array('faqs','faq','Block'),
        'mode'              => 'edit',
    ));

    
}
add_action('acf/init', 'my_acf_register_block_types');
?>