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
            <div class="col-xs-12 nb-result">
                <h1 class="text-center">{{$responses['MatchingHotelCount']}} hotels found</h1>



                <h2 class="text-center">from {{$newformat = date('l F j',strtotime($responses['StayDates']['CheckInDate']))}}
                    to {{$newformat = date('l F j Y',strtotime($responses['StayDates']['CheckOutDate']))}}</h2>


            </div>

            <div class="col-xs-12">
                <div class="map"></div>
            </div>

            <div class="col-xs-12 fancy-test">
                <h1 class="text-center">Top 3</h1>
            </div>

            <div class="top"></div> {{-- VOODOOO JQUERY GOING ON--}}

            <hr/>

            <div class="col-xs-12 fancy-test">
                <h1 class="text-center">All hotels</h1>
            </div>


            @foreach ($responses['HotelInfoList']['HotelInfo'] as $hotel)

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
                                    <h4 class="hotel-name">{{{ strlen($hotel['Name']) >= 30 ? substr($hotel['Name'], 0, 28)."..." : $hotel['Name']}}}</h4>
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

                        {{--<p>{{{isset($hotel['Price']['TotalRate'][0]) ? $hotel['Price']['TotalRate'][0] : "No Price set"}}}</p>--}}
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
        $(".match").matchHeight();



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


            setTimeout(function () {
                $('body').addClass('loaded');

            }, 1000)
        });

    </script>
@stop