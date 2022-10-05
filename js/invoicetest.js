 $(document).ready(function(){
	$(document).on('click', '#checkAll', function() {          	
		$(".itemRow").prop("checked", this.checked);
	});	
	$(document).on('click', '.itemRow', function() {  	
		if ($('.itemRow:checked').length == $('.itemRow').length) {
			$('#checkAll').prop('checked', true);
		} else {
			$('#checkAll').prop('checked', false);
		}
	});  
	var count = $(".itemRow").length;
	$(document).on('click', '#addRows', function() { 
		count++;
		var htmlRows = '';
		htmlRows += '<tr>';
		htmlRows += '<td><div class="custom-control custom-checkbox"> <input type="checkbox" class="custom-control-input itemRow" id="itemRow_'+count+'"> <label class="custom-control-label" for="itemRow_'+count+'"></label> </div></td>';          
		htmlRows += '<td><input type="text" name="productName[]" id="productName_'+count+'" class="form-control" autocomplete="off"></td>';	
		htmlRows += '<td><input type="number" name="quantity[]" id="quantity_'+count+'" class="form-control quantity" autocomplete="off"></td>';   		
		htmlRows += '<td><input type="number" name="price[]" id="price_'+count+'" class="form-control price" autocomplete="off"></td>';	
		htmlRows += '<td><select name="tax[]" id="tax_'+count+'" class="form-control tax"><option value="0"> 0 </option><option value="1"> 1 </option><option value="5"> 5 </option><option value="10"> 10 </option><select></td>';		 	 
		htmlRows += '<td><input type="text" readonly name="total[]" id="total_'+count+'" class="form-control total" autocomplete="off"></td>';          
		htmlRows += '</tr>';
		$('#invoiceItem').append(htmlRows);
	}); 
	$(document).on('click', '#removeRows', function(){
		$(".itemRow:checked").each(function() {
			$(this).closest('tr').remove();
		});
		$('#checkAll').prop('checked', false);
		calculateTotal();
	});		
	$(document).on('blur', "[id^=quantity_]", function(){
		calculateTotal();
	});	
	$(document).on('blur', "[id^=price_]", function(){
		calculateTotal();
	});	
	$(document).on('blur', "[id^=tax_]", function(){		
		calculateTotal();
	});	
	$(document).on('blur', "#discount", function(){
		var discount = $(this).val();
		var totalAftertax = $('#totalAftertax').val();	
		if(discount && totalAftertax) {
			totalAftertax = totalAftertax-discount;			
			$('#finaltotal').val(totalAftertax);
		} else {
			$('#finaltotal').val(totalAftertax);
		}	
	});	
	
});	
function calculateTotal(){
	var totalAmount = 0;
	var tax = 0;
	$("[id^='price_']").each(function() {
		var id = $(this).attr('id');
		id = id.replace("price_",'');
		var price = $('#price_'+id).val();
		var taxrte = $('#tax_'+id).val();
		if(taxrte ==''){ taxrte=0; }
		var quantity  = $('#quantity_'+id).val();
		if(!quantity) {
			quantity = 1;
		}
		var total = price*quantity;
			tax =  parseFloat(tax) + parseFloat(taxrte);
		$('#taxRate').val(tax);
		$('#total_'+id).val(parseFloat(total));
		totalAmount += total;			
	});
	$('#subTotal').val(parseFloat(totalAmount));	
	var taxRate = $("#taxRate").val();
	var subTotal = $('#subTotal').val();	
	if(subTotal) {
		var taxAmount = subTotal*taxRate/100;
		$('#taxAmount').val(taxAmount);
		subTotal = parseFloat(subTotal)+parseFloat(taxAmount);
		$('#totalAftertax').val(subTotal);		
		var discount = $('#discount').val();
		var totalAftertax = $('#totalAftertax').val();	
		if(discount && totalAftertax) {
			totalAftertax = totalAftertax-discount;			
			$('#finaltotal').val(totalAftertax);
		} else {		
			$('#finaltotal').val(subTotal);
		}
	}
}

 
