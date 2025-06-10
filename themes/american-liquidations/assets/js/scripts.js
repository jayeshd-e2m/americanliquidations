var $ = jQuery.noConflict();

jQuery(document).ready(function($){

	if(jQuery('input[type="tel"]').length){
		document.querySelector('input[type="tel"]').addEventListener('input', function (e) {
			this.value = this.value.replace(/[^\d]/g, '');
		});
	}

	  
	var clickable = $( '.menu-state' ).attr( 'data-clickable' );
	$( '.mobile-header-nav li:has(ul)' ).addClass( 'has-sub' );
	$( '.mobile-header-nav .has-sub>a' ).after( '<em class="caret">' );
	$( '.mobile-header-nav .has-sub>.caret' ).addClass( 'trigger-caret' );
	

	/* menu open and close on single click */
	$( '.mobile-header-nav .has-sub>.trigger-caret' ).click( function() {
		var element = $( this ).parent( 'li' );
		if ( element.hasClass( 'is-open' ) ) {
			element.removeClass( 'is-open' );
			element.find( 'li' ).removeClass( 'is-open' );
			element.find( 'ul' ).slideUp( 200 );
		}
		else {
			element.addClass( 'is-open' );
			element.children( 'ul' ).slideDown( 200 ) ;
			element.siblings( 'li' ).children( 'ul' ).slideUp( 200 );
			element.siblings( 'li' ).removeClass( 'is-open' );
			element.siblings( 'li' ).find( 'li' ).removeClass( 'is-open' );
			element.siblings( 'li' ).find( 'ul' ).slideUp( 200 );
		}
	} );

	if($('.brand-slider').length){
		$('.brand-slider').slick({
			dots: false,
			infinite: true,
			speed: 300,
			slidesToShow: 6,
			slidesToScroll: 1,
			responsive: [
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 4,
						slidesToScroll: 4,
					}
				},
				{
					breakpoint: 600,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 3,
					}
				},
				{
					breakpoint: 480,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2,
					}
				}
			]
		});
	}

	// Mobile Menu
	jQuery('.mobile-humberger').on('click',function(){
		jQuery('.mobile-header-nav').addClass('active');
		jQuery('.mobile-header-overlay').addClass('active');
		jQuery('body').addClass('menu-active');
	})

	jQuery('.header-close-menu, .mobile-header-overlay').on('click',function(){
		jQuery('.mobile-header-nav').removeClass('active');
		jQuery('.mobile-header-overlay').removeClass('active');
		jQuery('body').removeClass('menu-active');
	})


	// product add to cart button

	$(document).on('click', '.custom-add-to-cart', function(e) {
        var $btn = $(this);
        $btn.addClass('loading');
    });

    // WooCommerce event after item added to cart via AJAX
    $(document.body).on('added_to_cart', function(event, fragments, cart_hash, $button) {
        $button.removeClass('loading');
    });

	// Gravity form
	function customFileUploadDesign(formId) {
		console.log('inside');
		const fileInput = document.querySelector("#input_2_8");
		// if (!fileInput) return;
	
		const container = fileInput.parentNode;
	
		// Remove any previous custom UI to avoid duplicates
		const existingCustomBox = container.querySelector('.custom-upload-wrapper');
		if (existingCustomBox) existingCustomBox.remove();
	
		// Check if GF's server-side preview for this field is present
		const previewList = container.querySelector('.ginput_preview_list');
	
		// Watch for deletion of the preview list (GF's delete button)
		if (previewList) {
			const observer = new MutationObserver(function (mutations) {
				mutations.forEach(function (mutation) {
					// If any children were removed (file preview was deleted)
					if (mutation.type === "childList") {
						// Check if the previewList is now empty
						if (previewList.children.length === 0) {
							// Remove previewList from DOM so it doesn't block rendering
							previewList.remove();
							// Re-render custom UI
							customFileUploadDesign(formId);
						}
					}
				});
			});
		
			observer.observe(previewList, { childList: true, subtree: false });
		
			// Hide file input while native preview exists
			fileInput.style.display = "none";
			return;
		}
	
		// Otherwise, render our custom UI
		const wrapper = document.createElement('div');
		wrapper.className = 'custom-upload-wrapper';
		container.insertBefore(wrapper, fileInput);
	
		// Hide the actual file input for styling
		fileInput.style.display = 'none';
	
		function renderUploadBox() {
			wrapper.innerHTML = '';
			const uploadBox = document.createElement('div');
			uploadBox.className = 'upload-box';
			uploadBox.textContent = "+ Upload a File";
			uploadBox.addEventListener("click", function () {
				fileInput.click();
			});
			wrapper.appendChild(uploadBox);
		}
	
		function renderFileBox(file) {
			wrapper.innerHTML = '';
			const fileBox = document.createElement('div');
			fileBox.className = 'file-box';
			fileBox.textContent = file.name;
	
			const deleteBtn = document.createElement('span');
			deleteBtn.className = 'dashicons dashicons-trash';
			deleteBtn.innerHTML = '';
			deleteBtn.title = "Delete File";
			deleteBtn.style.cursor = "pointer";
			deleteBtn.style.marginLeft = "12px";
			deleteBtn.addEventListener('click', function() {
				fileInput.value = '';
				renderUploadBox();
			});
			fileBox.appendChild(deleteBtn);
			wrapper.appendChild(fileBox);
		}
	
		// Initial render
		if (fileInput.files && fileInput.files.length > 0) {
			renderFileBox(fileInput.files[0]);
		} else {
			renderUploadBox();
		}
	
		// Keep in sync as user interacts
		fileInput.addEventListener("change", function () {
			if (fileInput.files && fileInput.files.length > 0) {
				renderFileBox(fileInput.files[0]);
			} else {
				renderUploadBox();
			}
		});
	}
	
	// Listen for GF render events and initial load
	jQuery(document).on('gform_post_render', function(event, formId){
		customFileUploadDesign(formId);
	});
	// jQuery(document).on('click', '.gform_delete_file', function() {
	// 	// jQuery(document).on('gform_post_render', function(event, formId){
	// 	setTimeout(function(){
	// 		customFileUploadDesign();
	// 	},1000)
	// 	// });
	// });
	//customFileUploadDesign();

	// Observe preview container AND file input changes
	// const observerTarget = container;

	// const observer = new MutationObserver(() => {
	// 	const hasPreview = container.querySelector(".ginput_preview");
	// 	const fileValue = fileInput.value;

	// 	if (!hasPreview && !fileValue) {
	// 	uploadBox.textContent = "+ Upload a File";
	// 	}
	// });

	// observer.observe(observerTarget, {
	// 	childList: true,
	// 	subtree: true,
	// });

	
	
	// setInterval(function(){
	// 	jQuery('.ginput_container').each(function(){
	// 		if(jQuery(this).find('.upload-box').length < 2){
	// 			console.log('in');
	// 			const fileInput = document.querySelector("#input_2_8");

	// 			// if (!fileInput) return;

	// 			const container = fileInput.parentNode;

	// 			// Create and insert custom styled upload box
	// 			const uploadBox = document.createElement("div");
	// 			uploadBox.className = "upload-box";
	// 			uploadBox.textContent = "+ Upload a File";
	// 			container.insertBefore(uploadBox, fileInput);

	// 			// Update box when file is selected
	// 			fileInput.addEventListener("change", function () {
	// 				if (fileInput.files.length > 0) {
	// 				uploadBox.textContent = fileInput.files[0].name;
	// 				} else {
	// 				uploadBox.textContent = "+ Upload a File";
	// 				}
	// 			});
	// 		}
	// 	})
	// },1000)
	


})

jQuery(window).scroll(function(){
	 
})

jQuery(window).on("load",function(){
	 
});
