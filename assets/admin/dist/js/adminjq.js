let formData = [];
var count = 0;
$(document).ready(function () {


	$('#product_dialogue').dialog({
		autoOpen: false,
		width: 400
	});

	$('#add').click(function () {
		$('#product_dialogue').dialog('option', 'title', 'Add Product Details');
		$('#product_name').val('');
		$('#product_details').val('');
		$('#error_product_name').text('');
		$('#error_product_details').text('');
		$('#product_name').css('border-color', '');
		$('#product_details').css('border-color', '');
		$('#product_qty').val('');
		$('#error_product_qty').text('');
		$('#product_qty').css('border-color', '');
		$('#save').text('Save');
		$('#product_dialogue').dialog('open');
	});

	$('#save').click(function () {
		var error_product_name = '';
		var error_product_details = '';
		var product_name = '';
		var product_details = '';
		var error_product_qty = '';
		var product_qty = '';

		if ($('#product_name').val() == '') {
			error_product_name = 'Product Name is required';
			$('#error_product_name').text(error_product_name);
			$('#product_name').css('border-color', '#cc0000');
			product_name = '';
		} else {
			error_product_name = '';
			$('#error_product_name').text(error_product_name);
			$('#product_name').css('border-color', '');
			product_name = $('#product_name').val();
		}
		if ($('#product_details').val() == '') {
			error_product_details = 'Product Details is required';
			$('#error_product_details').text(error_product_details);
			$('#product_details').css('border-color', '#cc0000');
			product_details = '';
		} else {
			error_product_details = '';
			$('#error_product_details').text(error_product_details);
			$('#product_details').css('border-color', '');
			product_details = $('#product_details').val();
		}
		if ($('#product_qty').val() == '') {
			error_product_qty = 'Product Qty is required';
			$('#error_product_qty').text(error_product_qty);
			$('#product_qty').css('border-color', '#cc0000');
			product_qty = '';
		} else {
			error_product_qty = '';
			$('#error_product_qty').text(error_product_qty);
			$('#product_qty').css('border-color', '');
			product_qty = $('#product_qty').val();
		}
		if (error_product_name != '' || error_product_details != '' || error_product_qty != '') {
			return false;
		} else {
			if ($('#save').text() == 'Save') {
				count = count + 1;
				formData.push(count);
				output = '<tr id="row_' + count + '">';
				output += '<td>' + product_name + ' <input type="hidden" name="hidden_product_name_' + count + '" id="product_name' + count + '" class="product_name" value="' + product_name + '" /></td>';
				output += '<td>' + product_details + ' <textarea type="text" style="display:none;" name="hidden_product_details_' + count + '" id="product_details' + count + '">' + product_details + '</textarea></td>';
				output += '<td>' + product_qty + ' <input type="hidden" name="hidden_product_qty_' + count + '" id="product_qty' + count + '" class="product_qty" value="' + product_qty + '" /></td>';
				output += '<td><button type="button" name="view_details" class="btn btn-warning btn-xs view_details" id="View_' + count + '"><i class="icon-close" style="margin-right:5px;"></i> View</button></td>';
				output += '<td><button type="button" name="remove_details" class="btn btn-danger btn-xs remove_details" id="Remove_' + count + '"><i class="icon-close" style="margin-right:5px;"></i> Remove</button></td>';
				output += '</tr>';
				$('#product_data').append(output);
			} else {
				var row_id = $('#hidden_row_id').val();
				output = '<td>' + product_name + ' <input type="hidden" name="hidden_product_name_' + count + '" id="product_name' + row_id + '" class="product_name" value="' + product_name + '" /></td>';
				output += '<td>' + product_details + ' <textarea type="text" style="display:none;" name="hidden_product_details_' + count + '" id="product_details' + row_id + '">' + product_details + '</textarea></td>';
				output += '<td>' + product_qty + ' <input type="hidden" name="hidden_product_qty_' + count + '" id="product_qty' + row_id + '" class="product_qty" value="' + product_qty + '" /></td>';
				output += '<td><button type="button" name="view_details" class="btn btn-warning btn-xs view_details" id="View_' + count + '"><i class="icon-close" style="margin-right:5px;"></i> View</button></td>';
				output += '<td><button type="button" name="remove_details" class="btn btn-danger btn-xs remove_details" id="Remove_' + count + '"><i class="icon-close" style="margin-right:5px;"></i> Remove</button></td>';
				output += '</tr>';
				$('#row_' + row_id + '').html(output);
			}

			$('#product_dialogue').dialog('close');
		}
	});

	$(document).on('click', '.view_details', function () {
		var row_id = $(this).attr("id");
		// alert(row_id);
		row_id = row_id.split("_")[1];
		var product_name = $('#product_name' + row_id + '').val();
		var product_details = $('#product_details' + row_id + '').val();
		var product_qty = $('#product_qty' + row_id + '').val();
		$('#product_name').val(product_name);
		$('#product_details').val(product_details);
		$('#product_qty').val(product_qty);
		$('#save').text('Edit');
		$('#hidden_row_id').val(row_id);
		$('#product_dialogue').dialog('option', 'title', 'Edit Data');
		$('#product_dialogue').dialog('open');
		$('#save').text('Edit');
		$('#hidden_row_id').val(row_id);
		$('#product_dialogue').dialog('option', 'title', 'Edit Data');
		$('#product_dialogue').dialog('open');
	});

	$(document).on('click', '.remove_details', function () {
		var row_id = $(this).attr("id");
		row_id = row_id.split("_")[1];

		if (confirm("Are you sure you want to remove this row data?")) {
			$('#row_' + row_id + '').remove();
			const index = formData.indexOf(parseInt(row_id));
			if (index > -1) {
				formData.splice(index, 1);
			}

		} else {
			return false;
		}
	});

	$('#action_alert').dialog({
		autoOpen: false
	});

	$('#product_form').on('submit', function (event) {
		var count_data = 0;
		event.preventDefault();
		$('.product_name').each(function () {
			count_data = count_data + 1;
		});
		if (count_data > 0) {
			var form_data = $(this).serialize();
			let splittedData = form_data.split("&");
			let splittedProductName = [];
			let splittedProductDetails = [];
			let splittedProductQuantity = [];
			let complaint_id = splittedData[0].split("=")[1];
			let urlToMail = splittedData[1].split("=")[1];

			for (let i = 2; i < splittedData.length; i = i + 3) {
				splittedProductName.push(splittedData[i].split("=")[1]);
			}
			for (let i = 3; i < splittedData.length; i = i + 3) {
				splittedProductDetails.push(splittedData[i].split("=")[1]);
			}
			for (let i = 4; i < splittedData.length; i = i + 3) {
				splittedProductQuantity.push(splittedData[i].split("=")[1]);
			}

			urlToMail = getStringUrl(urlToMail);

			splittedProductName = getFilteredArray(splittedProductName);
			splittedProductDetails = getFilteredArray(splittedProductDetails);

			for (let i = 0; i < splittedProductName.length; i++) {
				$.ajax({
					type: "POST",
					url: $('#product_form').attr("action"),
					method: "POST",
					data: {
						c_id: complaint_id,
						name: splittedProductName[i],
						detail: splittedProductDetails[i],
						quantity: splittedProductQuantity[i]
					},
					success: function (data) {
					}
				});
			}
			location.href = urlToMail + "/" + complaint_id;
		} else {
			$('#action_alert').html('<p>Please Add atleast one data</p>');
			$('#action_alert').dialog('open');
		}
	});
});

function getFilteredArray(unFilteredArray) {
	var str = "";
	var filteredArray = new Array();
	for (let i = 0; i < unFilteredArray.length; i++) {
		str = unFilteredArray[i];
		var newStr = "";
		for (let j = 0; j < str.length; j++) {
			if (str.charAt(j) === '+') {
				newStr += ' ';
			} else {
				newStr += str.charAt(j);
			}
		}
		filteredArray.push(newStr);
	}
	return filteredArray;
}

function getStringUrl(url) {
	var purl = "";
	for (var i = 0; i < url.length; i++) {
		if (url.substring(i, i + 3) == "%3A") {
			purl += ":";
			i += 2;
		} else if (url.substring(i, i + 3) == "%2F") {
			purl += "/";
			i += 2;
		} else {
			purl += url.charAt(i);
		}
	}
	return purl;
}
