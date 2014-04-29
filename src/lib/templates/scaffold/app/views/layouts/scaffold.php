<html>
<head>
	<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">

	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<?= $content ?>
	</div>

	<script>
		//
		// Restfulize any hyperlinks that contain a data-method attribute by
		// creating a mini form with the specified method and adding a trigger
		// within the link.
		//
		// Example:
		//
		//     <a href="post/1" data-method="delete">destroy</a>
		//
		// Triggers the route Route::delete('post/(:id)')
		//

		$('[data-method]').append(function(){ return "\n"+
			"<form action='"+$(this).attr('href')+"' method='POST' style='display:none'>\n"+
			"   <input type='hidden' name='_method' value='"+$(this).attr('data-method')+"'>\n"+
			"</form>\n"
		})
		.removeAttr('href')
		.attr('style','cursor:pointer;')
		.on('click', function() {
			var self = $(this);
			var message = 'Are you sure you wish to remove this record?';

			if (self.attr('data-message')) {
				message = self.attr('data-message');
			}

			if (message == 'none') {
				return self.find('form').submit();
			}

			if(confirm(message))
			{
				self.find('form').submit();
			}
		});
	</script>
</body>
</html>