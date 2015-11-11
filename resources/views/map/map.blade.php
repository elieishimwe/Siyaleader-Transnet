@extends('master')
@section('content')

@include('cases.profile')
@include('cases.refer')
@include('casenotes.add')



<!-- Breadcrumb -->
<ol class="breadcrumb hidden-xs">
    <li><a href="#">Administration</a></li>
    <li class="active">Map</li>
</ol>



<div id="mapBlockDiv" class="block-area" style="height:800px">

    <iframe id="googleMap" src="map.php" MARGINWIDTH=0 MARGINHEIGHT=0 SCROLLING=auto HSPACE=0 VSPACE=0 NORESIZE frameborder=0 style="width:100%;height:100%;" allowFullScreen></iframe>

</div>


<!--  MAP CONTAINER START  -- >
<!--
<div id="mapBlockDiv" class="block-area dynDiv_setLimit" style="height:800px">


        <a name="mapTop"></a>
        <h2 class="tile-title"><font style="font-size:14px">HEAT MAP</font></h2>
            <div class="tile-config dropdown">
                <a data-toggle="dropdown" href="" class="tile-menu"></a>
                    <ul class="dropdown-menu pull-right text-right">
                        <li><a href="javascript:void()" onclick="document.getElementById('googleMap').src='map/dev/map.php'">Refresh</a></li>
                        <li><a href="#mapTop">Top Align Map</a></li>
                        <li><a href="javascript:void(0)" onclick="goFullscreen('googleMap');setTimeout(resizeMap(),250)">Go Fullscreen</a>
                    </ul>
            </div>

            <div class="dynDiv_minmaxDiv dynDiv_minmax_Height-29" onclick="toggleMap()">&times;</div>

            <IFRAME id="googleMap" src="map.php" MARGINWIDTH=0 MARGINHEIGHT=0 SCROLLING=auto HSPACE=0 VSPACE=0 NORESIZE frameborder=0 style="width:100%;height:100%;" allowFullScreen></IFRAME>
            <div id="sa-map" style="opacity:1;margin-bottom:20px">

            </div>


</div> -->

<!--  MAP CONTAINER END  -- >

@endsection

@section('footer')
<script>
   $(document).ready(function() {


    $("#caseReporter").tokenInput("getContacts",{tokenLimit:1});

    $("#caseCategory").on("change",function(){

        $.get("{{ url('/api/dropdownCategory/sub-category/category')}}",
        { option: $(this).val()},
        function(data) {
        $('#caseSubCategory').empty();
        $('#caseSubSubCategory').empty();
        /* $('#District').removeAttr('disabled');*/
        $('#caseSubCategory').append("<option value='0'>Select Sub Category</option>");
        $('#caseSubSubCategory').append("<option value='0'>Select Sub Sub Category</option>");

        $.each(data, function(key, element) {
        $('#caseSubCategory').append("<option value="+ key +">" + element + "</option>");
        });
        });

    });

     $("#caseSubCategory").on("change",function(){

        $.get("{{ url('/api/dropdownCategory/sub-sub-category/sub-category')}}",
        { option: $(this).val()},
        function(data) {
        $('#caseSubSubCategory').empty();
        /* $('#District').removeAttr('disabled');*/
        $('#caseSubSubCategory').append("<option value='0'>Select Sub Category</option>");
        $.each(data, function(key, element) {
        $('#caseSubSubCategory').append("<option value="+ key +">" + element + "</option>");
        });
        });

    });


   })
</script>

@endsection
