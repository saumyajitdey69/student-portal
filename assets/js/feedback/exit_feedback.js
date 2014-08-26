$(document).ready(function() {

	// $('.about_details').hide();
	$('.academics-A').hide();
	$('.academics-B').hide();
	$('.academics-C').hide();
	$('.experiences_div').hide();
	$('.goals_div').hide();
	$('.extra_curricular_div').hide();	
	$('.changes_div').hide();
	$('.overall-A').hide();
	$('.overall-B').hide();
	$('.overall-C').hide();
	$("#t_submit").hide();
	$(".select-row").closest('tr').hide();
	$("#t1").closest('tr').show();

	var inputs = $('input, textarea, select, button');
    inputs.on('keydown', function (e) {
        if (e.keyCode == 9 || e.which == 9) {
            e.preventDefault();
        }
    });
    Object.defineProperty(console, '_commandLineAPI', {
        get: function () {
            throw 'Don\'t run javascript.'
        }
    })
});

$('.select-row').on('change', function() {
	if($(this).val()==="")
		return;
	var row=$(this).closest('tr');
	if(row.is($(".about_details tr").last()))
	{
		$('.academics-A').show();
		$("#t2").closest('tr').show();
		return;	
	}
	if(row.is($(".academics-A tr").last()))
	{
		$('.academics-B').show();
		$("#t3").closest('tr').show();
		return;	
	}
	if(row.is($(".academics-B tr").last()))
	{
		$('.academics-C').show();
		$("#t4").closest('tr').show();
		return;	
	}
	if(row.is($(".academics-C tr").last()))
	{
		$('.experiences_div').show();
		$("#t5").closest('tr').show();
		return;	
	}
	if(row.is($(".experiences_div tr").last()))
	{
		$('.goals_div').show();
		$("#t6").closest('tr').show();
		return;	
	}
	if(row.is($(".goals_div tr").last()))
	{
		$('.extra_curricular_div').show();
		$("#t7").closest('tr').show();
		return;	
	}
	if(row.is($(".extra_curricular_div tr").last()))
	{
		$('.changes_div').show();
		$("#t8").closest('tr').show();
		return;	
	}
	if(row.is($(".changes_div tr").last()))
	{
		$('.overall-A').show();
		$("#t9").closest('tr').show();
		return;	
	}
	if(row.is($(".overall-A tr").last()))
	{
		$('.overall-B').show();
		$("#t10").closest('tr').show();
		return;	
	}
	if(row.is($(".overall-B tr").last()))
	{
		$('.overall-C').show();
		$("#t11").closest('tr').show();
		return;	
	}
	if(row.is($(".overall-C tr").last()))
	{
		$("#t_submit").show();
		return;	
	}
	row.next().show();
	//row.next().find('select').focus();
});