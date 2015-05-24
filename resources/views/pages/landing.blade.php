@extends('app')
@section('title')
    //Hack Faster
@stop
@section('content')
    <div class="loader-wrapper">
        <div class="loader"></div>
        <div class="loader-overlay"></div>
    </div>
    <div class="wrapper">
        <div class="name">
            <h3>&#47;&#47;Hack</h3>
        </div>
        <div class="hack">
            <img src="/images/hackathon.png" alt="hackathon"/>
        </div>
        <div class="page">
            <div id="carousel" class="owl-carousel">
                <div class="carousel-item">
                    <h1 class='text-center'>Welcome to our Travel App</h1>

                    <h3 class='text-center'>Travel deep into the Voodoo !</h3>

                    <div class="search">
                        {!! Form::open(array('method' => 'get', 'url' => 'test', 'id' => 'searchForm')) !!}
                        <div class="form-group">
                            {!! Form::text('location', null, ['id' => 'searchBox', 'class' => 'form-control']) !!}
                            <div class="load-listener"></div>

                        </div>
                        <div class="form-group">
                            {!! Form::submit('Search', ['name' => 'submit', 'class' => 'btn-default next']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>


                <div class="carousel-item">
                    <div id='cities'>
                        <h1 class="text-center" id='eventsExampleStatus'>Pick up a date</h1>

                        <p id="dateInput" class="text-center">
                            <input type="text" id="startDate" class="date start" placeholder="Check in"/>
                            <input type="text" id="endDate" class="date end" placeholder="Check out"/>
                        </p>

                        <div id='cities'>

                        </div>


                    </div>
                </div>
                <div class="carousel-item">
                    <div id='activities' class="container" style="height:400px;">


                        <h1 class="text-center">Choose an activity!</h1>

                        <div class="center-block row">
                            <div class="col-xs-12 col-sm-4">
                                <div class="activity-div center-block">
                                    <img src="/images/drinks-in-bar.jpg" alt="bar" class="activity-img">
                                    <h4>Bar</h4>

                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-4">
                                <div class="activity-div center-block">
                                    <img src="/images/restaurant.jpg" alt="bar" class="activity-img">
                                    <h4>Restaurant</h4>
                                    <span class="fa fa-check fa-5x"></span>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-4">
                                <div class="activity-div center-block">
                                    <img src="/images/restaurant.jpg" alt="bar" class="activity-img">
                                    <h4>Activities</h4>
                                    <span class="fa fa-check fa-5x"></span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <button class="btn-default center-block">Go</button>
                </div>

                <div class="carousel-item">
                    <div class='container'>
                        <div class='row'>
                            <div class="bars"></div>
                        </div>
                    </div>
                </div>


                <div class="carousel-item">
                </div>
            </div>


        </div>
        <div class="navigation">
            <div class="arrow arrow-left prev"></div>
            <div class="arrow arrow-right next"></div>
        </div>
        <div class="push"></div>
    </div>


@stop

@section('footer')
    <div class="footer">
        <p class="text-center">2015 Expedia Hackathon Team //Hack</p>
    </div>
@stop

@section('page-script')



    <script src="/owl.carousel/assets/js/jquery-1.9.1.min.js"></script>
    <script src="/owl.carousel/owl-carousel/owl.carousel.js"></script>
    <script type="text/javascript" src="/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="/js/jquery.mockjax.js"></script>
    <script type="text/javascript" src="/js/jquery.autocomplete.js"></script>

    <script type="text/javascript" src="/js/jquery.timepicker.js"></script>
    <script type="text/javascript" src="/js/datepair.js"></script>
    <script type="text/javascript">
        var host = "{{URL::to('/')}}";

        $('#dateInput .date').datepicker({
            'format': 'yyyy-mm-dd',
            'autoclose': true
        });


        // initialize datepair
        var basicExampleEl = document.getElementById('dateInput');
        var datepair = new Datepair(basicExampleEl);

        // some sample handlers
        var inProgress = false;
        var oldFirst = null;
        var oldEnd = null;

        $('#dateInput').on('rangeSelected', function () {

            var startDate = $("#startDate").val();
            var endDate = $("#endDate").val();
            // so it's not called three times.
            if (startDate == oldFirst && endDate == oldEnd) return;
            oldFirst = startDate;
            oldEnd = endDate;

            $.ajax({
                type: 'GET',
                url: host + '/date',
                data: {startDate: startDate, endDate: endDate},
                success: function (msg) {
                    $('#eventsExampleStatus').text(msg);
                }
            });

            inProgress = false;


        });


        jQuery(document).ready(function ($) {


            $("#carousel").owlCarousel({
                singleItem: true,
                rewindNav: false
            });

            var owl = $("#carousel");

            $(".next").click(function () {
                owl.trigger('owl.next');
            })
            $(".prev").click(function () {
                owl.trigger('owl.prev');
            })

            $('#searchForm').on('submit', function (e) {
                e.preventDefault();
                var searchText = $('#searchBox').val();
                $.ajax({
                    type: 'GET',
                    url: host + '/suggestions',
                    data: {location: searchText},
                    success: function (msg) {

                    }
                });
            });
        });

    </script>
    <script type="text/javascript">
        {{--loading animation--}}
        $(document).ready(function () {
            setTimeout(function () {
                $('body').addClass('loaded');
            }, 1000)
        });

    </script>
    <script type="text/javascript">

        function setUpYelp(json) {
            var html = "";
            for (var i in json.businesses) {

                html += "<div class='col-lg-4'>" + "<div class='section'>" + "<div class='row'>";
                html += "<div class='col-xs-4'>" + "<img src='" + json.businesses[i].image_url + "' /img>" + "</div>";
                html += "<div class='col-xs-8'>";
                html += "<h4>" + json.businesses[i].name + "</h4>";
                html += "</div>";
                html += "</div>" + "</div>" + "</div>";
            }

            $('.bars').html(html);
        }


        var select = $('.select-activity');
        select.change(function () {

            $.ajax({
                type: 'GET',
                url: host + '/yelp',
                data: {selection: select.val()},
                success: function (msg) {
                    setUpYelp(eval('(' + msg + ')'));
                    $('#carousel').trigger('owl.next');
                }
            });
        });
    </script>

    <script type="text/javascript">

        var owl = $("#carousel");
        var request;


        var delay = (function () {
            var timer = 0;
            return function (callback, ms) {
                clearTimeout(timer);
                timer = setTimeout(callback, ms);


            };
        })();

        $('#searchBox').autocomplete({
            lookup: function (query, done) {
                // Do ajax call or lookup locally, when done,
                // call the callback and pass your results:
                var searchText = $('#searchBox').val();
                var result = null;

                delay(function () {
                    $(".load-listener").addClass('loader-sm');
                    if (request) {
                        request.abort();
                    }
                    request = $.ajax({
                        type: 'GET',
                        url: host + '/suggestions',
                        data: {location: searchText},
                        success: function (msg) {
                            $(".load-listener").removeClass('loader-sm');
                            done(msg);
                        }
                    });

                }, 400);
            },
            onSelect: function (suggestion) {
                $.ajax({
                    type: 'GET',
                    url: host + '/location',
                    data: {
                        locationName: suggestion.value,
                        locationId: suggestion.data,
                        latitude: suggestion.latitude,
                        longitude: suggestion.longitude
                    },
                    success: function (msg) {
                        owl.trigger('owl.next');
                    }
                });
            }
        });
    </script>

@stop
