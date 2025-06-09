<?php
$user_id = get_current_user_id();
$addresses = get_user_meta($user_id, 'custom_addresses', true);
$addresses = is_array($addresses) ? $addresses : [];
?>




<div id="address-list">
    <?php if (!empty($addresses)) : ?>
			<?php foreach ($addresses as $index => $address) : ?>

				<div class="info-section bg-white p-7 md:p-12 rounded-[15px] w-full mb-5" data-index="<?= $index ?>">
					<div class="info-item-inner relative md:pr-[210px]">
						<div class="flex items-center gap-4 md:gap-6 mb-8 md:mb-4 flex-wrap lg:flex-nowrap">
							<h4 class="text-[20px] text-primary/60 font-inter"><?= esc_html($address['address'] ?? '---') ?></h4>
							<?php if (!empty($address['is_business_default'])): ?>
								<p class="text-sm font-bold">Business (Default)</p>
							<?php endif; ?>

							<?php if (!empty($address['is_delivery_default'])): ?>
								<p class="text-sm font-bold">Delivery (Default)</p>
							<?php endif; ?>
						</div>
						<div class="flex items-center md:absolute top-0 right-0 gap-6 mb-8 md:mb-0">
							<button class="edit-address text-black/60 hover:text-black text-sm font-bold" 
							data-index="<?= $index ?>"
							data-address='<?= json_encode($address) ?>'>Edit</button>
							<button class="delete-address text-primary/60 hover:text-primary text-sm font-bold" data-index="<?= $index ?>">Delete this Address</button>
						</div>
						<div class="flex gap-24 text-xs uppercase mb-8">
						<?php
						$countries = WC()->countries->get_countries();
						$country_code = $address['country'] ?? '';
						$country_name = $countries[$country_code] ?? $country_code ?: '---';
						?>
							<p><?= esc_html($address['address'] ?? '---') ?> <?= esc_html($address['address_2'] ?? '---') ?>, <?= esc_html($address['city'] ?? '---') ?> <?= esc_html($address['zipcode'] ?? '---') ?> <?= esc_html($country_name ?? '---') ?></p>
						</div>
						<div class="flex text-xs gap-y-4 gap-x-10 flex-wrap md:flex-nowrap">
							<?php
							$zone_code = $address['zone'] ?? '';
							$country_code = $address['country'] ?? '';
							$states = WC()->countries->get_states();
							$zone_name = $states[$country_code][$zone_code] ?? $zone_code ?: '---';
							?>
							<p><span class="text-black/40 mr-3">Zone: </span><?= esc_html($zone_name) ?></p>
							<p><span class="text-black/40 mr-3">Is a storage unit facility? </span><?= esc_html($address['storage_facility'] ?? '---') ?></p>
							<p><span class="text-black/40 mr-3">Requires a liftgate? </span><?= esc_html($address['liftgate'] ?? '---') ?></p>
							<p><span class="text-black/40 mr-3">Can receive 53 foot trucks? </span><?= esc_html($address['can_receive_truck'] ?? '---') ?></p>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
    <?php else : ?>
        <p>No addresses found.</p>
    <?php endif; ?>
</div>

<button class="edit-section btn !bg-white !text-primary/60 hover:!bg-primary hover:!text-white !border-none !font-bold !capitalize !py-5 font-inter !rounded-[15px]" style="letter-spacing: 0;width: 100%;transition: 0.4s ease;" data-modal="modal-address-book">+ Add New Address</button>

