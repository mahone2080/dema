(function ($) {
    $(function () {
        $('.ssp-top-button').click(function(){
            $('body').animate({
                scrollTop:0
            },200);
        });

	    $( '.ssp-tabs-trigger' ).click(function(){
		    $( '.ssp-tabs-trigger' ).parent().removeClass( 'ssp-active-tab' );
		    $(this).parent().addClass( 'ssp-active-tab' );
		    var board_id = 'tab-'+$(this).attr('id');
		    $('.ssp-tab-contents').hide();
		    $('#'+board_id).show();
	   	});

       $('.accesspress-ssp_html_markup').change(function(){ 
			    var value = $(this).val();
			    if(value == "default_markup"){
			         $('.ssp-col-full1').toggle(); 
		              $('.ssp-col-full2').hide();
			    }else if(value == "custom_markup"){
			       $('.ssp-col-full1').hide();
                   $('.ssp-col-full2').toggle();
			    }
			});
     
      $('.load_ajax_type').change(function(){ 
			    var value = $(this).val();
			    if(value == "append_data_on"){
			       $('.ssp-col-full3').toggle(1000);
			    }else if(value == "onclick_button"){
			       $('.ssp-col-full3').hide(1000);
			    }
			});


        $('input[name="loader_set_type"]').click(function () {
        	
            if ($(this).val() == 'default_loader')
                        {
                            $('.default_loader_content').show();
                            $('.custom_loader_content').hide();

                        }
                        else
                        {
                            $('.default_loader_content').hide();
                            $('.custom_loader_content').show();
                        }
          });

           $('#ssp_upload_image_button').on('click', function(e){
			      e.preventDefault();
			      var btnClicked = $( this );
			      var loader = wp.media({ 
				      title: 'Insert Custom Loader',
				      button: {text: 'Insert Custom Loader'},
				      library: { type: 'image'},
				      multiple: false
			      }).open()
			      .on('select', function(e){
			        var uploaded_loader = loader.state().get('selection').first();
			        var loader_url = uploaded_loader.toJSON().url;
			        $( btnClicked ).closest('.custom_loader_content').find( '#ssp_upload_image' ).val(loader_url);          
			        $( btnClicked ).closest('.custom_loader_content').find( '.ssp-prview' ).attr('src',loader_url);          
			      });
		    });


        });
}(jQuery));