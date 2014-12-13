var BASE_URL = window.location.href;
$(document).on('ready',function () {
	$('#neftPayDate').datepicker({
		format: 'dd/mm/yyyy'
	});
});
$('#neftDatePick').on('click',function () {
	$('#neftPayDate').datepicker('show');
});
$('#neftNextBtn').on('click',function (e) {
	e.preventDefault();
	$('#nextBtnClicked').click();
});

var globData = {};
$('.neft-payments').on('change',function () {
	console.log($(this).val());
	console.log($(this).val().search(/[a-zA-Z ]+/));
	if($(this).val().search(/[a-zA-Z ]+/)!=-1){
		$(this).val(0);
		alert('please enter a valid number');
	}
	var data = $('.neft-payments');
	var sum = 0;

	for (var i = 0; i < data.length; i++) {
		var num = parseInt($(data[i]).val());
		if(isNaN(num)) num = 0;
		sum += num;
	}
	if(isNaN(sum)) sum=0;
	$('#neftAmmnt').val(sum);
});
$('.neft-payments').on('keyup',function () {
	console.log($(this).val());
	console.log($(this).val().search(/[a-zA-Z ]+/));
	if($(this).val().search(/[a-zA-Z ]+/)!=-1){
		$(this).val(0);
		alert('please enter a valid number');
	}
	var data = $('.neft-payments');
	var sum = 0;

	for (var i = 0; i < data.length; i++) {
		var num = parseInt($(data[i]).val());
		if(isNaN(num)) num = 0;
		sum += num;
	}
	if(isNaN(sum)) sum=0;
	$('#neftAmmnt').val(sum);
});
function neft_form_cnf () {
	var data = $('.neft-payments');
	for (var i = 0; i < data.length; i++) {
		var num = parseInt($(data[i]).val());
		if(isNaN(num)) $(data[i]).val(0);
	}
	data = {
		'mode' : $('#neftMode').val(),
		'id' : $('#neftPayId').val(),
		'neftMessDue': parseInt($('#neftMessDue').val()),
		'neftMessAdv': parseInt($('#neftMessAdv').val()),
		'neftSeat': parseInt($('#neftSeat').val()),
		'neftMain': parseInt($('#neftMain').val()),
		'neftEwc': parseInt($('#neftEwc').val()),
		'neftFee': parseInt($('#neftFee').val()),
		'neftOthers': parseInt($('#neftOthers').val()),
		'ammnt' : parseInt($('#neftAmmnt').val()),
		'date' : $('#neftPayDate').val(),
		'category' : $('#neftCat').val(),
		'files' : document.getElementById('neftFiles').files[0],
		'file_no' : document.getElementById('neftFiles').files.length,
	};
	

	var divs = $("#neftForm > div > div > div");
	if (data.mode=="") {
		$(divs[0]).addClass("has-error");
		alert("Select a payment mode");
		$('#neftMode').focus();
		return false;
	}else{
		$(divs[0]).removeClass("has-error");
	};
	if (data.id == "") {
		$(divs[1]).addClass("has-error");
		alert("Please enter a transaction ID");
		$('#neftPayId').focus();
		return false;
	}else{
		$(divs[1]).removeClass("has-error");
	};
	if (data.date == "") {
		$(divs[2]).addClass("has-error");
		alert("Please enter a valid date.");
		$('#neftPayDate').focus();
		return false;
	}else{
		$(divs[2]).removeClass("has-error");
	};
	if (data.ammnt<=0) {
		$(divs[11]).addClass("has-error");
		alert("Total amount cannot be zero or negative.");
		return false;
	}else{
		$(divs[11]).removeClass("has-error");
	};

	
	if (data.category == "") {
		$(divs[4]).addClass("has-error");
		alert("Please select a category.");
		$('#neftCat').focus();
		return false;
	}else{
		$(divs[4]).removeClass("has-error");
	};
	if (data.file_no == 0) {
		$(divs[12]).addClass("has-error");
		alert("Please select a file.");
		$('#neftFiles').focus();
		return false;
	}else{
		$(divs[12]).removeClass("has-error");
	};
	if(!data.files.type.match('image.jpeg')){
		alert('Only jpeg file is allowed');
		return;
	};
	if(data.files.size/1024>1024){
        alert(data.files.name + ' exceeds file size limit. Maximum file size is 1MB');
        $(divs[12]).addClass("has-error");
		$('#neftFiles').focus();
		return false;
	};
	$('#neftConfBtn').hide();
	tableData = $('#neftConfTbl > tbody > tr >td:nth-child(2)');
	$(tableData[0]).text(data.mode);
	$(tableData[1]).text(data.id);
	$(tableData[2]).text(data.date);
	$(tableData[4]).text(data.neftMessDue);
	$(tableData[5]).text(data.neftMessAdv);
	$(tableData[6]).text(data.neftSeat);
	$(tableData[7]).text(data.neftMain);
	$(tableData[8]).text(data.neftEwc);
	$(tableData[9]).text(data.neftFee);
	$(tableData[10]).text(data.neftOthers);
	$(tableData[11]).text(data.ammnt);
	if(data.category=='1'){
		$(tableData[3]).text("Chief Warden");
	}else{
		$(tableData[3]).text("Fee account");
	}
	$(tableData[12]).text(data.files.name);
	$('#neftForm').hide();
	$('#neftConfDiv').show();
	$('#neftSbmtfBtn').show();
	$('#neftEditfBtn').show();
	globData = data;
}

