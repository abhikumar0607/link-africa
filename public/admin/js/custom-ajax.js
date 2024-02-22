jQuery(document).ready(function () {
    //Add site master file record validation
    $('#add_site_master_file_record').validate({
        rules: {
          service_id: {
            required: true,
          },
          circuit_id: {
            required: true,
          },
          province: {
            required: true,
          },
          service_type: {
            required: true,
          },
          rate_mbit_s: {
            required: true,
          },
          site_a: {
            required: true,
          },
          site_b: {
            required: true,
          },
          date_po_order_rx: {
            required: true,
            date: true
          },
          po_mrc: {
            required: true,
          },
          po_nrc: {
            required: true,
          },
          kam_name: {
            required: true,
          },   
          network_types: {
            required: true,
          },
          type: {
            required: true,
          },
          region: {
            required: true,
          },
          metro_area: {
            required: true,
          },
          client_name: {
            required: true,
          },
          llc_received: {
            required: true,
          },
          order_type: {
            required: true,
          },
          lease_term_in_months: {
            required: true,
          },
          network_types: {
            required: true,
          },

        },
        messages: {
          //service_id: {
            //required: "Please enter a email address",
          //}
        }
    });
    //Update site master file record validation
    $('#update_site_master_file_record').validate({
        rules: {
          service_id: {
            required: true,
          },
          circuit_id: {
            required: true,
          },
          province: {
            required: true,
          },
          service_type: {
            required: true,
          },
          rate_mbit_s: {
            required: true,
          },
          site_a: {
            required: true,
          },
          site_b: {
            required: true,
          },
          date_po_order_rx: {
            required: true,
            date: true
          },
          po_mrc: {
            required: true,
            number: true
          },
          po_nrc: {
            required: true,
            number: true
          },
          kam_name: {
            required: true,
          },   
          network_types: {
            required: true,
          },
          type: {
            required: true,
          },
          region: {
            required: true,
          },
          metro_area: {
            required: true,
          },
          client_name: {
            required: true,
          },
          llc_received: {
            required: true,
          },
          order_type: {
            required: true,
          },
          lease_term_in_months: {
            required: true,
          },
          network_types: {
            required: true,
          },
        },
        messages: {
          /*service_id: {
            required: "Please enter a email address",
          }*/
        }
    });
    //Get site a addresses list
    /*$('body').on('change', '#site_a', function() {
        var site_name = $(this).val();
        
        //Ajax call
        jQuery.ajax({  
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, 
            url: base_url+'/site/address-list', 
            data: {
                _token : $('meta[name="csrf-token"]').attr('content'), 
                site_name:site_name
            },
            beforeSend: function() {
                $('body').addClass("responce-load");  
                $(".admin-loader").show();
            },
            success: function(response) {
                $('body').removeClass("responce-load");    
                $(".admin-loader").hide();
                //Check responce here
                if(response != 'null'){ 
                    var parse_response = JSON.parse(response);
                    jQuery("#physical_address_site_a").val(parse_response.physical_address);
                    jQuery("#gps_co_ordinates_site_a_x").val(parse_response.gps_co_ordinates);
                    jQuery("#gps_co_ordinates_site_a_y").val(parse_response.gps_co_ordinates2);
                    jQuery("#contact_name_site_a").val(parse_response.contact_name);
                    jQuery("#work_number_site_a").val(parse_response.work_number);
                    jQuery("#mobile_number_site_a").val(parse_response.mobile_number);
                    jQuery("#email_address_site_a").val(parse_response.email_address);
                    jQuery("#managing_agent_site_a").val(parse_response.managing_agent);
                    jQuery("#landlord_contact_number_a").val(parse_response.landlord_contact_number);
                    jQuery("#landlord_name_site_a").val(parse_response.landlord_name); 
                } else {
                    jQuery("#physical_address_site_a").val("");
                    jQuery("#gps_co_ordinates_site_a_x").val("");
                    jQuery("#gps_co_ordinates_site_a_y").val("");
                    jQuery("#contact_name_site_a").val("");
                    jQuery("#work_number_site_a").val("");
                    jQuery("#mobile_number_site_a").val("");
                    jQuery("#email_address_site_a").val("");
                    jQuery("#managing_agent_site_a").val("");
                    jQuery("#landlord_contact_number_a").val("");
                    jQuery("#landlord_name_site_a").val(""); 
                }
            }
        });
    });*/
    
     //Get site b addresses list
   /* $('body').on('change', '#site_b', function() {
        var site_name = $(this).val(); 
        
        //Ajax call
        jQuery.ajax({  
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, 
            url: base_url+'/site/address-list-b', 
            data: {
                _token : $('meta[name="csrf-token"]').attr('content'), 
                site_name:site_name
            },
            beforeSend: function() {
                $('body').addClass("responce-load");  
                $(".admin-loader").show();
            },
            success: function(response) {
                $('body').removeClass("responce-load");    
                $(".admin-loader").hide();
                
                //Check responce here
                if(response != 'null'){ 
                    var parse_response = JSON.parse(response);
                    jQuery("#physical_address_site_b").val(parse_response.physical_address);
                    jQuery("#gps_co_ordinates_site_b_x").val(parse_response.gps_co_ordinates);
                    jQuery("#gps_co_ordinates_site_b_y").val(parse_response.gps_co_ordinates2);
                    jQuery("#contact_name_site_b").val(parse_response.contact_name);
                    jQuery("#work_number_site_b").val(parse_response.work_number);
                    jQuery("#mobile_number_site_b").val(parse_response.mobile_number);
                    jQuery("#email_address_site_b").val(parse_response.email_address);
                    jQuery("#managing_agent_site_b").val(parse_response.managing_agent);
                    jQuery("#landlord_contact_number_b").val(parse_response.landlord_contact_number);
                    jQuery("#landlord_name_site_b").val(parse_response.landlord_name); 
                } else {
                    jQuery("#physical_address_site_b").val("");
                    jQuery("#gps_co_ordinates_site_b_x").val("");
                    jQuery("#gps_co_ordinates_site_b_y").val("");
                    jQuery("#contact_name_site_b").val("");
                    jQuery("#work_number_site_b").val("");
                    jQuery("#mobile_number_site_b").val("");
                    jQuery("#email_address_site_b").val("");
                    jQuery("#managing_agent_site_b").val("");
                    jQuery("#landlord_contact_number_b").val("");
                    jQuery("#landlord_name_site_b").val(""); 
                }
            }
        });
    });*/

        //Get province  list
        $('body').on('change', '#region', function() {
          var region_name = $(this).val();
          //alert(region_name); return false;
          //Ajax call
          jQuery.ajax({  
              type: "POST",
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }, 
              url: base_url+'/region/province-list', 
              data: {
                  _token : $('meta[name="csrf-token"]').attr('content'), 
                  region_name:region_name
              },
              beforeSend: function() {
                  $('body').addClass("responce-load");  
                  $(".admin-loader").show();
              },
              success: function(response) {
                  $('body').removeClass("responce-load");    
                  $(".admin-loader").hide(); 
                  $("#province").html(response);   
              }
          });
      });
       //Get metro  list
       $('body').on('change', '#province', function() {
        var province = $(this).val();
        //alert(region_name); return false;
        //Ajax call
        jQuery.ajax({  
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, 
            url: base_url+'/region/metro-list', 
            data: {
                _token : $('meta[name="csrf-token"]').attr('content'), 
                province:province
            },
            beforeSend: function() {
                $('body').addClass("responce-load");  
                $(".admin-loader").show();
            },
            success: function(response) {
                $('body').removeClass("responce-load");    
                $(".admin-loader").hide(); 
                $("#metro_area").html(response);   
            }
        });
    });

       //Get service name  detail
       $('body').on('change', '#service_type', function() {
        var service_type = $(this).val();
        //alert(service_type); return false;
        //Ajax call
        jQuery.ajax({  
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, 
            url: base_url+'/service-type-detail', 
            data: {
                _token : $('meta[name="csrf-token"]').attr('content'), 
                service_type:service_type
            },
            beforeSend: function() {
                $('body').addClass("responce-load");  
                $(".admin-loader").show();
            },
            success: function(response) {
                $('body').removeClass("responce-load");    
                $(".admin-loader").hide(); 
                $('#sla_group').empty();
                $('#sla_group').append('<option value="Standard">Standard</option>');
                // Append the static option "Bespoke"
                $('#sla_group').append('<option value="Bespoke">Bespoke</option>');
                $('#mttr_sla').html('<option value="' + response.mttr_sla + '">' + response.mttr_sla + '</option>');
            }
        });
    });

    // Event listener for changes in sla_group dropdown
      $('#sla_group').on('change', function() {
        var selectedOption = $(this).val();
        if (selectedOption === 'Bespoke') {
            // Trigger AJAX request to fetch mttr_sla options
            $.ajax({
                url: base_url+'/get-mttr-sla-options', // Replace with your route
                type: 'POST',
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }, 
                data: {
                    selected_option: selectedOption
                },
                success: function(response) {
                    $('#mttr_sla').empty(); // Clear existing options
                    $.each(response.options, function(index, option) {
                        $('#mttr_sla').append('<option value="' + option.text + '">' + option.text + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        } else if(selectedOption === 'Standard') {
             // Trigger AJAX request to fetch mttr_sla options
             var service_type = $('#service_type').val();
             $.ajax({
              url: base_url+'/get-mttr-sla-options', // Replace with your route
              type: 'POST',
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }, 
              data: {
                  selected_option: selectedOption,service_type:service_type
              },
              success: function(response) {
                  $('#mttr_sla').empty(); // Clear existing options
                  $.each(response.options, function(index, option) {
                      $('#mttr_sla').append('<option value="' + option.text + '">' + option.text + '</option>');
                  });
              },
              error: function(xhr, status, error) {
                  console.error('Error:', error);
              }
          });
        }
      });


        //Get client ring on key change  list
        $('#client_ring').keyup(function(event) {
          var client_ring = $(this).val();
          //alert(client_ring); return false;
          //Ajax call
            jQuery.ajax({  
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }, 
                url: base_url+'/sale/client-ring-list', 
                data: {
                    _token : $('meta[name="csrf-token"]').attr('content'), 
                    client_ring:client_ring 
                },   
                success: function(response) {
                  $("#client_ring_res").show();
                    $("#client_ring_res").html(response);  
                    //alert(response); 
                }
            });
      });

        //Get client ring on key change  list
        $('body').on('click', '.dsign-client-ring', function() {
          var data=$(this).data('attr');
          $("#client_ring").val(data);  
          $("#client_ring_res").hide();  
      }); 


         //Onchange for set R and desimal numbers
      $("#po_mrc").change(function() {
        var $this = $(this);
        
        if($this.val().match("R ")){
            po_mrc_value2 = parseFloat($this.val());    
            $("#po_mrc").val(po_mrc_value);
        } else {
            po_mrc_value2 = parseFloat($this.val()).toFixed(2);      
            $("#po_mrc").val('R '+po_mrc_value2);
        }
      });

      //Onchange for set R and desimal numbers
      $("#po_nrc").change(function() {
        var $this = $(this);

        if($this.val().match("R ")){
            po_nrc_value2 = parseFloat($this.val());    
            $("#po_nrc").val(po_nrc_value2);
        } else {
          po_nrc_value2 = parseFloat($this.val()).toFixed(2);      
            $("#po_nrc").val('R '+po_nrc_value2);
        }
      });

             //Onchange for set R and desimal numbers
             $("#special_build_nrc").change(function() {
              var $this = $(this);
              
              if($this.val().match("R ")){
                special_build_nrc = parseFloat($this.val());    
                  $("#special_build_nrc").val(special_build_nrc);
              } else {
                special_build_nrc = parseFloat($this.val()).toFixed(2);      
                  $("#special_build_nrc").val('R '+special_build_nrc);
              }
            });
              //Onchange for set R and desimal numbers
              $("#thrd_party_nrc").change(function() {
                var $this = $(this);
                
                if($this.val().match("R ")){
                  thrd_party_nrc = parseFloat($this.val());    
                    $("#special_build_nrc").val(thrd_party_nrc);
                } else {
                  thrd_party_nrc = parseFloat($this.val()).toFixed(2);      
                    $("#thrd_party_nrc").val('R '+thrd_party_nrc);
                }
              });

                //Onchange for set R and desimal numbers
                $("#thrd_party_mrc").change(function() {
                  var $this = $(this);
                  
                  if($this.val().match("R ")){
                    thrd_party_mrc = parseFloat($this.val());    
                      $("#thrd_party_mrc").val(thrd_party_mrc);
                  } else {
                    thrd_party_mrc = parseFloat($this.val()).toFixed(2);      
                      $("#thrd_party_mrc").val('R '+thrd_party_mrc);
                  }
                });

               // calculate tha values of total project cost isp A
                $(document).on("keyup", ".qty1", function() {
                  var sum = 0;
                  $(".qty1").each(function(){
                   // var avoid = "R ";
                      sum += +$(this).val();
                      //alert(sum);return false;
                  }); 
                jQuery(".total").val(sum+' M');
                });

           // calculate tha values of total project cost isp B
           $(document).on("keyup", ".qty2", function() {
            var sum = 0;
            $(".qty2").each(function(){
                sum += +$(this).val();
            });
            $(".total2").val(sum+' M');
          });

           // calculate tha values of total project cost ops
           $(document).on("keyup", ".qty3", function() {
            var sum = 0;
            $(".qty3").each(function(){
                sum += +$(this).val();
            });
            $(".total3").val(sum+' M');
          });

    
           // calculate tha values of labour cost isp a
           $(document).on("keyup", ".qty4", function() {
            var sum = 0;
            $(".qty4").each(function(){ 
                sum += +$(this).val();
            });
            $(".total4").val('R '+sum.toFixed(2));
          });

            // calculate tha values of labour cost 
            $(document).on("keyup", ".qty5", function() {
              var sum = 0;
              $(".qty5").each(function(){
                  sum += +$(this).val();
              });
              $(".total5").val('R '+sum.toFixed(2));
            });
               // calculate tha values of labour cost vo isp a
               $(document).on("keyup", ".qty6", function() {
                var sum = 0;
                $(".qty6").each(function(){
                    sum += +$(this).val();
                });
                $(".total6").val('R '+sum.toFixed(2));
              });
              // calculate tha values of labour cost vo osp
              $(document).on("keyup", ".qty7", function() {
                var sum = 0;
                $(".qty7").each(function(){
                    sum += +$(this).val();
                });
                $(".total7").val('R '+sum.toFixed(2));
              });
              // calculate tha values of labour cost  isp a
              $(document).on("keyup", ".qty8", function() {
                var sum = 0;
                $(".qty8").each(function(){
                    sum += +$(this).val();
                });
                $(".total8").val('R '+sum.toFixed(2));
              });
                // calculate tha values of labour cost vo isp a
                $(document).on("keyup", ".qty9", function() {
                  var sum = 0;
                  $(".qty9").each(function(){
                      sum += +$(this).val();
                  });
                  $(".total9").val('R '+sum.toFixed(2));
                });

    //Add Planning Services Materials
    $('body').on('click', '.add_new_planning_material_price', function() {
        var servive_id =$(this).data('servive_id');
        var material_page_type =$(this).data('material_page_type');
      
        //Ajax call
        jQuery.ajax({  
          type: "GET",
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }, 
          url: base_url+'/planning/planning-material-service-isp-a-add-new', 
          data: {
              _token : $('meta[name="csrf-token"]').attr('content'),
              servive_id:servive_id,material_page_type:material_page_type
          },
          beforeSend: function() {
              $('body').addClass("responce-load");  
              $(".admin-loader").show();
          },
          success: function(response) {
            $('.planning_service_isp_a_res').append(response);    
            $('body').removeClass("responce-load");
            $(".admin-loader").hide();
          }
      });
    });

    //Cal total for materales price on change stock code
    $('body').on('change', '.material_stock_code', function() {
      var material_stock_code = $(this).val();
      
      var $tr_row = $(this).closest('tr');
      var material_quantity = jQuery('input.material_quantity', $tr_row).val();
      
      //Ajax call
      jQuery.ajax({  
        type: "GET",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }, 
        url: base_url+'/planning/planning-material-price', 
        data: {
            _token : $('meta[name="csrf-token"]').attr('content'),
            material_stock_code:material_stock_code, material_quantity:material_quantity
        },
        beforeSend: function() {
            $('body').addClass("responce-load");  
            $(".admin-loader").show();
        },
        success: function(response) {
          var parse_response = JSON.parse(response);
          //Check responce
          if(response != 'null'){ 
            jQuery('input.material_list_price', $tr_row).val(parse_response.material_price);
            jQuery('input.material_extended_price', $tr_row).val(parse_response.material_extended_price);
          }
          //For total price
          var material_total_price = 0;
          $('.material_price_list').closest('tr').find('input.material_extended_price').each(function() {
            //Remove R 
            var material_extended_price = $(this).val();
            var avoid = "R ";
            var new_material_extended_price = material_extended_price.replace(avoid, '');

            material_total_price += +new_material_extended_price; 
          });
          jQuery('input.material_total_price').val("R "+material_total_price.toFixed(2));
          $('body').removeClass("responce-load");
          $(".admin-loader").hide();
        }
    });
  });

  //Cal total for materales price on change quintity
  $('body').on('keyup', '.material_quantity', function() {
    var $tr_row = $(this).closest('tr');
    
    //For cal material_extended_price total price
    $('.material_price_list').closest('tr').find('input.material_quantity').each(function() {
      //Remove R 
      var avoid = "R ";
      var material_quantity = jQuery('input.material_quantity', $tr_row).val();
      var material_list_price = jQuery('input.material_list_price', $tr_row).val();
      var new_material_list_price = material_list_price.replace(avoid, '');
      var cal_new_material_list_price  = new_material_list_price*material_quantity;

      jQuery('input.material_extended_price', $tr_row).val('R '+cal_new_material_list_price.toFixed(2));
    });

    //For total price
    var material_total_price = 0;
    $('.material_price_list').closest('tr').find('input.material_extended_price').each(function() {
      //Remove R 
      var material_extended_price = $(this).val();
      var avoid = "R ";
      var new_material_extended_price = material_extended_price.replace(avoid, '');

      material_total_price += +new_material_extended_price; 
    });
    jQuery('input.material_total_price').val("R "+material_total_price.toFixed(2));
  });

  //Append service id
  $('body').on('keyup', '#circuit_id', function() {
    var circuit_id = $(this).val();
    $('#service_id').val(circuit_id);
  });
   

  //Cal total for BUILD COMPLETION
  $('body').on('keyup', '#build_completion', function() {
      var build_completion = $(this).val();
      
      var ops_total_distance = jQuery('#ops_total_distance').val();
      var isp_a_total_distance = jQuery('#isp_a_total_distance').val();
      var isp_b_total_distance = jQuery('#isp_b_total_distance').val();
      
      //Remove M
      var avoid = " M";
      var new_ops_total_distance = ops_total_distance.replace(avoid, '');
      var new_isp_a_total_distance = isp_a_total_distance.replace(avoid, '');
      var new_isp_b_total_distance = isp_b_total_distance.replace(avoid, '');
      var sum_build_completion_per = parseFloat(new_ops_total_distance, 10) + parseFloat(new_isp_a_total_distance, 10) + parseFloat(new_isp_b_total_distance, 10);
      var build_completion_per = build_completion/sum_build_completion_per;
      jQuery('#build_completion_per').val(build_completion_per.toFixed(2));
  });

  //Get site a addresses list
  $('body').on('change', '#site_a_list', function() {
    var site_name = $(this).val();
    
    //Ajax call
    jQuery.ajax({  
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }, 
        url: base_url+'/site/address-list', 
        data: {
            _token : $('meta[name="csrf-token"]').attr('content'), 
            site_name:site_name
        },
        beforeSend: function() {
            $('body').addClass("responce-load");  
            $(".admin-loader").show();
        },
        success: function(response) {
            $('body').removeClass("responce-load");    
            $(".admin-loader").hide();
            //Check responce here
            if(response != 'null'){ 
                var parse_response = JSON.parse(response);
                jQuery("#site_id").val(parse_response.id);
                jQuery("#site_a").val(parse_response.site_name);
                jQuery("#physical_address_site_a").val(parse_response.physical_address);
                jQuery("#gps_co_ordinates_site_a_x").val(parse_response.gps_co_ordinates);
                jQuery("#gps_co_ordinates_site_a_y").val(parse_response.gps_co_ordinates2);
                jQuery("#contact_name_site_a").val(parse_response.contact_name);
                jQuery("#work_number_site_a").val(parse_response.work_number);
                jQuery("#mobile_number_site_a").val(parse_response.mobile_number);
                jQuery("#email_address_site_a").val(parse_response.email_address);
                jQuery("#managing_agent_site_a").val(parse_response.managing_agent);
                jQuery("#landlord_contact_number_a").val(parse_response.landlord_contact_number);
                jQuery("#landlord_name_site_a").val(parse_response.landlord_name); 
            } else {
                jQuery("#physical_address_site_a").val("");
                jQuery("#gps_co_ordinates_site_a_x").val("");
                jQuery("#gps_co_ordinates_site_a_y").val("");
                jQuery("#contact_name_site_a").val("");
                jQuery("#work_number_site_a").val("");
                jQuery("#mobile_number_site_a").val("");
                jQuery("#email_address_site_a").val("");
                jQuery("#managing_agent_site_a").val("");
                jQuery("#landlord_contact_number_a").val("");
                jQuery("#landlord_name_site_a").val(""); 
            }
        }
    });
});

 //Get site b addresses list
$('body').on('change', '#site_b_list', function() {
    var site_name = $(this).val(); 
    
    //Ajax call
    jQuery.ajax({  
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }, 
        url: base_url+'/site/address-list-b', 
        data: {
            _token : $('meta[name="csrf-token"]').attr('content'), 
            site_name:site_name
        },
        beforeSend: function() {
            $('body').addClass("responce-load");  
            $(".admin-loader").show();
        },
        success: function(response) {
            $('body').removeClass("responce-load");    
            $(".admin-loader").hide();
            
            //Check responce here
            if(response != 'null'){ 
                var parse_response = JSON.parse(response);
                jQuery("#b_site_id").val(parse_response.id);
                jQuery("#site_b").val(parse_response.site_name);
                jQuery("#physical_address_site_b").val(parse_response.physical_address);
                jQuery("#gps_co_ordinates_site_b_x").val(parse_response.gps_co_ordinates);
                jQuery("#gps_co_ordinates_site_b_y").val(parse_response.gps_co_ordinates2);
                jQuery("#contact_name_site_b").val(parse_response.contact_name);
                jQuery("#work_number_site_b").val(parse_response.work_number);
                jQuery("#mobile_number_site_b").val(parse_response.mobile_number);
                jQuery("#email_address_site_b").val(parse_response.email_address);
                jQuery("#managing_agent_site_b").val(parse_response.managing_agent);
                jQuery("#landlord_contact_number_b").val(parse_response.landlord_contact_number);
                jQuery("#landlord_name_site_b").val(parse_response.landlord_name); 
            } else {
                jQuery("#physical_address_site_b").val("");
                jQuery("#gps_co_ordinates_site_b_x").val("");
                jQuery("#gps_co_ordinates_site_b_y").val("");
                jQuery("#contact_name_site_b").val("");
                jQuery("#work_number_site_b").val("");
                jQuery("#mobile_number_site_b").val("");
                jQuery("#email_address_site_b").val("");
                jQuery("#managing_agent_site_b").val("");
                jQuery("#landlord_contact_number_b").val("");
                jQuery("#landlord_name_site_b").val(""); 
            }
        }
    });
});


