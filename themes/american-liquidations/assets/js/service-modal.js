jQuery(document).ready(function($) {
	// function openModal(content) {
	// 	console.log("in cnt");
	// 	console.log(content);
	//   $('#service-modal-body').html(content);
	//   $('#service-modal').removeClass('hidden').addClass('flex');
	// }
  
	function loadserviceMember(postId,postnumber) {
	  $.ajax({
		url: service_ajax_obj.ajax_url,
		type: 'POST',
		data: {
		  action: 'load_service_member',
		  post_id: postId,
		  post_number: postnumber,
		  nonce: service_ajax_obj.nonce
		},
		success: function(response) {
		  if (response.success) {
			// openModal(response.data.html);
			setTimeout(function(){
				$('.service-modal-body').html(response.data.html);
				etEqualHeightInH4R();
			},100)
			
		  } else {
			alert('Failed to load content.');
		  }
		}
	  });
	}
  
	$(document).on('click', '.read-service-btn', function(e) {
		e.preventDefault();
		$('#service-modal').addClass('active').addClass('flex');
		let postId = $(this).data('id');
		let postnumber = $(this).data('number');
		postnumber = String(postnumber).padStart(2, '0');
		loadserviceMember(postId,postnumber);
		lockBodyScroll();

		etEqualHeightInH4R();
	});
  
	$(document).on('click', '#service-modal-close', function() {
	  $('#service-modal').removeClass('active').removeClass('flex');
	  unlockBodyScroll();
	  $('.service-modal-body').html("");
	});
  
	// Handle next service member click
	$(document).on('click', '#next-service-member', function() {
	  let nextId = $(this).data('id');
	  loadserviceMember(nextId);
	});

	$(document).on('keydown', function(e) {
		if (e.key === "Escape") {
			$('#service-modal').removeClass('active').removeClass('flex');
			unlockBodyScroll();
			$('.service-modal-body').html("");
		}
	});

	let scrollTop = 0;

	function lockBodyScroll() {
		scrollTop = window.scrollY || document.documentElement.scrollTop;
		const scrollBarWidth = window.innerWidth - document.documentElement.clientWidth;

		document.body.style.top = `-${scrollTop}px`;
		document.body.style.position = 'fixed';
		document.body.style.width = '100%';
		document.body.style.paddingRight = `${scrollBarWidth}px`;
		$('body').addClass('is-service-popup');
	}

	function unlockBodyScroll() {
		document.body.style.position = '';
		document.body.style.top = '';
		document.body.style.width = '';
		document.body.style.paddingRight = '';
		window.scrollTo(0, scrollTop);
		$('body').removeClass('is-service-popup');
	}

  });
  

  function etEqualHeightInH4R(){
	const rows = document.querySelectorAll(".service-popup-cnt .wp-block-columns");
  
	rows.forEach(row => {
	  const columns = row.querySelectorAll("h4:not(.wp-block-heading)");
	  let maxHeight = 0;
  
	  // Reset heights to auto before recalculating
	  columns.forEach(col => {
		col.style.height = 'auto';
	  });
  
	  // Get the tallest column height
	  columns.forEach(col => {
		const height = col.offsetHeight;
		if (height > maxHeight) maxHeight = height;
	  });
  
	  // Apply the tallest height to all columns
	  columns.forEach(col => {
		col.style.height = maxHeight + "px";
	  });
	});
  }