function neft_form_sub () {
	conf=window.confirm('Please note that once these details are submitted cannot be edited. Press OK to submit or press cancel if you want to recheck the details.');
	if (!conf) return false;
	$('#progressGif').show();
	$('#neftSbmtfBtn').attr('disabled','true');
	$('#neftEditfBtn').attr('disabled','true');
	data = globData;
	$('#niftDDuploadProg').parent().show();
	//file upload
	console.log(data.files);
	var formDataF = new FormData();
	if(data.files.type.match('image/jpeg')){
		formDataF.append('files[]', data.files, data.files.name);
		formDataF.append('transaction_id', data.id);
	}else{
		return false;
	}
	console.log(formDataF);
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
	    if (xhr.readyState == 4) {
	        upload_response = $.parseJSON(xhr.responseText);
	        if(upload_response.error === undefined){
	        	alert('file upload successful!');
	        	send_form_data(data);
	        	return;
	        }
	    }
	}
	xhr.progressBar = function (evt) {
		if (evt.lengthComputable) {  
		    total = evt.total;
		    loaded = evt.loaded;
		    $('#niftDDuploadProg').css('width',Math.round(loaded/total*100)+"%");

		}  
	}
	xhr.open('POST', BASE_URL+'/neft_files/', true);
	xhr.upload.addEventListener("progress", xhr.progressBar, false);  
	xhr.onload = function () {
	  if (xhr.status === 200) {
	    // File(s) uploaded.
	  } else {
	    alert('An error occurred! Please reload the page.');
	  }
	};
	xhr.send(formDataF);
}
function send_form_data (data) {
	delete data.files;
	$.ajax({
		url: BASE_URL+ '/neft_details/',
		type: "POST",
		data: data,
		dataType : 'JSON',
		success : function (data) {
			console.log(data);
			if(data.message[0] == 'successful'){
				alert('NEFT/Inter/Intra bank Details added successfully');
				location.reload();
			}
			if(data.error.length!=0){
				alert(data.error);
			}
		},
		error: function () {
			alert('An error occurred. Please reload the page');
		}
	});
}
function neft_form_edit () {
	$('#neftForm').show();
	$('#neftConfDiv').hide();
	$('#neftConfBtn').show();
	$('#neftEditfBtn').hide();
	$('#neftSbmtfBtn').hide();
}