// empty data field
$('body').on('change', '#project_status', function() {
  var project_status = $(this).val();
  var date_new = $(this).find(':selected').attr('data-id');
  //alert(project_status);
  if(project_status == 'V) Pending CTS'){
    $('#date_new').val('');
  } else {
    $('#date_new').val(date_new);
  }

});

  //cehck email and update  password
  $("#password_reset_form").validate({
    rules: {
      email: {
            required: true,
        },
       
    },
    submitHandler: function (form) {
    var email = jQuery('#email').val();
    var password = jQuery('#password').val();
    var update_request_type = jQuery('#update_request_type').val();
    //alert(email);return false;
    //Ajax call
    jQuery.ajax({  
      type: "GET",
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }, 
      url: base_url+'/send/email/reset', 
      data: {
          _token : $('meta[name="csrf-token"]').attr('content'),
          email:email,
          update_request_type:update_request_type,
          password:password,
      },
      success: function(response) {
        if(update_request_type == 'is_email_check'){
          $('.password_field_res').html(response);
        }
       
        if(update_request_type == 'is_update_password'){
          $('.update_password_res').html(response);
        }

        // Find the form by its current id
      //var form = $('#password_reset_form');
      // Replace the current id with the new id
       //form.prop('id', 'change_password_form');
      }
  });
}

});
//cehck email and update  password
$("#upload_attachment_new").validate({
  rules: {
      filenames: {
          required: true,
      },
      form_type: {
          required: true,
      },
  },
  submitHandler: function (form, e) {
      e.preventDefault();
      $(".att-dis").attr("disabled", true);

      // Your existing form data
      var service_id = $('#service_id').val();
      var circuit_id = $('#circuit_id').val();
      var form_type = $('#form_type').val();
      var page_type = $('#page_type').val();

      var form = new FormData();
      form.append('service_id', service_id);
      form.append('circuit_id', circuit_id);
      form.append('form_type', form_type);
      form.append('page_type', page_type);

      // Read selected files
      var files = document.getElementById('filenames').files.length;
      for (var x = 0; x < files; x++) {
          form.append("filenames[]", document.getElementById('filenames').files[x]);
      }

      // Ajax call
      jQuery.ajax({
          type: "POST",
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: base_url + '/submit-attachment',
          data: form,
          processData: false,
          contentType: false,
          mimeType: "multipart/form-data",
          success: function (response) {
              // Handle success response
              $('.success_msg').html(response);
              setTimeout(function () {
                  location.reload();
              }, 3000);
          },
          error: function (error) {
              // Handle error response
              console.error(error);
          }
      });
  }
});

// Listen for file input change
$('#filenames').change(function () {
  displaySelectedFiles(this.files);
});

// Function to display selected file names
function displaySelectedFiles(files) {
  var selectedFilesDiv = $('#selectedFiles');
  selectedFilesDiv.empty(); // Clear previous entries

  // Loop through selected files and display their names
  for (var i = 0; i < files.length; i++) {
      var fileName = files[i].name;
      var fileId = 'file_' + i;

      // Create a div for each file entry
      var fileEntry = $('<div>').attr('id', fileId);

      // Display file name
      fileEntry.append($('<span>').text(fileName));

      // Add a cancel button
      var cancelButton = $('<button>').text('X').click(function () {
          // Remove the corresponding file entry on cancel
          $(this).parent().remove();

          // Update file input value to clear the canceled file
          var remainingFiles = Array.from($('#filenames')[0].files).filter(function (file) {
              return file.name !== fileName;
          });

          $('#filenames').prop('files', new FileList({ length: remainingFiles.length, 0: remainingFiles[0] }));
      });

      fileEntry.append(cancelButton);

      // Append the file entry to the container
      selectedFilesDiv.append(fileEntry);
  }
}
});
