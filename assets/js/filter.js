$(document).ready(function(){
	$('#filter').hide();
	$('#filtere').hide();
(function($){
	$('#client-filter').keyup(function(event){
		var input = $(this);
		var val = input.val();
		if (val == '') {
			$('#filter li').hide();
			$('#filter span').removeClass('surligne');
			return true;
		}
		var regexp = '\\b(.*)';
			for (var i in val){
				regexp +='('+val[i]+')(.*)';
			}
		regexp += '\\b';
		if (input.val() !=='') {
			$('#filter').show();
			$('#filter li').show();
		}
		
		$('#filter').find('li>span').each(function(){
			var li = $(this);
			var resultat = li.text().match(new RegExp(regexp, 'i'));
			if (resultat) {
				console.log(resultat);
				var string = '';
				for (var i in resultat) {
					if(i > 0){
						if (i%2 == 0) {
							string += '<span class="surligne">'+resultat[i]+'</span>'
						}else{
							string += resultat[i];	
						}
					}
				}
				li.empty().append(string);
			}else{
				li.parent().hide();
			}
		})
	});


	

	var $clientItem = $('#filter').find('li')

	$clientItem.on('click', e => {

		const lib = $(e.delegateTarget).text()
		const clientList = window.clientIds

		$('#client-filter').val(lib)

		if (clientIds && clientIds.length) {
			var selectedClient = clientList.filter(e => e.NOM_CLIENT === lib)[0]

			$('#idClient').val(selectedClient['CODE_CLIENT'])
			$('#filter').hide();
		}else {
			alert('Liste des clients vide')
		}
		
	})

	$('#client-filter').keypress(function(e){
        if(e.which == 13){//Enter key pressed
        	var input = $(this);
			var val = input.val();

			/*var form = $('#commande_form');
			$('<div class="form-group col-lg-4"><label for="Numclient">*Client</label><input type="text" class="form-control" name="Numclient" id="Numclient" placeholder="Numero du client" REQUIRED></div>').appendTo(form);

			$('#Numclient').keypress(function(e){
				if (e.which == 13) {
					var inputNum = $(this);
					var valNum = inputNum.val();
				}
			})*/
		cli.insertClient(val);
		id.getId(val, function(codeClient){
			const identifiant = window.clientId
			$('#idClient').val(codeClient[0]["CODE_CLIENT"])
		});

		
        }
     })
})(jQuery);


/*(function($){
$("produit").keyup(function(event){
		var produit = $(this).val();
		var data = 'pain=' + produit;
		if (produit.length>2) {
			$.ajax({
				type : "GET",
				url : "../extra_php/result.php",
				data : data,
				
				success : function(server_response){
					$("#prix_unit").html(server_response).show();
				}
			});
		}console.log(data);
	})
})(jQuery);*/

(function($){
	$('#produit').keyup(function(event){
		
		var input = $(this);
		var val = input.val();
		if (val == '') {
			$('#filtere li').hide();
			$('#filtere span').removeClass('surligne');
			return true;
		}
		var regexp = '\\b(.*)';
			for (var i in val){
				regexp +='('+val[i]+')(.*)';
			}
		regexp += '\\b';
		if (input.val() !== '') {
			$('#filtere').show();
			$('#filtere li').show();
		}
		
		$('#filtere').find('li>span').each(function(){
			var li = $(this);
			var resultat = li.text().match(new RegExp(regexp, 'i'));
			if (resultat) {
				console.log(resultat);
				var string = '';
				for (var i in resultat) {
					if(i > 0){
						if (i%2 == 0) {
							string += '<span class="surligne">'+resultat[i]+'</span>'
						}else{
							string += resultat[i];	
						}
					}
				}
				li.find('a').empty().append(string);
			}else{
				li.parent().hide();
			}
		})
	});

	var $productItem = $('#filtere').find('li')

	$productItem.find('a').on('click', e => {
		e.preventDefault()

		const lib = $(e.delegateTarget).text()
		const productsList = window.productsList

		$('#produit').val(lib)

		if (productsList && productsList.length) {
			var selectedProduct = productsList.filter(e => e.LIBELLE === lib)[0]

			$('#idProduit').val(selectedProduct['CODE_PAIN'])
			$('#prix_unit').val(selectedProduct['PRIX_UNIT'])
			$('#filtere').hide();
		} else {
			alert('Liste des produits vide')
		}
	})
})(jQuery);



/*(function($){
	$('.submit').click(function(event){
		
		event.preventDefault();
	});

	
})(jQuery);*/

})