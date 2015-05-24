@extends('app')
@section('title')
    //Hack Faster
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
            <div class="col-xs-12">
                <h1 class="text-center">{{$responses['MatchingHotelCount']}} hotels found</h1>

                <div class="map"></div>

                <h2 class="text-center">from {{$newformat = date('l F j',strtotime($responses['StayDates']['CheckInDate']))}}
                    to {{$newformat = date('l F j Y',strtotime($responses['StayDates']['CheckOutDate']))}}</h2>

            </div>

            @foreach ($responses['HotelInfoList']['HotelInfo'] as $hotel)

                <div class="col-md-4 col-sm-6">
                    <div class="section match" @if (isset($hotel['DetailsUrl'])) onclick="location.href='{{$hotel['DetailsUrl']}}'" style="cursor: pointer" @endif>

                        <img src={{{isset($hotel['ThumbnailUrl']) ? $hotel['ThumbnailUrl'] : 'images/hotel-room.jpeg'}}} alt="hotel-thumb" class="img-responsive"/>
                        <h4>{{{ strlen($hotel['Name']) >= 20 ? substr($hotel['Name'], 0, 18)."..." : $hotel['Name']}}}</h4>

                        <h6>{{$hotel['Location']['StreetAddress'].' '.$hotel['Location']['City'].' '.$hotel['Location']['Province'].' '.$hotel['Location']['Country']}}</h6>

                        <p>{{{isset($hotel['Description']) ? $hotel['Description'] : "No description available..."}}}</p>

                        {{--<p>{{{isset($hotel['Price']['TotalRate'][0]) ? $hotel['Price']['TotalRate'][0] : "No Price set"}}}</p>--}}
                        {{--<p>{{{isset($hotel['Price']['TotalRate'][1]) ? $hotel['Price']['TotalRate'][1] : "No Price set"}}}</p>--}}



                        @if(isset($hotel['GuestRating']))
                            <p>Guest rating :
                            @for ($i = 0; $i <= $hotel['GuestRating'] -1; $i++)
                                <i class="fa fa-star"></i>
                            @endfor
                            @if ($hotel['GuestRating'] - floor($hotel['GuestRating']) >= 0.5)
                                    <i class="fa fa-star-half"></i>
                            @endif
                            {{$hotel['GuestRating']}}</p>
                        @endif

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
        $(".match").matchHeight();
    </script>
    <script type="text/javascript">
        {{--loading animation--}}
        $(document).ready(function () {
            setTimeout(function () {
                $('body').addClass('loaded');
            }, 1000)
        });

    </script>
@stop