<!-- Address Book -->
<div id="modal-address-book" class="custom-modal-overlay" style="display:none;">
	<div class="custom-modal">
		<h5 class="mb-4">Address Book</h5>
		<form id="add-address-form">
			<input type="hidden" name="index" value="">
			<input type="hidden" name="action" value="">
			<div class="mb-3">
				<label class="text-xs">Address Line 1</label>
				<input name="address" required><br>
			</div>
			<div class="mb-3">
				<label class="text-xs">Address Line 2</label>
				<input name="address_2" ><br>
			</div>
			<div class="mb-3">
				<label class="text-xs">City</label>
				<input name="city" required><br>
			</div>
			<div class="mb-3">
				<label class="text-xs">Zipcode</label>
				<input name="zipcode" required><br>
			</div>
			<div class="mb-3">
				<label class="text-xs">Country</label>
				<select name="country" id="country-select" class="p-1 border border-[#0703030d] w-full text-xs rounded-[4px]" required></select>
				<script>
					const wc_countries = <?php echo json_encode(WC()->countries->get_countries()); ?>;

					document.addEventListener('DOMContentLoaded', function () {
						const countrySelect = document.getElementById('country-select');
						if (countrySelect && typeof wc_countries === 'object') {
							for (const [code, name] of Object.entries(wc_countries)) {
								const option = document.createElement('option');
								option.value = code;
								option.textContent = name;
								countrySelect.appendChild(option);
							}
						}
					});

				</script>
			</div>
			<div class="mb-3">
				<label class="text-xs">State</label>
				<select name="zone" id="state-select" class="p-1 border border-[#0703030d] w-full text-xs rounded-[4px]" required>
					<option value="">Select a state</option>
				</select>
				<script>
					const wc_states = <?php echo json_encode(WC()->countries->get_states()); ?>;
					document.addEventListener('DOMContentLoaded', function () {
					const countrySelect = document.getElementById('country-select');
					const stateSelect = document.getElementById('state-select');

					// On country change
					if (countrySelect) {
						populateStates(countrySelect.value, stateSelect);
						countrySelect.addEventListener('change', function () {
							populateStates(this.value, stateSelect);
						});
					}
				});

				</script>
			</div>
			<div class="mb-3">
				<label class="text-xs">Is a storage unit facility?</label>
				<select class="p-1 border border-[#0703030d] w-full text-xs rounded-[4px]" name="storage_facility" required>
					<option value="No">No</option>
					<option value="Yes">Yes</option>
				</select>
			</div>
			<div class="mb-3">
				<label class="text-xs">Requires a liftgate?</label>
				<select class="p-1 border border-[#0703030d] w-full text-xs rounded-[4px]" name="liftgate" required>
					<option value="No">No</option>
					<option value="Yes">Yes</option>
				</select>
			</div>
			<div class="mb-3">
				<label class="text-xs">Can receive 53 foot trucks?</label>
				<select class="p-1 border border-[#0703030d] w-full text-xs rounded-[4px]" name="can_receive_truck" required>
					<option value="No">No</option>
					<option value="Yes">Yes</option>
				</select>
			</div>
			<div class="mb-3 flex gap-6">
				<label class="text-xs flex items-center gap-2">
					<input type="checkbox" name="is_business_default" value="1">
					Business (Default)
				</label>
				<label class="text-xs flex items-center gap-2">
					<input type="checkbox" name="is_delivery_default" value="1">
					Delivery (Default)
				</label>
			</div>
			<button type="button" class="custom-modal-close">Cancel</button>
			<button type="submit">Save Address</button>
		</form>
	</div>
</div>

