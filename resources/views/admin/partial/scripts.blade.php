 <!-- JAVASCRIPT -->
 <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>-->
 <script src="{{ asset('assets/admin/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
 <script src="{{ asset('assets/admin/libs/simplebar/simplebar.min.js') }}"></script>
 <script src="{{ asset('assets/admin/libs/node-waves/waves.min.js') }}"></script>
 <script src="{{ asset('assets/admin/libs/feather-icons/feather.min.js') }}"></script>
 <!-- Sweet Alerts js -->
 <script src="{{ asset('assets/admin/libs/sweetalert2/sweetalert2.min.js') }}"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
 <!-- App js -->
 <script src="{{ asset('assets/admin/js/app.js') }}"></script>
<script type="text/javascript">
    var site_url = "{{url('/')}}";    
</script>
<script type="text/javascript">
    $(document).ready( function(){
        let sidebar = localStorage.getItem("sidebar");
        let layout_mode = localStorage.getItem("layout_mode");
        
        if(sidebar!=undefined && sidebar!='')
        {
             $(".hamburger-icon").addClass("open");
             $("html").attr('data-sidebar-size', 'sm');
        }

        if(layout_mode!=undefined && layout_mode!='')
        {            
             $(".light-dark-mode").addClass("dark-mode"); 
             $("html").attr('data-layout-mode', 'dark');
        }
        
        $(".hamburger-icon").click( function(){
    		let chk = $(".hamburger-icon").hasClass('open');
    		if(chk==false)
    		{
    		    localStorage.setItem("sidebar", "open");
    		}else{
    		    localStorage.removeItem("sidebar");
    		}
    	});
	
	    $(".light-dark-mode").click( function(){
            let chk = $(".light-dark-mode").hasClass('dark-mode');
            if(chk==false)
            {
                localStorage.setItem("layout_mode", "dark-mode");
            }else{
                localStorage.removeItem("layout_mode");
            }
        });

        $("#table_dashboard .checkbox").click(function () {
            var is_any_checked = $("#table_dashboard .checkbox:checked").length;
            if (is_any_checked) {
                $(".btn-delete-selected").removeClass("disabled");
            } else {
                $(".btn-delete-selected").addClass("disabled");
            }
        })

        $("#table_dashboard #checkall").click(function () {
            var is_checked = $(this).is(":checked");
            $("#table_dashboard .checkbox").prop("checked", !is_checked).trigger("click");
        })


        $('.selected-action ul li a').click(function () {

             var selectedIDs = $("#form-table input:checkbox:checked").map(function(){
              return $(this).val();
            }).get(); // <----
            if(selectedIDs.length>0)
            {
                var name = $(this).data('name');
                $('#form-table input[name="button_name"]').val(name);
                var title = $(this).attr('title');
                 if(title=='Delete Selected')
                {
                    var alert_text = 'All data associated with product will be deleted and this data will not be recoverable.Are you sure want to '+title;
                }
                else
                {
                    var alert_text = "Are you sure want to " + title;
                }
                Swal.fire({
                    title: "Confirmation",
                    text: alert_text,
                    icon: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "Yes, do it!",
                    cancelButtonText: "No, cancel!",
                    confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
                    cancelButtonClass: "btn btn-danger w-xs mt-2",
                    buttonsStyling: !1,
                    showCloseButton: !0,
                }).then(function (t) {
                    if(t.isConfirmed)
                    {
                        $('#form-table').submit();
                    }
                });
            }
            else
            {
                alert('Please select records.');
            }
           
            

        })

        $('table tbody tr .button_action a').click(function (e) {
            e.stopPropagation();
        })

        //summernote
        //$('.summernote').summernote();
	
    });


    $(function() {
        $(".onlyNumberKey").on('keypress', function(evt){
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode
            if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
                return false;
            return true;
        });
    })
</script>
