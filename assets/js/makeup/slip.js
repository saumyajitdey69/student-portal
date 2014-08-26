function update () {
	var id, sem, year;
	var el = $(this);
	id = el.closest('tr').find('.id').html();
	sem = el.closest('tr').find('.sem').val();
	year = el.closest('tr').find('.year').val();
	// console.log(id + sem + year);
	el.button('loading');
	$.ajax({
			url: 'update_courses_details',
			type: 'post',
			data: {'id':id, 'sem':sem, 'year':year},
			success: function (data) {
				data = JSON.parse(data);
				if(data.code == "1")
				{
					show_error(data.message, false);
					el.button('reset');
				}
				else
				{
					show_error(data.message, true);
					el.button('reset');
				}
				el.button('reset');
			}
		});
}

$(function() {
	$(document).on('click', ".btn-update", update);
	// window.onbeforeunload = confirmOnPageExit;
});
