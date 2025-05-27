<?php

// Account pages

// Update Legal Name AJAX
add_action('wp_ajax_edit_legal_name', function() {
    $user_id = intval($_POST['user_id']);
    if(get_current_user_id() != $user_id) wp_send_json_error('No permission');
    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);
    $middle_name = sanitize_text_field($_POST['middle_name']);
    wp_update_user([
        'ID' => $user_id,
        'first_name' => $first_name,
        'last_name' => $last_name
    ]);
    update_user_meta($user_id, 'middle_name', $middle_name);
    wp_send_json_success();
});

// Update Email AJAX
add_action('wp_ajax_edit_user_email', function() {
    $user_id = intval($_POST['user_id']);
    if(get_current_user_id() != $user_id) wp_send_json_error('No permission');
    $email = sanitize_email($_POST['user_email']);
    if(!is_email($email)) wp_send_json_error('Invalid email');
    wp_update_user([
        'ID' => $user_id,
        'user_email' => $email
    ]);
    wp_send_json_success();
});

add_action('wp_ajax_edit_user_phone', function() {
    $user_id = intval($_POST['user_id']);
    if(get_current_user_id() != $user_id) wp_send_json_error('No permission');
    $phone = sanitize_text_field($_POST['user_phone']);
    update_user_meta($user_id, 'user_phone', $phone);
    wp_send_json_success();
});



// Add Middle Name field to user profile in admin
add_action( 'show_user_profile', 'add_middle_name_field_to_user_profile' );
add_action( 'edit_user_profile', 'add_middle_name_field_to_user_profile' );

function add_middle_name_field_to_user_profile( $user ) {
    ?>
    <h3>Extra Profile Information</h3>
    <table class="form-table">
        <tr>
            <th><label for="middle_name">Middle Name</label></th>
            <td>
                <input type="text" name="middle_name" id="middle_name" value="<?php echo esc_attr( get_user_meta( $user->ID, 'middle_name', true ) ); ?>" class="regular-text" /><br />
                <span class="description">Please enter the user&rsquo;s middle name.</span>
            </td>
        </tr>
    </table>
    <?php
}

// Save the middle name when the user profile is updated
add_action( 'personal_options_update', 'save_middle_name_field' );
add_action( 'edit_user_profile_update', 'save_middle_name_field' );

function save_middle_name_field( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;
    update_user_meta( $user_id, 'middle_name', sanitize_text_field( $_POST['middle_name'] ) );
}


add_action('wp_ajax_edit_user_password', function() {
    $user_id = intval($_POST['user_id']);
    if(get_current_user_id() != $user_id) wp_send_json_error('No permission');

    $password = trim($_POST['new_password']);
    $confirm = trim($_POST['confirm_password']);

    if(strlen($password) < 6) wp_send_json_error("Password too short");
    if($password !== $confirm) wp_send_json_error("Passwords do not match");

    // Update password
    wp_set_password($password, $user_id);
    wp_send_json_success();
});

?>