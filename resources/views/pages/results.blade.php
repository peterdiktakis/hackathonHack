@extends('app')
@section('title')
//Hack Faster
@stop

@section('headScripts')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtTfzKv-WTuIyoFc15wrZAHL3jOTmYqtI"></script>
<script>

function initialize() {

  var neighbourhood = new google.maps.LatLng({{ Session::get('latitude') }}, {{ Session::get('longitude') }});

  var mapProp = {
    center:neighbourhood,
    zoom:15,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  var map=new google.maps.Map(document.getElementById("map"),mapProp);

  var locations = {!! $geos !!};



  for (i = 0; i < locations.length; i++) {

<<<<<<< HEAD
    var marker = new google.maps.Marker({
         position: new google.maps.LatLng(locations[i][2], locations[i][3]),
         map: map,
         icon: 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=' + locations[i][0] + '|FF0000|000000'
=======
    var contentString = 'hello';



    var infowindow = new google.maps.InfoWindow({
      content: contentString
    });

    marker = new google.maps.Marker({
         position: new google.maps.LatLng(locations[i][0], locations[i][1]),
         map: map
    });

    google.maps.event.addListener(marker, 'click', (function(marker, i) {
         return function() {
             infowindow.setContent(locations[i][0]);
             infowindow.open(map, marker);
         }
    })(marker, i));

    google.maps.event.addListener(marker, 'mouseover', function() {
        infowindow.open(map, this);
    });

    google.maps.event.addListener(marker, 'mouseout', function() {
        infowindow.close();
>>>>>>> origin/master
    });
}

}
google.maps.event.addDomListener(window, 'load', initialize);
</script>

@stop

@section('content')

<div class="loader-wrapper">
  <div class="loader"></div>
  <div class="loader-overlay"></div>
</div>
<div class="name">
  <h3>&#47;&#47;Hack</h3>
</div>
<div class="hack">
  <img src="/images/hackathon.png" alt="hackathon"/>
</div>
<div class="results-page">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 nb-result">
        <h1 class="text-center">{{$responses['MatchingHotelCount']}} hotels found</h1>



        <h2 class="text-center">from {{$newformat = date('l F j',strtotime($responses['StayDates']['CheckInDate']))}}
          to {{$newformat = date('l F j Y',strtotime($responses['StayDates']['CheckOutDate']))}}</h2>


        </div>


        <div id='map' class="map"></div>


        <div class=" fancy-test">
          <h1 class="text-center">Top 3</h1>
        </div>

        <div class="row">
          <div class="top"></div>
        </div>

        <div class="col-xs-12 fancy-test">
          <h1 class="text-center">Business Activity</h1>
        </div>
        <div class="row">
          @foreach ($businesses['businesses'] as $business)
          <div class="col-md-4 col-sm-6">
            <div class="section match" >
              <div class="row">
                <div class="col-xs-3">
                  <div class="thumb-wrap">
                    <img src={{{($business['image_url'])}}} alt="bar-thumb" class="img-responsive hotel-thumb"/>
                  </div>
                </div>
                <div class="col-xs-9">
                  <div>
                    <h4 class="hotel-name">{{{strlen($business['name']) >= 30 ? substr($business['name'], 0, 28)."..." : $business['name']}}}</h4>
                    <p class="hotel-location">{{{isset($business['location']['display_address']) ? $business['location']['display_address'][0] . ", " . $business['location']['postal_code']: "No location set..."}}}</p>
                  </div>
                  @if(isset($business['rating']))
                  <p class="hotel-rating">Guest rating :
                    @for ($i = 0; $i <= $business['rating'] -1; $i++)
                    <i class="fa fa-star"></i>
                    @endfor
                    @if ($business['rating'] - floor($business['rating']) >= 0.5)
                    <i class="fa fa-star-half"></i>
                    @endif
                    <span class="grade">{{$business['rating']}}</span></p>
                    @endif
                  </div>


                  <div class="col-xs-12">
                    <p class="hotel-description">&#34;{{{isset($business['snippet_text']) ? $business['snippet_text'] : "No description available..."}}}&#34;</p>
                  </div>
                </div>


              </div>
            </div>
            @endforeach
          </div>


          <div class="fancy-test ">

            <h1 class="text-center">All hotels</h1>

          </div>


          {{--*/ $num = 0 /*--}}

          @foreach ($responses['HotelInfoList']['HotelInfo'] as $hotel)

          {{--*/ $num++ /*--}}

          <div class="col-md-4 col-sm-6">
            <div class="section match" @if (isset($hotel['DetailsUrl'])) onclick="location.href='{{$hotel['DetailsUrl']}}'" style="cursor: pointer" @endif>



              <div class="row">
                <div class="col-xs-3">
                  <div class="thumb-wrap">
                    <img src={{{isset($hotel['ThumbnailUrl']) ? $hotel['ThumbnailUrl'] : 'images/hotel-room.jpeg'}}} alt="hotel-thumb" class="img-responsive hotel-thumb"/>
                  </div>
                </div>
                <div class="col-xs-9">
                  <div class="hotel-text-wrap">
                      <img src="/images/pin.png" class="pin-icon"/>
                      <p class='text-center @if ($num >= 10)pin-number-lg @else pin-number-sm @endif'>{{ $num }}</p>
                      <h4 class="hotel-name">{{{ strlen($hotel['Name']) >= 27 ? substr($hotel['Name'], 0, 25)."..." : $hotel['Name']}}}</h4>
                    <p class="hotel-location">{{$hotel['Location']['StreetAddress'].' '.$hotel['Location']['City'].' '.$hotel['Location']['Province'].' '.$hotel['Location']['Country']}}</p>
                  </div>
                </div>

              </div>


              @if(isset($hotel['GuestRating']))
              <p class="hotel-rating">Guest rating :
                @for ($i = 0; $i <= $hotel['GuestRating'] -1; $i++)
                <i class="fa fa-star"></i>
                @endfor
                @if ($hotel['GuestRating'] - floor($hotel['GuestRating']) >= 0.5)
                <i class="fa fa-star-half"></i>
                @endif
                <span class="grade">{{$hotel['GuestRating']}}</span></p>
                @endif


                <p class="hotel-description">{{{isset($hotel['Description']) ? $hotel['Description'] : "No description available..."}}}</p>

                {{--<p>{{isset($hotel['Price']['TotalRate'][0]) ? $hotel['Price']['TotalRate'][0] : "No Price set"}}}</p>--}}
                {{--<p>{{{isset($hotel['Price']['TotalRate'][1]) ? $hotel['Price']['TotalRate'][1] : "No Price set"}}}</p>--}}

              </div>
            </div>
            @endforeach

          </div>
        </div>
      </div>
      @stop

      @section('page-script')
      <script src="/js/jquery-match-height-master/jquery.matchHeight-min.js"></script>

      <script>




      </script>
      <script type="text/javascript">
      {{--loading animation--}}
      $(document).ready(function () {
        var countTop = 0;

        $(".grade").each(function(){
          console.log($(this).text() === "5.0");
          if ($(this).text() === "5.0" && countTop < 3){
            $(this).closest($(".section")).parent().clone().appendTo(".top");
            countTop += 1;
          }
        });

        $(".match").matchHeight();


        setTimeout(function () {
          $('body').addClass('loaded');

        }, 1000)
      });

      </script>
      @stop
