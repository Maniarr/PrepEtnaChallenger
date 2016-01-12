var main = function() {
	$(".top").click(function() {
		$('.disabled').removeClass('disabled');
		$(this).addClass('disabled');
		$.ajax({
			url: url + 'top/' + $(this).attr('top'),
			method: 'GET',
			dataType: 'json',
			success: function(data) {
				$("tbody").empty();
				for (var i = 0; i < data.length; i++) {
					var tr = "<tr>" +
						"<td>" + (i + 1) + "</td>" +
						"<td>" + data[i]['name'] + "</td>" +
						"<td>" + data[i]['dp_mp'] + "</td>" +
						"<td>" + data[i]['dp_mg'] + "</td>" +
						"<td>" + data[i]['dg_mp'] + "</td>" +
						"<td>" + data[i]['dg_mg'] + "</td>" +
						"<td>" + data[i]['score'] + "</td>" +
						"<td>" + data[i]['created_at'] + "</td>" +
						"</tr>";
					$("tbody").append($(tr));
				}
			}
		});

	});

	$("#search").click(function() {
		console.log(url + 'recherche/' + $('#name').val());
		$.ajax({
			url: url + 'recherche/' + $('#name').val(),
			method: 'GET',
			dataType: 'text',
			success: function(data) {
				console.log(data);
			}
		});
	});

	$("#challenge").click(function() {
	});

};

$(document).ready(main);
