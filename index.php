<?php
	require_once(__DIR__ . '/./vendor/autoload.php');
	require(__DIR__ . '/layout/header.php'); 
	session_start();
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!--script src="js/geolocalization.js"></!--script-->
<script type="text/javascript">
	$(document).ready(function() {

		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {
				var latitude = position.coords.latitude;
				var longitude = position.coords.longitude;
				var location = {
					'latitude': latitude,
					'longitude': longitude
				};

				// Envia o objeto 'location' para o servidor por meio de uma requisição AJAX
				$.ajax({
					url: 'obtemgeolocal.php',
					method: 'POST',
					dataType: 'html',
					data: { 
						location: location 
					},
					success: function(response) {
						document.getElementById('resultado').innerHTML = response;
					},
					error: function(error) {
						console.log(error);
					}
				});
			});
		} else {
			console.log("Geolocalização não suportada.");
		}
	});
</script>

<div id="resultado"></div>

<?php require(__DIR__ . '/layout/footer.php'); ?>