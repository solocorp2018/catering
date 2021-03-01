$(document).on('change','.pickItem',function() {
	var formData = {
		_token:feedToken(),
		itemId:$(this).val()
	};

	$(this).parent('td').parent('tr').find('td').eq('2').find('.itemQuantity').val(1);
	var qunatityFieldField = $(this).parent('td').parent('tr').find('td').eq('3').find('.quantity_type_id');
	var actualpriceField = $(this).parent('td').parent('tr').find('td').eq('5').find('.hidden_actual_price');
	var priceField = $(this).parent('td').parent('tr').find('td').eq('5').find('.price');
	var statusField = $(this).parent('td').parent('tr').find('td').eq('6').find('.status');
	

	$.ajax({
        method:"POST",
        url: feedBaseUrl('/pick-item-detail'),
        data: formData,
        success: function( data ) {        	
        	if(data.status) {             		
        		
        		qunatityFieldField.val(data.data.quantity_type_id).change();
        		actualpriceField.val(data.data.price);
        		priceField.val(data.data.price);
        		statusField.attr('checked',true);        			
        	}		
        }
    });
});

$(document).on('change','.itemQuantity',function() {	
	
	var qunatityType = $(this).parent('td').parent('tr').find('td').eq('3').find('.quantity_type_id').val();

	var allowedQuantityType = ["1","6","10"];
	
	if($.inArray( qunatityType, allowedQuantityType ) === -1) {
		return
	}
	var actualpriceField = $(this).parent('td').parent('tr').find('td').eq('5').find('.hidden_actual_price');
	var priceField = $(this).parent('td').parent('tr').find('td').eq('5').find('.price');
	var quantity = parseInt($(this).val());
	var price = parseInt(actualpriceField.val());


	var totalPrice = quantity*price;	

	priceField.val(totalPrice);
	
});