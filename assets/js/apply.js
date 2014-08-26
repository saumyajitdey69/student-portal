$(document).ready(function(){
	$('#preference2').attr('disabled','disabled');
	$('#preference1').on("change",function(e){
		$('#preference2').attr('disabled','disabled');
		if($('#preference1').val()!="")
			$('#preference2').removeAttr('disabled','disabled');
		$('#preference2').val("");
		$('#preference2 option').each( function(e){
			$(this).removeClass('hidden');
			if($(this).val()==$('#preference1').val() && $(this).val()!="")
				$(this).addClass('hidden');
		});
	});
});