<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.7.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Hook - woocommerce_before_edit_account_form.
 *
 * @since 2.6.0
 */
do_action( 'woocommerce_before_edit_account_form' );
?>


<?php
$current_user = wp_get_current_user();
?>

<div class="myaccount-tabs-wrapper">
    <div class="myaccount-tabs flex gap-5 mb-5">
        <button class="tab-link active bg-white text-black/60 px-[30px] py-[10px] rounded-[15px] font-bold text-sm hover:bg-primary hover:text-white" data-tab="tab-general-info">General Information</button>
        <button class="tab-link bg-white text-black/60 px-[30px] py-[10px] rounded-[15px] font-bold text-sm hover:bg-primary hover:text-white" data-tab="tab-login-security">Login & Security</button>
    </div>

    <!-- General Information Tab -->
    <div class="tab-content active" id="tab-general-info">
		<div class="info-section bg-white p-12 rounded-[15px]">
			<div class="info-item-inner relative pr-10">
				<div class="section-label text-[20px] font-bold mb-10">Legal Name</div>
				<div class="flex gap-24">
					<div class="text-sm">
						<span class="font-semibold block mb-2">First Name</span>
						<?php echo !empty($current_user->first_name) ? esc_html($current_user->first_name) : '---'; ?>
					</div>
					<div class="text-sm">
						<span class="font-semibold block mb-2">Middle Name</span>
						<?php 
							$middle_name = get_user_meta($current_user->ID, 'middle_name', true);
							echo !empty($middle_name) ? esc_html($middle_name) : '---'; 
						?>
					</div>
					<div class="text-sm">
						<span class="font-semibold block mb-2">Last Name</span>
						<?php echo !empty($current_user->last_name) ? esc_html($current_user->last_name) : '---'; ?>
					</div>
				</div>
				<button class="edit-section absolute top-0 right-0 text-primary/60 text-sm font-semibold" data-modal="modal-legal-name">Edit</button>
			</div>
		</div>
		<div class="flex mt-5 gap-5">
			<div class="info-section bg-white p-12 rounded-[15px] w-full md:w-1/2">
				<div class="info-item-inner relative pr-10">
					<div class="section-label text-[20px] font-bold mb-10">Email Address</div>
					<div class="flex gap-24">
						<div class="text-sm">
							<?php echo !empty($current_user->user_email) ? esc_html($current_user->user_email) : '---'; ?>
						</div>
					</div>
					<button class="edit-section absolute top-0 right-0 text-primary/60 text-sm font-semibold" data-modal="modal-email">Edit</button>
				</div>
			</div>
			<div class="info-section bg-white p-12 rounded-[15px] w-full md:w-1/2">
				<div class="info-item-inner relative pr-10">
					<div class="section-label text-[20px] font-bold mb-10">Phone Number</div>
					<div class="flex gap-24">
						<div class="text-sm">
						<?php
						$phone = get_user_meta( $current_user->ID, 'user_phone', true );
						echo $phone ? esc_html($phone) : '---';
						?>
						</div>
					</div>
					<button class="edit-section absolute top-0 right-0 text-primary/60 text-sm font-semibold" data-modal="modal-phone">Edit</button>
				</div>
			</div>
		</div>
        <!-- you can add Phone, etc., similarly -->
    </div>

    <!-- Login & Security Tab (can keep empty initially or add content as needed) -->
	<div class="tab-content" id="tab-login-security">
		<div class="info-section bg-white p-12 rounded-[15px] w-full md:w-1/2">
			<div class="info-item-inner relative pr-10">
				<div class="section-label text-[20px] font-bold mb-10">Password</div>
				<div class="flex gap-24">
					<div class="text-sm">******************** <button class="edit-section text-primary/60 text-sm font-semibold ml-4" data-modal="modal-password">Change Password</button></div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Legal Name Modal -->
<div id="modal-legal-name" class="custom-modal-overlay" style="display:none;">
    <div class="custom-modal">
        <h5 class="mb-4">Edit Legal Name</h5>
        <form id="form-edit-legal-name">
			<div class="mb-3">
				<label>First Name</label>
				<input type="text" name="first_name" value="<?php echo esc_attr($current_user->first_name); ?>" required>
			</div>
			<div class="mb-3">
				<label>Middle Name</label>
				<input type="text" name="middle_name" value="<?php echo esc_attr(get_user_meta($current_user->ID, 'middle_name', true)); ?>">
			</div>
			<div>
				<label>Last Name</label>
				<input type="text" name="last_name" value="<?php echo esc_attr($current_user->last_name); ?>" required>
			</div>
            <input type="hidden" name="user_id" value="<?php echo get_current_user_id(); ?>">
            <button type="submit">Save</button>
            <button type="button" class="custom-modal-close">Cancel</button>
        </form>
    </div>
</div>

