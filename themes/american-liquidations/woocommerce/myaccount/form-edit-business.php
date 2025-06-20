<?php
defined( 'ABSPATH' ) || exit;

// Fetch business profile fields
$current_user = wp_get_current_user();
$user_id = $current_user->ID;

if (
    isset($_POST['upload_tax_document']) 
    && isset($_FILES['tax_document']) 
    && check_admin_referer('upload_tax_document', 'upload_tax_document_nonce')
) {
    $file = $_FILES['tax_document'];
    $allowed_types = array('application/pdf', 'image/jpeg', 'image/png');
    if (in_array($file['type'], $allowed_types)) {
        require_once(ABSPATH . "wp-admin/includes/file.php");
        require_once(ABSPATH . "wp-admin/includes/media.php");
        require_once(ABSPATH . "wp-admin/includes/image.php");
        $attachment_id = media_handle_upload('tax_document', 0);
        if (!is_wp_error($attachment_id)) {
            update_user_meta($user_id, 'tax_document_id', $attachment_id);
            wp_redirect( esc_url( add_query_arg('profile-updated','1', wc_get_account_endpoint_url('business-profile') ) ) );
            exit;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['business_edit_field']) && check_admin_referer('edit_business_field', 'edit_business_nonce')) {
    $field_map = [
        'business_phone'   => 'business_phone',
        'business_address' => 'business_address',
        'business_type'    => 'business_type',
    ];
    $field = sanitize_text_field($_POST['business_edit_field']);
    $value = isset($_POST['business_edit_value']) ? sanitize_text_field($_POST['business_edit_value']) : '';

    if (array_key_exists($field, $field_map)) {
        update_user_meta($user_id, $field_map[$field], $value);
        // Simple redirect to avoid form resubmission
        wp_redirect( esc_url( add_query_arg('profile-updated','1', wc_get_account_endpoint_url('business-profile') ) ) );
        exit;
    }
}


$business_name     = get_user_meta($user_id, 'business_name', true);
$ein               = get_user_meta($user_id, 'business_ein', true);
$business_phone    = get_user_meta($user_id, 'business_phone', true);
$business_address  = get_user_meta($user_id, 'business_address', true);
$business_address_2  = get_user_meta($user_id, 'business_address_2', true);
$business_city  = get_user_meta($user_id, 'business_city', true);
$business_zipcode  = get_user_meta($user_id, 'business_zipcode', true);
$business_country  = get_user_meta($user_id, 'business_country', true);
$business_state  = get_user_meta($user_id, 'business_state', true);
$business_type     = get_user_meta($user_id, 'business_type', true);
$tax_document_id   = get_user_meta($user_id, 'tax_document_id', true);
$tax_document_url  = $tax_document_id ? wp_get_attachment_url($tax_document_id) : '';
$tax_document_file = $tax_document_id ? get_post($tax_document_id)->post_title : '';

$is_business_profile = $business_name || $ein || $business_phone || $business_address || $business_type;


$address = get_user_meta($user_id, 'default_address', true);
$city = get_user_meta($user_id, 'default_city', true);
$zipcode = get_user_meta($user_id, 'default_zipcode', true);
$country = get_user_meta($user_id, 'default_country', true);
$state   = get_user_meta($user_id, 'default_state', true);

$wc_countries = new WC_Countries();
$countries = $wc_countries->get_countries();
$states    = $wc_countries->get_states();

// Resolve full country name
$full_country = isset($countries[$country]) ? $countries[$country] : $country;

// Resolve full state name based on country
$full_state = (isset($states[$country]) && isset($states[$country][$state])) ? $states[$country][$state] : $state;



?>


<div class="business-profile-cards flex mt-5 gap-5 mb-5 flex-wrap md:flex-nowrap">
    <!-- General/Business Address Info Card -->
    <div class="w-full bg-white rounded-[20px] p-10 flex flex-col justify-between flex-wrap md:flex-nowrap">
        <div>
            <div class="font-bold text-xl mb-2">General Business Info</div>
            <div class="flex lg:items-center justify-between gap-5 flex-col lg:flex-row">
                <!-- Replace with some dynamic business address or phone if you want -->
				 <span class="text-black/60 text-xs max-w-[220px]">
					<?php $display_address = trim("{$business_address}, {$business_address_2}, {$business_city} {$business_zipcode} {$full_country}");?>
                	<?php echo $business_address ? esc_html($display_address) : "Address not provided yet."; ?><br>
				</span>
				<button id="open-business-info-modal" class="text-primary/60 font-semibold text-sm hover:text-primary text-left">View or Update</button>
            </div>
        </div>
    </div>
    <!-- Address Book Card -->
    <div class="w-full bg-white rounded-[20px] p-10 flex flex-col justify-between flex-wrap md:flex-nowrap">
        <div>
            <div class="font-bold text-xl mb-2">Address Book</div>
            <div class="flex lg:items-center justify-between gap-5 flex-col lg:flex-row">
                <span class="text-black/60 text-xs max-w-[220px]">
					<?php
					if ($address || $city || $zipcode || $country) {
						$full_address = trim("{$address}, {$city} {$zipcode} {$full_state} {$full_country}");
						echo '<span class="text-black/60 text-xs max-w-[220px]">' . esc_html($full_address) . '</span>';
					} else {
						echo '<span class="text-black/60 text-xs max-w-[220px]">Address not provided yet.</span>';
					}
					?>
				</span>
				<a href="<?php echo site_url(); ?>/my-account/address-book/" class="text-primary/60 text-sm font-semibold hover:text-primary text-left">View or Update</a>
            </div>
        </div>
        <div class="flex justify-end mt-2">
        </div>
    </div>
</div>


<div class="business-profile-items-cover hidden">
	<?php if ($is_business_profile): ?>

		<!-- General Information Tab -->
		<div class="info-section bg-white p-7 md:p-12 rounded-[15px] w-full mb-5">
			<div class="info-item-inner relative pr-10">
				<div class="section-label text-[20px] font-bold mb-6 md:mb-10">Business Name</div>
				<div class="flex gap-24">
					<div class="text-sm">
						<?php echo esc_html($business_name); ?>
					</div>
				</div>
			</div>
		</div>

		<div class="info-section bg-white p-7 md:p-12 rounded-[15px] w-full mb-5">
			<div class="info-item-inner relative pr-10">
				<div class="section-label text-[20px] font-bold mb-6 md:mb-10">Business Registration ID (BRID)</div>
				<div class="flex gap-24">
					<div class="text-sm">
						<span class="font-semibold block mb-2">Employer Identification Number (EIN)</span>
						<?php echo esc_html($ein); ?>
					</div>
				</div>
			</div>
		</div>


		<div class="flex mt-5 gap-5 mb-5 flex-wrap lg:flex-nowrap">
			<div class="info-section bg-white p-7 md:p-12 rounded-[15px] w-full">
				<div class="info-item-inner relative pr-10">
					<div class="section-label text-[20px] font-bold mb-6 md:mb-10">Business Phone Number</div>
					<div class="flex gap-24">
						<div class="text-sm">
							<?php echo esc_html($business_phone); ?>
						</div>
					</div>
					<button class="edit-section absolute top-0 right-0 text-primary/60 text-sm font-semibold" data-modal="modal-business-phone">Edit</button>
				</div>
			</div>
			<div class="info-section bg-white p-7 md:p-12 rounded-[15px] w-full">
				<div class="info-item-inner relative pr-10">
					<div class="section-label text-[20px] font-bold mb-6 md:mb-10">Business Address</div>
					<div class="flex gap-24">
						<div class="text-sm">
							<?php echo esc_html($business_address); ?> <?php echo esc_html($business_city); ?> <?php echo esc_html($business_zipcode); ?> <?php echo esc_html($business_state); ?> <?php echo esc_html($business_country); ?>
						</div>
					</div>
					<button class="edit-section absolute top-0 right-0 text-primary/60 text-sm font-semibold" data-modal="modal-business-address">Edit</button>
				</div>
			</div>
			<div class="info-section bg-white p-7 md:p-12 rounded-[15px] w-full">
				<div class="info-item-inner relative pr-10">
					<div class="section-label text-[20px] font-bold mb-6 md:mb-10">Business Type</div>
					<div class="flex gap-24">
						<div class="text-sm">
							<?php echo esc_html($business_type); ?>
						</div>
					</div>
					<button class="edit-section absolute top-0 right-0 text-primary/60 text-sm font-semibold" data-modal="modal-business-type">Edit</button>
				</div>
			</div>
		</div>

		<?php
		$tax_document_file = '';
		if ($tax_document_id) {
			$file_path = get_attached_file($tax_document_id); // Absolute path OR false
			if ($file_path) {
				$tax_document_file = basename($file_path);
			} else if($tax_document_url) {
				$tax_document_file = basename($tax_document_url);
			}
		}
		?>
		<div class="info-section bg-white p-7 md:p-12 rounded-[15px] w-full">
			<div class="info-item-inner relative">
				<div class="flex items-center justify-between mb-10 flex-wrap md:flex-nowrap">
					<div class="section-label text-[20px] font-bold">Tax Exempt Document</div>
					<div class="flex gap-4 flex-wrap md:flex-nowrap mt-3 md:mt-0 mobile-wrap w-full md:w-auto">
						<?php $file = get_field('tax_template','option'); ?>
						<a href="<?php echo $file['url']; ?>" download 
						class="hover:text-white hover:bg-black text-black/60 bg-gray py-5 px-[10px] lg:px-10 rounded-[17px] text-sm font-semibold text-center">
						Download Form Template</a>
						<a href="#" class="text-primary border border-primary py-5 px-[10px] lg:px-10 rounded-[17px] text-sm hover:text-white hover:bg-primary font-semibold text-center" id="show-upload-tax-doc">+ Upload New Document</a>
					</div>
				</div>
				<div class="mt-3 mb-3 text-[14px]"><?php echo esc_html($tax_document_file) ?> (Preview of Previous Doc)</div>
				<div class="flex gap-24 mb-4">
					<div class="text-sm w-full h-[350px] overflow-y-auto">
						<?php if ($tax_document_url): ?>
							<?php
							$mime_type = get_post_mime_type($tax_document_id);
							if ($mime_type === 'application/pdf'):
							?>
								<iframe src="<?php echo esc_url($tax_document_url); ?>" width="100%" height="350" frameborder="0" style="border:1px solid #ddd;border-radius:8px;"></iframe>
								<?php echo $file_display; ?>
							<?php elseif (strpos($mime_type, 'image/') === 0): ?>
								<img src="<?php echo esc_url($tax_document_url); ?>" alt="Tax Document" style="max-width:100%;">
								<?php echo $file_display; ?>
							<?php else: ?>
								File uploaded is not a PDF or image. <a href="<?php echo esc_url($tax_document_url); ?>" target="_blank">Download</a>
							<?php endif; ?>
						<?php else: ?>
							No document uploaded yet.
						<?php endif; ?>
					</div>
				</div>

				<!-- Modal remains as previous answers -->
				<div id="modal-upload-tax-doc" class="custom-modal-overlay" style="display:none;">
					<div class="custom-modal">
						<h5 class="mb-4">Upload New Tax Exempt Document</h5>
						<form method="post" enctype="multipart/form-data" autocomplete="off">
							<label class="block font-medium mb-2">Choose file (PDF, JPG, PNG, etc.)</label>
							<input type="file" name="tax_document" required accept="application/pdf,image/*" class="mb-4">
							<?php wp_nonce_field('upload_tax_document', 'upload_tax_document_nonce'); ?>
							<button type="submit" name="upload_tax_document" class="button btn-primary">Upload</button>
							<button type="button" class="custom-modal-close">Cancel</button>
						</form>
					</div>
				</div>
			</div>
		</div>

		




		<!-- Phone Modal -->
		<div id="modal-business-phone" class="custom-modal-overlay" style="display:none;">
			<div class="custom-modal">
				<h5 class="mb-4">Edit Business Phone Number</h5>
				<form method="post" autocomplete="off">
					<label>Phone Number</label>
					<input type="tel" name="business_edit_value" value="<?php echo esc_attr($business_phone); ?>" required>
					<input type="hidden" name="business_edit_field" value="business_phone">
					<?php wp_nonce_field('edit_business_field', 'edit_business_nonce'); ?>
					<button type="submit">Save</button>
					<button type="button" class="custom-modal-close">Cancel</button>
				</form>
			</div>
		</div>

	
		<!-- Address Modal -->
		<?php
		$wc_countries = new WC_Countries();
		$countries = $wc_countries->get_countries();
		$states    = $wc_countries->get_states();
		?>
		<div id="modal-business-address" class="custom-modal-overlay" style="display:none;">
			<div class="custom-modal">
				<h5 class="mb-4">Edit Business Address</h5>
				<form method="post" autocomplete="off">
					<div class="form-group mb-3">
						<label>Address</label>
						<input type="text" name="business_edit_value" value="<?php echo esc_attr($business_address); ?>" required>
						<input type="hidden" name="business_edit_field" value="business_address">
					</div>
					<div class="form-group mb-3">
						<label>City</label>
						<input type="text" name="business_city" value="<?php echo esc_attr($business_city); ?>" required>
					</div>

					<div class="form-group mb-3">
						<label>Zip Code</label>
						<input type="text" name="business_zipcode" value="<?php echo esc_attr($business_zipcode); ?>" required>
					</div>

					<div class="form-group mb-3">
						<label>Country</label>
						<select name="business_country" id="business_country_select" required>
							<option value="">Select Country</option>
							<?php foreach ($countries as $code => $label): ?>
								<option value="<?php echo esc_attr($code); ?>" <?php selected($business_country, $code); ?>>
									<?php echo esc_html($label); ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="form-group mb-3">
						<label>State</label>
						<select name="business_state" id="business_state_select" required>
							<option value="">Select State</option>
							<?php
							if (!empty($business_country) && isset($states[$business_country])) {
								foreach ($states[$business_country] as $code => $label) {
									echo '<option value="' . esc_attr($code) . '" ' . selected($business_state, $code, false) . '>' . esc_html($label) . '</option>';
								}
							}
							?>
						</select>
					</div>
					<?php wp_nonce_field('edit_business_field', 'edit_business_nonce'); ?>
					<button type="submit">Save</button>
					<button type="button" class="custom-modal-close">Cancel</button>
				</form>
			</div>
		</div>


		<!-- Type Modal -->
		<div id="modal-business-type" class="custom-modal-overlay" style="display:none;">
			<div class="custom-modal">
				<h5 class="mb-4">Edit Business Type</h5>
				<form method="post" autocomplete="off">
					<label>Type</label>
					<input type="text" name="business_edit_value" value="<?php echo esc_attr($business_type); ?>" required>
					<input type="hidden" name="business_edit_field" value="business_type">
					<?php wp_nonce_field('edit_business_field', 'edit_business_nonce'); ?>
					<button type="submit">Save</button>
					<button type="button" class="custom-modal-close">Cancel</button>
				</form>
			</div>
		</div>


		<!-- Handle update, in PHP: After post, update that field and reload page -->

	<?php else:

		if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_business_profile']) && check_admin_referer('save_business_profile', 'business_profile_nonce')) {
			// Sanitize and save text fields
			$business_name     = sanitize_text_field($_POST['business_name']);
			$business_ein      = sanitize_text_field($_POST['business_ein']);
			$business_phone    = sanitize_text_field($_POST['business_phone']);
			$business_address  = sanitize_text_field($_POST['business_address']);
			$business_type     = sanitize_text_field($_POST['business_type']);

			update_user_meta($user_id, 'business_name', $business_name);
			update_user_meta($user_id, 'business_ein', $business_ein);
			update_user_meta($user_id, 'business_phone', $business_phone);
			update_user_meta($user_id, 'business_address', $business_address);
			update_user_meta($user_id, 'business_type', $business_type);

			// Handle optional file upload
			if (isset($_FILES['tax_document']) && !empty($_FILES['tax_document']['name'])) {
				$file = $_FILES['tax_document'];
				$allowed_types = ['application/pdf', 'image/jpeg', 'image/png'];
				if (in_array($file['type'], $allowed_types)) {
					require_once(ABSPATH . "wp-admin/includes/file.php");
					require_once(ABSPATH . "wp-admin/includes/media.php");
					require_once(ABSPATH . "wp-admin/includes/image.php");

					$attachment_id = media_handle_upload('tax_document', 0);
					if (!is_wp_error($attachment_id)) {
						update_user_meta($user_id, 'tax_document_id', $attachment_id);
					}
				}
			}

			// Redirect to profile section
			wp_redirect( esc_url( add_query_arg('profile-updated','1', wc_get_account_endpoint_url('business-profile') ) ) );
			exit;
		}
		?>
		<!-- FORM MODE (no data yet, show fields to fill in) -->
		 <div class="bg-white p-7 md:p-12 rounded-[15px] w-full custom-modal mx-auto">
			<form enctype="multipart/form-data" method="POST" id="initial-business-data">
				<?php wp_nonce_field('save_business_profile', 'business_profile_nonce'); ?>
				<input type="hidden" name="submit_business_profile" value="1">
				<div class="form-group mb-3">
					<label>Business Name</label>
					<input class="form-control w-full" type="text" name="business_name"
						value="<?php echo esc_attr($business_name); ?>" required>
				</div>
				<div class="form-group mb-3">
					<label>Employer Identification Number (EIN)</label>
					<input class="form-control w-full" type="text" name="business_ein"
						value="<?php echo esc_attr($ein); ?>">
				</div>
				<div class="form-group mb-3">
					<label>Business Phone Number</label>
					<input class="form-control w-full" type="tel" name="business_phone"
						value="<?php echo esc_attr($business_phone); ?>">
				</div>
				<div class="form-group mb-3">
					<label>Business Address</label>
					<input class="form-control w-full" type="text" name="business_address"
						value="<?php echo esc_attr($business_address); ?>">
				</div>
				<div class="form-group mb-3">
					<label>Business Type</label>
					<input class="form-control w-full" type="text" name="business_type"
						value="<?php echo esc_attr($business_type); ?>">
				</div>
				<div class="form-group mb-3">
					<label>Tax Exempt Document (PDF or image)</label>
					<input type="file" name="tax_document" accept="application/pdf,image/*">
				</div>
				<?php wp_nonce_field('save_business_profile', 'business_profile_nonce'); ?>
				<button type="submit" name="submit_business_profile" class="btn btn-primary !border-none">Save</button>
			</form>
		</div>
	<?php endif; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {

	const params = new URLSearchParams(window.location.search);
    if (params.has('profile-updated') && params.get('profile-updated') === '1') {
        document.querySelector('.business-profile-items-cover')?.classList.remove('hidden');
        document.querySelector('.business-profile-cards')?.classList.add('hidden');
    }




	var openBtn = document.getElementById('open-business-info-modal');
    if (openBtn) {
        openBtn.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector('.business-profile-items-cover').classList.remove('hidden');
			document.querySelector('.business-profile-cards').classList.add('hidden');
        });
    }

    // Open modal
    document.querySelectorAll('.edit-section').forEach(function(btn){
        btn.addEventListener('click', function() {
            document.getElementById(btn.dataset.modal).style.display = 'flex';
        });
    });

	// Close modal
    document.querySelectorAll('.custom-modal-close').forEach(function(btn){
        btn.addEventListener('click', function() {
            btn.closest('.custom-modal-overlay').style.display = 'none';
        });
    });

	document.querySelectorAll('.custom-modal-overlay').forEach(function(overlay) {
		overlay.addEventListener('click', function(e) {
			// Only close if clicked directly on overlay (not on modal or its children)
			if (e.target === overlay) {
				overlay.style.display = 'none';
			}
		});
	});

	document.getElementById('show-upload-tax-doc')?.addEventListener('click', function(e){
        e.preventDefault();
        document.getElementById('modal-upload-tax-doc').style.display = 'flex';
    });
})



</script>