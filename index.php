<?php
	require_once(__DIR__ . '/./vendor/autoload.php');

	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>No.Dry.Air</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container mt-4">
    <h1 class="mb-4">No.Dry.Air</h1>
    <div class="form-group">
      <label for="local">Local:</label>
      <input type="text" class="form-control" id="local" placeholder="Digite o nome da cidade">
    </div>
    <div class="btn-group mb-4">
      <button type="button" class="btn btn-primary" onclick="pesquisar()">Pesquisar</button>
      <button type="button" class="btn btn-primary" onclick="geolocalizacao()">Geolocalização</button>
    </div>
    <div class="card" style="width: 18rem;">
      <div class="card-body">
		  <div id="resultado"></div>
	  </div>
    </div>
  </div>
  <script>
    function pesquisar() {
		var location_name = document.getElementById("local").value;

		if (location_name == "") {
			alert("Por favor, informe o local");
			return;
		}	
		else	
			$.ajax({
					url: 'obtemgeolocal.php',
					method: 'POST',
					dataType: "json",
					data: { 
						location_name: location_name 
					},
					success: function(data) {
						document.getElementById('resultado').innerHTML = data.html;
					},
					error: function(error) {
						console.log(error);
					}
				})
    }
    
    function geolocalizacao() {
		//if (navigator.geolocation) {
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
					dataType: "json",
					data: { 
						location: location 
					},
					success: function(data) {
						document.getElementById('resultado').innerHTML = data.html;
						document.getElementById("local").setAttribute('value', data.location_name);
					},
					error: function(error) {
						console.log(error);
					}
				});
			});
		//} else {
		//	console.log("Geolocalização não suportada.");
		//}
    }
  </script>
</body>

</html>
