 {{-- <!-- BEGIN: Footer--><a class="btn btn-try-builder btn-bg-gradient-x-purple-red btn-glow white" href="https://www.themeselection.com/layout-builder/horizontal" target="_blank">Try Layout Builder</a>
 <footer class="footer footer-static footer-light navbar-border navbar-shadow">
    <div class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">2019 &copy; Copyright <a class="text-bold-800 grey darken-2" href="https://themeselection.com" target="_blank">ThemeSelection</a></span>
        <ul class="list-inline float-md-right d-block d-md-inline-blockd-none d-lg-block mb-0">
            <li class="list-inline-item"><a class="my-1" href="https://themeselection.com/" target="_blank"> More themes</a></li>
            <li class="list-inline-item"><a class="my-1" href="https://themeselection.com/support" target="_blank"> Support</a></li>
        </ul>
    </div>
</footer>
<!-- END: Footer-->
</div> --}}



<!-- BEGIN: Vendor JS-->
<script src="{{asset('/assets/admin/')}}/vendors/js/vendors.min.js" type="text/javascript"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('/assets/admin/')}}/vendors/js/charts/chartist.min.js" type="text/javascript"></script>
<script src="{{asset('/assets/admin/')}}/vendors/js/charts/chartist-plugin-tooltip.min.js" type="text/javascript"></script>

 @if(isset($load_data_table))
 <script src="{{asset('/assets/admin/')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
 @endif

<!-- BEGIN: Theme JS-->
<script src="{{asset('/assets/admin/')}}/js/core/app-menu.js" type="text/javascript"></script>
<script src="{{asset('/assets/admin/')}}/js/core/app.js" type="text/javascript"></script>
<!-- END: Theme JS-->
 @if(isset($load_data_table))
 <script src="{{asset('/assets/admin/')}}/js/scripts/tables/datatables/datatable-basic.js" type="text/javascript"></script>
 @endif
<!-- BEGIN: Page JS-->
<script src="{{asset('/assets/admin/')}}/js/scripts/pages/dashboard-analytics.js" type="text/javascript"></script>
<!-- END: Page JS-->

<script src="{{asset('/assets/admin/js/custom.js')}}"> </script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js">
<script>
    $('#myTable').DataTable({

    rowReorder: {
        selector: 'td:nth-child(2)'
    },
    // responsive: true,

    responsive: {
    details: {
        type: 'column'
    }
    },
    columnDefs: [ {
        className: 'dtr-control',
        orderable: false,
        targets:   0
    } ],
    order: [ 1, 'asc' ]
});
</script>

    <script>
      $('.summernote').summernote({
        placeholder: 'Hello Bootstrap 4',
        tabsize: 2,
        height: 200
      });
    </script>


{{-- Get State And City start --}}
<script>
    ///// Load State By Country ID
    $("#Country").on("change",function(){
        var countryid = this.value;
        $("#State").html("<option value=''>Select</option>");
        $("#City").html("<option value=''>None</option>");
        $.ajax({
            type: "POST",
            url: "{{url('country/fetch-states')}}",
            data:{country_id:countryid,_token: '{{csrf_token()}}'},
            dataType: "json",
            success: function(data){
                $.each(data.states, function (key, value) {
                    $("#State").append('<option value="' + value.id + '">' + value.name + '</option>');
                });
            }
        });
    });

    ///// Load City By State ID
    $("#State").on("change",function(){
        var idState = this.value;
        $("#City").html("<option value=''>Select</option>");
        $.ajax({
            type: "POST",
            url: "{{url('state/fetch-cities')}}",
            data:{state_id:idState,_token: '{{csrf_token()}}'},
            dataType: "json",
            success: function(res){
                $.each(res.cities, function (key, value) {
                    $("#City").append('<option value="' + value.id + '">' + value.name + '</option>');
                });
            }
        });
    });
    $('select[name="partnerId"]').on('change', function() {
        var partnerId = $(this).val();
        $("#productId").html("<option value='' selected disable>Select Product</option>");
        //alert(partnerId);
        if(partnerId) {
            $.ajax({
            type: "POST",
            url: "{{url('codes/fetch-partner-product')}}",
            data:{partnerId:partnerId,_token: '{{csrf_token()}}'},
            dataType: "json",
            success: function(data){
                //console.log(data);
                $.each(data, function (key, value) {
                    $("#productId").append('<option value="'+ value.id +'">'+ value.name +'</option>');
                });
                },
            error: function(err){
                console.log(err)
            }
            });
        }else{
            //$('select[name="productId"]').empty();
        }
    });
</script>
{{-- Get State And City end --}}
</body>
<!-- END: Body-->

</html>
