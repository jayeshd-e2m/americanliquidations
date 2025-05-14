jQuery(document).ready(function($) {
	// function openModal(content) {
	// 	console.log("in cnt");
	// 	console.log(content);
	//   $('#team-modal-body').html(content);
	//   $('#team-modal').removeClass('hidden').addClass('flex');
	// }
  
	function loadTeamMember(postId) {
	  $.ajax({
		url: team_ajax_obj.ajax_url,
		type: 'POST',
		data: {
		  action: 'load_team_member',
		  post_id: postId,
		  nonce: team_ajax_obj.nonce
		},
		success: function(response) {
		  if (response.success) {
			// openModal(response.data.html);
			setTimeout(function(){
				$('.team-modal-body').html(response.data.html);
				$('.custom-scrollbar').mCustomScrollbar('scrollTo', 'top'); 
			},100)
			
		  } else {
			alert('Failed to load content.');
		  }
		}
	  });
	}
  
	$(document).on('click', '.read-more-btn', function() {
		console.log('read-click');
		$('#team-modal').addClass('active').addClass('flex');
		let postId = $(this).data('id');
		loadTeamMember(postId);
		lockBodyScroll();
	});
  
	$(document).on('click', '#team-modal-close', function() {
	  $('#team-modal').removeClass('active').removeClass('flex');
	  unlockBodyScroll();
	  $('.team-modal-body').html("");
	});
  
	// Handle next team member click
	$(document).on('click', '#next-team-member', function() {
	  let nextId = $(this).data('id');
	  loadTeamMember(nextId);
	});

	$(document).on('keydown', function(e) {
		if (e.key === "Escape") {
			$('#team-modal').removeClass('active').removeClass('flex');
			unlockBodyScroll();
			$('.team-modal-body').html("");
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
		$('body').addClass('is-team-popup');
	}

	function unlockBodyScroll() {
		document.body.style.position = '';
		document.body.style.top = '';
		document.body.style.width = '';
		document.body.style.paddingRight = '';
		window.scrollTo(0, scrollTop);
		$('body').removeClass('is-team-popup');
	}

  });
  