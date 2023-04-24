<script src="{{ url('assets/js/jquery.min.js') }}"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" ></script>
 <!-- Datatable js -->
<script src="{{ url('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ url('assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ url('assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ url('assets/plugins/datatables/jszip.min.js') }}"></script>
<script src="{{ url('assets/plugins/datatables/pdfmake.min.js') }}"></script>
<script src="{{ url('assets/plugins/datatables/vfs_fonts.js') }}"></script>
<script src="{{ url('assets/plugins/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ url('assets/plugins/datatables/buttons.print.min.js') }}"></script>
<script src="{{ url('assets/plugins/datatables/buttons.colVis.min.js') }}"></script>
<script src="{{ url('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ url('assets/js/popper.min.js') }}"></script>
<script src="{{ url('assets/js/bootstrap.min.js') }}"></script>

 <!-- Tagsinput js -->
<script src="{{ url('assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ url('assets/plugins/bootstrap-tagsinput/typeahead.bundle.js') }}"></script>
<script src="{{ url('assets/js/modernizr.min.js') }}"></script>
<script src="{{ url('assets/js/detect.js') }}"></script>
<script src="{{ url('assets/js/jquery.slimscroll.js') }}"></script>
<script src="{{ url('assets/js/vertical-menu.js') }}"></script>
<!-- Switchery js -->
<script src="{{ url('assets/plugins/switchery/switchery.min.js') }}"></script>
<script src="{{ url('assets/js/custom/custom-switchery.js')}}"></script>
<!-- Apex js -->
<script src="{{ url('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ url('assets/plugins/apexcharts/irregular-data-series.js') }}"></script>    
<!-- Slick js -->
<script src="{{ url('assets/plugins/slick/slick.min.js') }}"></script>
<!-- Pnotify js -->
<script src="{{ url('assets/plugins/pnotify/js/pnotify.custom.min.js') }}"></script>
<!-- Select2 js -->
<script src="{{ url('assets/plugins/select2/select2.min.js') }}"></script>
<script src="{{ url('assets/js/core.js') }}"></script>
<script src="{{ url('js/admin.js') }}"></script>
<script src="{{ url('vendor/midia/dropzone.js') }}"></script>
<script src="{{ url('vendor/midia/clipboard.js') }}"></script>
<script src="{{ url('vendor/midia/midia.js') }}"></script>
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script src="{{ url('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ url('js/star-rating.min.js') }}"></script>
<script src="{{ url('assets/plugins/jquery-bar-rating/jquery.barrating.min.js') }}"></script>
<script src="{{ url('js/bs-custom-file-input.js') }}"></script>
<script src="{{ url('js/bs-custom-file-input.min.js') }}"></script>
<script src="{{ url('js/custom-file-input.js') }}"></script>


<script src="{{ url('/js/checkbox.js') }}"></script>
<script>
		
	function readURL(input) {

		if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#' + input.name).attr('src', e.target.result);
		}
		
		reader.readAsDataURL(input.files[0]);
		}
	}
	PNotify.desktop.permission();
	@if(session('warning'))
		var warning = new PNotify( {
            title: 'Warning', text: '{{ session('warning') }}', type: 'primary', desktop: {
                desktop: true, icon: 'feather icon-thumbs-down'
            }
    	});

    	warning.get().click(function() {
            warning.remove();
        });
	@endif

	@if(session('success'))
		var success = new PNotify( {
	            title: 'Success', text: '{{ session('success') }}', type: 'success', desktop: {
                desktop: true, icon: 'feather icon-thumbs-up'
            }
	    });

	    success.get().click(function() {
            success.remove();
        });
	@endif

	@if(session('info'))
		var info = new PNotify( {
	            title: 'Updated', text: '{{ session('info') }}', type: 'info', desktop: {
                desktop: true, icon: 'feather icon-info'
            }
	    });

	    info.get().click(function() {
            info.remove();
        });
	@endif

	@if(session('deleted'))
		var deleted = new PNotify( {
		    title: 'Deleted', text: '{{ session('deleted') }}', type: 'error' , desktop: {
                desktop: true, icon: 'feather icon-trash-2'
            }
		});

		deleted.get().click(function() {
            deleted.remove();
        });
	@endif

	$('.select2').select2();

	( function($) {
	    $( "#datepicker" ).datepicker({
	    	changeMonth: true,
      		changeYear: true,
      		yearRange: '1950:{{ date('Y') }}',
      		dateFormat: "yy-mm-dd"
	    });
	})(jQuery);
	

</script>
<script type="text/javascript">
    $(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
</script>
<!-- End js -->

@yield('script')