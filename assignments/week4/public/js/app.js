$(function() {
	$('.comment-form').on('submit', function(e) {
		e.preventDefault();

		var $self = $(this);

		$.ajax({
			url: '/comments',
			type: 'POST',
			data: $(this).serialize(),
			success: function(res) {
				// Find the list of comments for this blog post.
				$self.prevAll('#comments').append(res);

				// Reset the form.
				$self.find('textarea').val('');
			}
		});
	});
});