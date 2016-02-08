
$(document).on('ready', function() {
	$("#form-config").on('submit', function(event) {
		event.preventDefault();
		
		datos = {
			'_token': $(this).find('[name="_token"]').val(),
			'test': $(this).find('[name="test"]').val(),
			'size': $(this).find('[name="size"]').val(),
			'cant': $(this).find('[name="cant"]').val()
		}

		postConfig(datos, function (data) {
			$("#form-config :input").prop("disabled", true);
		})

	});
});

function postConfig (datos, callback) {
	$.post("/config/save", datos).done(function (data) {
		callback(data)
	}).fail(function (data) {
		console.log(data);
	});

}