
$(document).on('ready', function() {
	$("#form-config :input").prop("disabled", false);


	$("#form-config").on('submit', function(event) {
		event.preventDefault();
		
		datos = {
			'_token': $(this).find('[name="_token"]').val(),
			'test': $(this).find('[name="test"]').val(),
			'size': $(this).find('[name="size"]').val(),
			'cant': $(this).find('[name="cant"]').val()
		};

		postConfig(datos, function (data) {
			$("#form-config :input").prop("disabled", true);
			$("#form-command").removeClass("hide");
		});

	});


	$("#form-command").on('submit', function(event) {
		event.preventDefault();

		if ($("#command").length === 0) {
			alert('puto');
		}else{
			datos = {
				'_token': $(this).find('[name="_token"]').val(),
				'command': $("#command").val()
			};
			postCommand(datos, function (res) {
				if (!res.error) {
					var html = 'Not info';
					if (res.type === 'query') {
						var template = Handlebars.compile($("#tem-query").html());
						html = template({result: res.data.command, total: res.data.total});
					}

					if (res.type === 'update') {
						var template = Handlebars.compile($("#tem-update").html());
						html = template({result: res.data});
					}

					$("#result").append(html);

					if (res.cantidad == res.cant_permitida) {
						$("#form-command :input").prop("disabled", true);
					}
				};
			});
		}
		
		/*datos = {
			'_token': $(this).find('[name="_token"]').val(),
			'test': $(this).find('[name="test"]').val(),
			'size': $(this).find('[name="size"]').val(),
			'cant': $(this).find('[name="cant"]').val()
		}

		postConfig(datos, function (data) {
			$("#form-config :input").prop("disabled", true);
			$("#form-command").removeClass("hide");
		})*/

	});
});

function postConfig (datos, callback) {
	$.post("/config/save", datos).done(function (res) {
		callback(res);
	}).fail(function (res) {
		showErrors(res);
	});
}

function postCommand (datos, callback) {
	$.post("/command", datos).done(function (res) {
		callback(res);
	}).fail(function (res) {
		showErrors(res);
	});
}

var showErrors = function (res) {
	var msg = 'Ocurrió un error';

    if (res.responseJSON.error) {
    	msg = res.responseJSON.error;
    } else {
    	var keys = Object.keys(res.responseJSON);
    	msg = "Revisa los siguientes campos: " + keys;
    }

    var template = Handlebars.compile($("#tem-error").html());
    var html = template({message: msg});

    $("#messages").empty().html(html);

    setTimeout(function () {
    	$("#messages").empty();
    }, 5000);

};