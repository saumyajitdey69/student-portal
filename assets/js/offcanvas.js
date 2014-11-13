	$(document).on('click', function (argument) {
		clearSearchResult();
	});
	function clearSearchResult () {
		$('#search-item-output').html("");
		$('#search-item-output').hide();
	}

	function showSearchResult () {
		$('#search-item-output').html("");
		$('#search-item-output').show();
	}

	function check_branch (inputString) {
		var branch_reg = {
						  'civil':'civil', 
						  'mech':'mech', 
						  'ece' :'ece', 
						  'cse':'cse', 
						  'eee':'eee', 
						  'electronics':'ece', 
						  'che':'che', 
						  'chemical':'che', 
						  'bio':'biotech', 
						  'biotech':'biotech', 
						  'chemistry':'chem'
						};
		var inputStrings = inputString.split(" ");
		// console.log(inputStrings);
		for(var i = 0;i<inputStrings.length; i++){
			// inputStrings[i] = inputStrings[i].replace(",", "");
			if(inputStrings[i] in branch_reg){
				// search the code
				console.log(inputStrings[i] + " in if")
				inputStrings[i] = "branch:" + branch_reg[inputStrings[i]];
			}
			else if($.isNumeric(inputStrings[i]) && inputStrings[i].length === 4){
				inputStrings[i] = "joining_year:" + inputStrings[i];
			}
		}
		console.log(inputString);
		inputString = inputStrings.join(" ");
		console.log(inputString);
		return inputString;
	}

	function check_joining_year (inputString) {
		var inputStrings = inputString.split(" ");
		console.log(inputStrings);
		for(var i = 0;i<inputStrings.length; i++){
			inputStrings[i] = inputStrings[i].replace(",", "");
			if(inputStrings[i] in branch_reg){
				// search the code
				console.log(inputStrings[i] + " in if")
				inputStrings[i] = "branch:"+branch_reg[inputStrings[i]];
			}
		}
		console.log(inputString);
		inputString = inputStrings.join(" ");
		console.log(inputString);
		return inputString;
	}

	function OnInput(value){
		var inputString = $.trim(value);
		// console.log("keypressed. NEw string: " + inputString)
		if(inputString.length>0)
		inputString = check_branch(inputString);
		else
		{
		  clearSearchResult();
		  return;
		}
		$.ajax({
			url: '../message/get_details',
			type: 'post',
			data: {'rolls':inputString},
			success: formatSearchData
		});
	};

	function formatSearchData(data, textStatus, XMLHttpRequest) {
		
		var searchResult = JSON.parse(data);
		if(searchResult.length > 0){
			showSearchResult();
		}
		// console.log(searchResult)
		for (var i = searchResult.length - 1; i >= 0; i--) {
			item = box_content(searchResult[i]);
			// item = '<a href="'+searchResult[i]["username"]+'" class="list-group-item">'++'</a>'
			$('#search-item-output').append(item);
		};
	}

	function box_content (data) {

		data['name'] = data['first_name']+ " " + data['last_name'];

		return '<div class="media search-media list-group-item search-list-item">\
		<a class="media-left" href="#">\
		<img class="img google-search-progile-img" src="http://graph.facebook.com/v2.2/100002451127231/picture" width="36" alt="profile_img">\
		</a>\
		<div class="media-body">\
		<h5 class="media-heading">'+
		toTitleCase(data['name'])+
		'</h5>'+
		'<small>'+
		data['roll_number']+ ' &middot; ' + 
		data['branch'].toUpperCase()+ ' &middot; ' + 
		data['joining_year'].toLowerCase() + ' &middot; ' +
		'<a href="mailto:'+
		data['email'].toLowerCase()+'" target="_blank">' +
		data['email'].toLowerCase()+
		'</a>' +
		' </small>\
		</div>\
		</div>';
	}

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


	function toTitleCase(str)
	{
		return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
	}