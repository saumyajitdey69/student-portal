var base_url = '/student/hostels/';
function submit_payment_detail () {
	var method_id = $('#paymentMethod').val();
	var payment_ammount = $('#paymentAmmount').val();
	var payment_date = $('#paymentDate').val();
	if(!(payment_date && method_id && parseFloat(payment_ammount)))
		return false;
	$.ajax({
		url: base_url+ 'add_payment_info/',
		type: 'POST',
		data: {
			'method_id': method_id,
			'payment_ammount': payment_ammount,
			'payment_date': payment_date
		},
		beforeSend:function(){
		},
		success: function (response_code) {
			switch(response_code) {
				case 'success':
					window.location.replace("./home");
					break;
			}
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			show_error("Error occured! Please try again.");
			return false;
		}
	});

}

function floorLookup () {
	var hostel_id = $('#hostelName').val();
	$('#floor').empty();
	$('#roomListTable').empty();
	if (!hostel_id){
		jQuery('<option/>',{
				value: '',
				text : '--Select One--'
			}).appendTo('#floor');
		return;
	}
	$('#loadingDiv').show();
	$.ajax({
		url: base_url+'get_Hostel_Detail_JSON/' + hostel_id,
		type: 'GET',	
		data: {},
		beforeSend:function(){
		},
		success: function (data) {
			$('#loadingDiv').hide();
			data = jQuery.parseJSON(data);
			$('#floor').empty();
			jQuery('<option/>',{
					value: '',
					text : '--Select One--'
				}).appendTo('#floor');
			for (var rooms = 0; rooms < data.numfloors; rooms++) {
				jQuery('<option/>',{
					value: rooms,
					text : rooms
				}).appendTo('#floor');
			};
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			show_error("Error occured! Please try again.");
			return false;
		}
	});
}

function roomLookup () {
	var hostel_id = $('#hostelName').val();
	var floor = $('#floor').val();
	$('#roomListTable').empty();
	if(!(hostel_id&&floor)) {
		return;
	}
	$('#loadingDiv').show();
	$.ajax({
		url: base_url+'get_room_list_JSON/' + hostel_id + '/' + floor,
		type: 'GET',	
		beforeSend:function(){
		},
		success: function (data) {
			$('#loadingDiv').hide();
			if(data == 'false'){
				$('#noRoomAlert').show();	
				return;
			};
			$('#noRoomAlert').hide();	
			data = jQuery.parseJSON(data);
			for (var i = 0; i < data.length; i++) {
				if(i%10==0){
					var newTr = jQuery('<tr/>').appendTo('#roomListTable');
				}
				var newTd = jQuery('<td/>').appendTo(newTr);
				var button = jQuery('<button/>',{
					type: 'button',
					class: 'btn btn-success btnroom',
					text: data[i].number,
					onclick: 'makeSelected(this)'
				}).appendTo(newTd);
				//.data('key',value) is not working so had to go for attr
				$(button).attr('data-roomid', data[i].id);
				$(button).attr('data-hostelid', data[i].hostelid);
			};
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			show_error("Error occured! Please try again.");
			return false;
		}
	});
}

function makeSelected (obj) {
	var buttons = $('.btnroom');
	for (var i = buttons.length - 1; i >= 0; i--) {
		$(buttons[i]).removeClass('btn-warning');
		$(buttons[i]).removeClass('selected');
		$(buttons[i]).addClass('btn-success');
	};
	if($(obj).hasClass('btn-success')){
		$(obj).removeClass('btn-success');
		$(obj).addClass('btn-warning');
		$(obj).addClass('selected');
	}
}

function bookRoom () {
	buttons = $('.selected');
	if(buttons.length===0){
		alert('Please Select a room');
		return;
	}
	if(buttons.length>1){
		alert("Error occured");
		return;
	}
	var room_id = $(buttons).data('roomid');
	var hostel_id = $(buttons).data('hostelid');
	if(!(room_id && hostel_id)) return;
	$('#loadingDiv').show();
	$.ajax({
		url: base_url+'single_room/',
		type: 'POST',
		data: {
			'roomId': room_id,
			'hostelId': hostel_id,
		},
		beforeSend:function(){
		},
		success: function (response_code) {
			$('#loadingDiv').hide();
			switch(response_code) {
				case 'success':
					window.location.replace(base_url+"allotment/mess/");
					break;
			}
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			show_error("Error occured! Please try again.");
			return false;
		}
	});
}

function bookMess () {
	var mess_id = $('#mess').val();
	if(!(mess_id)) return;
	$('#loadingDiv').show();
	$.ajax({
		url: base_url+'single_mess/',
		type: 'POST',
		data: {
			'messId': mess_id
		},
		beforeSend:function(){
		},
		success: function (response_code) {
			$('#loadingDiv').show();
			switch(response_code) {
				case 'success':
					window.location.replace(base_url+"home/");
					break;
				default:
					alert(response_code);
					window.location.replace(base_url+"home/");
					break;
			}
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			show_error("Error occured! Please try again.");
			return false;
		}
	});
}
