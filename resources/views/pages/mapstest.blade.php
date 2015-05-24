@extends('app')

@section('title')
Maps
@stop

@section('headScripts')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtTfzKv-WTuIyoFc15wrZAHL3jOTmYqtI"></script>
<script>

function initialize() {

  var neighbourhood = new google.maps.LatLng({{ Session::get('latitude') }}, {{ Session::get('longitude') }});

  var mapProp = {
    center:neighbourhood,
    zoom:13,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

  var marker = new google.maps.Marker({
      position: neighbourhood,
      map: map,
      title: 'Hello World!'
  });

}
google.maps.event.addDomListener(window, 'load', initialize);
</script>

@stop

@section('content')

<div class="container">
  <h1 class="text-center">Activities</h1>

  <div id="googleMap" style="width:100%;height:50vh;"></div>

</div>

@stop