<!-- Email Modal -->
<div id="modal-email" class="custom-modal-overlay" style="display:none;">
    <div class="custom-modal">
        <h5 class="mb-4">Edit Email</h5>
        <form id="form-edit-email">
            <label>Email</label>
            <input type="email" name="user_email" value="<?php echo esc_attr($current_user->user_email); ?>" required>
            <input type="hidden" name="user_id" value="<?php echo get_current_user_id(); ?>">
            <button type="submit">Save</button>
            <button type="button" class="custom-modal-close">Cancel</button>
        </form>
    </div>
</div>

<!-- Phone Number Modal -->
<div id="modal-phone" class="custom-modal-overlay" style="display:none;">
    <div class="custom-modal">
        <h5 class="mb-4">Edit Phone Number</h5>
        <form id="form-edit-phone">
            <label>Phone Number</label>
            <input 
				type="text" 
				name="user_phone" 
				id="user_phone_input"
				value="<?php echo esc_attr(get_user_meta($current_user->ID, 'user_phone', true)); ?>"
				placeholder="(123) 456-7890"
				inputmode="tel"
				maxlength="14" 
				autocomplete="off"
				required
			>
            <input type="hidden" name="user_id" value="<?php echo get_current_user_id(); ?>">
            <button type="submit">Save</button>
            <button type="button" class="custom-modal-close">Cancel</button>
        </form>
    </div>
</div>

<!-- Password Modal -->
<div id="modal-password" class="custom-modal-overlay" style="display:none;">
    <div class="custom-modal">
        <h5 class="mb-4">Change Password</h5>
        <form id="form-edit-password">
            <div class="mb-3">
                <label>New Password</label>
                <input type="password" name="new_password" required minlength="6" autocomplete="new-password">
            </div>
            <div>
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" required minlength="6" autocomplete="new-password">
            </div>
            <input type="hidden" name="user_id" value="<?php echo get_current_user_id(); ?>">
            <button type="submit">Save</button>
            <button type="button" class="custom-modal-close">Cancel</button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab functionality
    document.querySelectorAll('.tab-link').forEach(function(btn){
		btn.addEventListener('click', function() {
			document.querySelectorAll('.tab-link').forEach(b=>b.classList.remove('active'));
			document.querySelectorAll('.tab-content').forEach(tc=>tc.classList.remove('active'));
			btn.classList.add('active');
			document.getElementById(btn.dataset.tab).classList.add('active');
		});
	});


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

    // AJAX form submissions
    document.getElementById('form-edit-legal-name').addEventListener('submit', function(e){
        e.preventDefault();
        let form = e.target;
        let data = new FormData(form);
        data.append('action', 'edit_legal_name');
        fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
            method: 'POST',
            body: data,
        })
        .then(resp=>resp.json())
        .then(res=>{
            if(res.success){
                location.reload(); // reload to reflect changes, or update DOM dynamically
            }else{
                alert("Error: " + res.data);
            }
        });
    });

    document.getElementById('form-edit-email').addEventListener('submit', function(e){
        e.preventDefault();
        let form = e.target;
        let data = new FormData(form);
        data.append('action', 'edit_user_email');
        fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
            method: 'POST',
            body: data,
        })
        .then(resp=>resp.json())
        .then(res=>{
            if(res.success){
                location.reload();
            }else{
                alert("Error: " + res.data);
            }
        });
    });


	// Input type phonenumber
	document.getElementById('form-edit-phone').addEventListener('submit', function(e){
		e.preventDefault();
		let form = e.target;
		let data = new FormData(form);
		data.append('action', 'edit_user_phone'); // must match PHP action!
		fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
			method: 'POST',
			body: data,
		})
		.then(resp=>resp.json())
		.then(res=>{
			if(res.success){
				location.reload();
			}else{
				alert("Error: " + res.data);
			}
		});
	});


	document.getElementById('form-edit-password').addEventListener('submit', function(e){
		e.preventDefault();
		let form = e.target;
		let newPass = form.new_password.value.trim();
		let confirmPass = form.confirm_password.value.trim();
		if(newPass.length < 6) {
			alert('Password must be at least 6 characters.');
			return;
		}
		if(newPass !== confirmPass) {
			alert('Passwords do not match.');
			return;
		}
		let data = new FormData(form);
		data.append('action', 'edit_user_password');
		fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
			method: 'POST',
			body: data,
		})
		.then(resp=>resp.json())
		.then(res=>{
			if(res.success){
				location.reload();
			}else{
				alert("Error: " + res.data);
			}
		});
	});



});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    new Cleave('#user_phone_input', {
        delimiters: ['(', ') ', '-'],
        blocks: [0, 3, 3, 4],
        numericOnly: true
    });
});

</script>

<?php do_action( 'woocommerce_after_edit_account_form' ); ?>
