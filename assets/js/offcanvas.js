$(document).ready(function() {
	$('.helper_modal').click(function (e) {
		var source = $(this).data('src');
		var title = $(this).data('heading');
		$.ajax({
			url: source,
			type: 'post',
			data: {},
			beforeSend: function(){
				$('#helper_modal .modal-title').html(title);
				$('#helper_modal .modal-body').html("loading...");
			},
			success: function (data) {
				$('#helper_modal .modal-body').html(data);
			}
		});
	});

	$('.discard_confirm').click(function (e) {
		$.ajax({
			url: '../../detail/discard_confirm',
			type: 'post',
			data: {'discard':true},
			beforeSend: function(){
				$('.alert').alert('close');
				$('#discard_modal .modal-body').html("Processing your request. Please wait <br><br><p class='text-danger'>Refresh/reload if the page does not respond and try again<p>");
			},
			success: function (data) {
				$('#discard_modal').modal('hide');
				data = jQuery.parseJSON(data);
				if(data.status == 0)
				{
					var alert = '<div class="alert alert-danger"><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>'+data.message+'</div>';
					$('#discard_modal .modal-body').html("<p class='text-danger'>Refresh/reload the page to use this feature<p>");
					$('#wrapper').prepend(alert);
				}
				else
				{
					location.assign(data.message);
				}
			}
		});
	});
	$('.tips').tooltip();$('.pops').popover();
	$(document).keypress("q", function(e) {
		if(e.ctrlKey && e.which == 17)
			introJs().start();
	});
});

$(document).ready(function()
{
    var ctrlDown = false;
    var shiftDown = false;
    var ctrlKey = 17, cKey = 67;
    var shiftKey = 163;

    $(document).keydown(function(e)
    {
        if (e.keyCode == ctrlKey) ctrlDown = true;
        if (e.keyCode == shiftKey) shiftDown = true;
    }).keyup(function(e)
    {
        if (e.keyCode == ctrlKey) ctrlDown = false;
        if (e.keyCode == shiftKey) shiftDown = false;
    });

    $(document).keydown(function(e)
    {
        if ( (e.keyCode == cKey)) {
           alert("Console is disabled. The instance will be reported. Do not use console it may lead to blocking of online services including OMAHA and results.");
           console.log('%cUnusual activity on student portal. Reported to Administration.', 'color:red')
        }
    });
});