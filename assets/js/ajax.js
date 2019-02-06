window.productsList = []
window.clientIds = []

$(document).ready(function () {
	var getProductsList = function () {
		$.ajax({
			url: 'assets/js/api.php',
			data: '',
			dataType: 'json',
			type: 'GET',
			success: response => {
				window.productsList = response
			},
			complete: response => {
				if (response.readyState !== 4) {
					alert('Something went wrong')
				}
			},
			error: err => {
			}
		})
	}

	var getClientId = function() {
		$.ajax({
			url: 'assets/extra_php/result.php',
			data: '',
			dataType: 'json',
			type: 'GET',
			success: response => {
				window.clientIds = response
			},
			complete: response => {
				if (response.readyState !== 4) {
					alert('Something went wrong')
				}
			},
			error: err => {
			}
		})
	}

	var client;

	client = {
		insertClient : function(nom){
		
		$.ajax({
		  url: "assets/js/insert.php",
		  data: { name: nom},
		  type: "POST",
		  success: response => {
		  	console.log('Yoni1',response);
		  	alert('Nouveau client enregistre')
		  },
		  error: response => {
		  	alert('Something went wrong')
		  }
		})

		/*$.ajax({
		  url: "assets/js/getId.php",
		  data:{ name: nom},
		  dataType: 'json',
		  type: "GET",
		  success: response => {
		  	window.clientId = response
		  	alert('Nouveau client '+)
		  },
		  error: response => {
		  	alert('Something went wrong')
		  }
		})*/
	}
	};

	var identif;

	identif = {
		getId(nom, next){

		$.ajax({
		  url: "assets/js/getId.php",
		  data:{ name: nom},
		  dataType: 'json',
		  type: "GET",
		  success: response => {
		  	window.clientId = response
		  	console.log('yoni2', response)
		  	next(response)

		  },
		  error: response => {
		  	alert('Something went wrong')
		  }
		})
	}
	};
	
	window.cli = client;
	window.id = identif;
	getProductsList()
	getClientId()
})
