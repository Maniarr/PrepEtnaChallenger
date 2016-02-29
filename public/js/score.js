var main = function() {
	var showTop = function(number) {
		$.ajax({
			url: url + 'top/' + number,
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
	};

	showTop(10);


	var search = function(name) {
		$('.disabled').removeClass('disabled');
		$.ajax({
			url: url + 'search/' + name,
			method: 'GET',
			dataType: 'json',
			success: function(data) {
				if (data["position"] !== 0) {
					$("tbody").empty();
					for (var i = (data["hight"].length - 1); i >= 0; i--) {
						var tr = "<tr>" +
							"<td>" + (data["position"] - (i + 1)) + "</td>" +
							"<td>" + data["hight"][i]['name'] + "</td>" +
							"<td>" + data["hight"][i]['dp_mp'] + "</td>" +
							"<td>" + data["hight"][i]['dp_mg'] + "</td>" +
							"<td>" + data["hight"][i]['dg_mp'] + "</td>" +
							"<td>" + data["hight"][i]['dg_mg'] + "</td>" +
							"<td>" + data["hight"][i]['score'] + "</td>" +
							"<td>" + data["hight"][i]['created_at'] + "</td>" +
							"</tr>";
						$("tbody").append($(tr));
					}
					var player = "<tr style=\"background-color: #99ff99;\">" +
						"<td>" + data["position"] + "</td>" +
						"<td>" + data["player"]['name'] + "</td>" +
						"<td>" + data["player"]['dp_mp'] + "</td>" +
						"<td>" + data["player"]['dp_mg'] + "</td>" +
						"<td>" + data["player"]['dg_mp'] + "</td>" +
						"<td>" + data["player"]['dg_mg'] + "</td>" +
						"<td>" + data["player"]['score'] + "</td>" +
						"<td>" + data["player"]['created_at'] + "</td>" +
						"</tr>";
					$("tbody").append($(player));
					for (var i = 0; i < data["lower"].length; i++) {
						var tr = "<tr>" +
							"<td>" + (data["position"] + (i + 1)) + "</td>" +
							"<td>" + data["lower"][i]['name'] + "</td>" +
							"<td>" + data["lower"][i]['dp_mp'] + "</td>" +
							"<td>" + data["lower"][i]['dp_mg'] + "</td>" +
							"<td>" + data["lower"][i]['dg_mp'] + "</td>" +
							"<td>" + data["lower"][i]['dg_mg'] + "</td>" +
							"<td>" + data["lower"][i]['score'] + "</td>" +
							"<td>" + data["lower"][i]['created_at'] + "</td>" +
							"</tr>";
						$("tbody").append($(tr));
					}
				}
			}
		});
	};

	$(".top").click(function() {
		$('.disabled').removeClass('disabled');
		$(this).addClass('disabled');
		showTop($(this).attr('top'));
	});

	$("#search").click(function() {
		search($('#name').val());
	});

	$("#challenge").click(function() {
		$(location).attr('href', url + 'code');
	});
	console.log(window.location.href.split('?')[1] );

	if (window.location.href.split('?')[1] !== undefined)
		search(window.location.href.split('?')[1]);


};

$(document).ready(main);