<script>
	document.querySelectorAll('.edit-section').forEach(function(btn){
		btn.addEventListener('click', function() {
			const modalId = btn.dataset.modal;
			const modal = document.getElementById(modalId);
			const form = modal.querySelector('form');

			// Clear all form fields
			form.reset();

			// Clear hidden index (in case editing was previously triggered)
			form.index.value = '';

			// Show modal
			modal.style.display = 'flex';
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

	document.getElementById('add-address-form').addEventListener('submit', function(e) {
		e.preventDefault();

		const formData = new FormData(this);
		formData.append('action', 'add_custom_address');

		fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
			method: 'POST',
			body: formData,
		}).then(res => res.json()).then(data => {
			if (data.success) {
				location.reload();
			} else {
				alert('Failed to save address.');
				console.log(data); // Debug output
			}
		});
	});

	// Edit button
	document.querySelectorAll('.edit-address').forEach(function(btn) {
		btn.addEventListener('click', function(e) {
			e.preventDefault();
			const data = JSON.parse(btn.dataset.address);
			const form = document.getElementById('add-address-form');

			// Fill form fields
			form.address.value = data.address || '';
			form.address_2.value = data.address_2 || '';
			form.city.value = data.city || '';
			form.zipcode.value = data.zipcode || '';
			form.querySelector('select[name="country"]').value = data.country || '';

			// Populate states dynamically before setting zone
			populateStates(data.country || '', form.zone);
			setTimeout(() => {
				form.zone.value = data.zone || '';
			}, 50);

			// Use small delay to ensure options are populated
			setTimeout(() => {
				form.querySelector('select[name="zone"]').value = data.zone || '';
			}, 200); // 50ms is usually enough

			form.storage_facility.value = data.storage_facility || 'No';
			form.liftgate.value = data.liftgate || 'No';
			form.can_receive_truck.value = data.can_receive_truck || 'No';
			form.index.value = btn.dataset.index;

			form.is_business_default.checked = data.is_business_default === true || data.is_business_default === '1';
			form.is_delivery_default.checked = data.is_delivery_default === true || data.is_delivery_default === '1';

			document.getElementById('modal-address-book').style.display = 'flex';
		});

		
	});





	// Delete functionality
	document.querySelectorAll('.delete-address').forEach(function(btn) {
		btn.addEventListener('click', function(e) {
			e.preventDefault();
			const index = btn.dataset.index;

			if (!confirm('Are you sure you want to delete this address?')) return;

			const formData = new FormData();
			formData.append('action', 'delete_custom_address');
			formData.append('index', index);

			fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
				method: 'POST',
				body: formData,
			}).then(res => res.json()).then(data => {
				if (data.success) {
					location.reload();
				} else {
					alert('Failed to delete address.');
				}
			});
		});
	});

</script>

<script>
// jQuery(document).ready(function($) {
//     $('#your-submit-button-id').on('click', function(e) {
//         e.preventDefault();

//         var index = $('#hidden-index-field').val(); // If editing
//         var address = $('#input-address').val();
//         var city = $('#input-city').val();
//         var zipcode = $('#input-zipcode').val();
//         var country = $('#input-country').val();
//         var zone = $('#input-zone').val();
//         var storage_facility = $('#input-storage_facility').val();
//         var liftgate = $('#input-liftgate').val();
//         var can_receive_truck = $('#input-can_receive_truck').val();

//         $.ajax({
//             url: '<?php echo admin_url('admin-ajax.php'); ?>',
//             method: 'POST',
//             data: {
//                 action: 'add_custom_address',
//                 index: index,
//                 address: address,
//                 city: city,
//                 zipcode: zipcode,
//                 country: country,
//                 zone: zone,
//                 storage_facility: storage_facility,
//                 liftgate: liftgate,
//                 can_receive_truck: can_receive_truck,
//                 is_business_default: $('#is_business_default').is(':checked'),
//                 is_delivery_default: $('#is_delivery_default').is(':checked')
//             },
//             success: function(response) {
//                 if (response.success) {
//                     // Reload or update address list dynamically
//                     alert('Address saved successfully!');
//                     location.reload(); // or call your re-render logic
//                 } else {
//                     alert('Something went wrong.');
//                 }
//             }
//         });
//     });
// });

function populateStates(countryCode, stateSelect) {
	stateSelect.innerHTML = '';

	const states = wc_states[countryCode] || {};
	const hasStates = Object.keys(states).length > 0;

	if (!hasStates) {
		stateSelect.innerHTML = '<option value="">N/A</option>';
		stateSelect.disabled = true;
		return;
	}

	stateSelect.disabled = false;
	stateSelect.innerHTML = '<option value="">Select a state</option>';

	Object.entries(states).forEach(([code, name]) => {
		const option = document.createElement('option');
		option.value = code;
		option.textContent = name;
		stateSelect.appendChild(option);
	});
}
</script>
