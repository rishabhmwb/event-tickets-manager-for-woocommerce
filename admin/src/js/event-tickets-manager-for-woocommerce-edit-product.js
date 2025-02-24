(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	 $(window).load(function(){
	 	if( $(document).find('.wps_etmfw_field_table').length > 0 ) {
	 		$(document).find( '.wps_etmfw_field_table tbody.wps_etmfw_field_body' ).sortable();
	 	}
	 }); 

	$(document).ready(function() {

        //for General tab.
		$('.options_group.pricing').addClass('show_if_event_ticket_manager').show();
        //for Inventory tab.
        $('.inventory_options').addClass('show_if_event_ticket_manager').show();
        $('#inventory_product_data ._manage_stock_field').addClass('show_if_event_ticket_manager').show();
		
		$('#etmfw_start_date_time').datetimepicker({
			format:'Y-m-d g:i a',
			step: 30,
			validateOnBlur: false,
			minDate: new Date(),
			onChangeDateTime:function () {
			check();
			},

		});

		function check(){

			var startDate = $('#etmfw_start_date_time').val(); 
			var startTime = startDate.split(" ");
			
			$('#etmfw_end_date_time').datetimepicker({
			format:'Y-m-d g:i a',
			step: 30,
			validateOnBlur: false,
			startDate: startDate,
			minDate : startDate,
			minTime : startTime[1],
			});
		}

		if( $('#etmfw_end_date_time').val() != '' ){
			$('#etmfw_end_date_time').datetimepicker({
			format:'Y-m-d g:i a',
			step: 30,
			validateOnBlur: false,
			minDate: new Date(),
		});
		}

		$(document).on( 'click', '.wps_etmfw_add_fields_button', function(){
			var fieldsetId = $(document).find('.wps_etmfw_field_table').find('.wps_etmfw_field_wrap').last().attr('data-id');
			fieldsetId = fieldsetId?fieldsetId.replace(/[^0-9]/gi, ''):0;
			let mainId = Number(fieldsetId) + 1;
			var field_html = '<tr class="wps_etmfw_field_wrap" data-id="'+mainId+'"><td class="drag-icon"><i class="dashicons dashicons-move"></i></td><td class="form-field wps_etmfw_label_fields"><input type="text" class="wps_etmfw_field_label" style="" name="etmfw_fields['+mainId+'][_label]" id="label_fields_'+mainId+'" value="" placeholder=""></td><td class="form-field wps_etmfw_type_fields"><select id="type_fields_'+mainId+'" name="etmfw_fields['+mainId+'][_type]" class="wps_etmfw_field_type"><option value="text">Text</option><option value="textarea">Textarea</option><option value="email" selected="selected">Email</option><option value="number">Number</option><option value="date">Date</option><option value="yes-no">Yes/No</option></select></td><td class="form-field wps_etmfw_required_fields"><input type="checkbox" class="checkbox" style="" name="etmfw_fields['+mainId+'][_required]" id="required_fields_'+mainId+'"></td><td class="wps_etmfw_remove_row"><input type="button" name="wps_etmfw_remove_fields_button" class="wps_etmfw_remove_row_btn" value="Remove"></td></tr>';
			$(document).find('.wps_etmfw_field_body').append( field_html );
		});

		$(document).on("click", ".wps_etmfw_remove_row_btn", function(e){
			e.preventDefault();
			$(this).parents(".wps_etmfw_field_wrap").remove();
		});

		$(document).on("change", "select#product-type", function(){
			var selected_product_type =  $(this).val();
			if( selected_product_type != 'event_ticket_manager') {
				$('#etmfw_start_date_time').prop('required',false);
				$('#etmfw_end_date_time').prop('required',false);
				$('#etmfw_event_venue').prop('required',false);
			}
		});

		$(document).on("keyup", "#etmfw_event_venue", function(){
			let input = $(this).val();
			if( input.length > 2 ){
				$(document).find("#wps_etmfw_location_loader").show();
				var data = {
					action:'wps_etmfw_get_event_geocode',
					wps_edit_nonce:etmfw_edit_prod_param.wps_etmfw_edit_prod_nonce,
					venue:input,
				};
				$.ajax(
					{
						dataType: 'json',
						url: etmfw_edit_prod_param.ajaxurl,
						type: "POST",
						data: data,
						success: function(response)
						{
							if( response.result ){
								let lat = response.message['lat'];
								let lng = response.message['lng'];
								$(document).find('#etmfw_event_venue_lat').val( lat );
								$(document).find('#etmfw_event_venue_lng').val( lng );
								$(document).find('#wps_etmfw_error_msg').html('');
							} else{
								let error_msg = response.message;
								$(document).find('#wps_etmfw_error_msg').html( error_msg );
							}
							$(document).find("#wps_etmfw_location_loader").hide();
						}
					}
				);
			}
			
		});
	});

	})( jQuery );
