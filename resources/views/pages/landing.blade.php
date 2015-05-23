@extends('app')
@section('title')
    //Hack Faster
@stop
@section('content')
    <div class="name">
        <h1>&#47;&#47;Hack</h1>
    </div>
    <div class="page">
        <div class="row">
            <div class="col-md-12">
                <div id="carousel" class="owl-carousel">
                    <div class="carousel-item">
                        <h1 class='text-center'>Welcome to our Travel App</h1>
                        <h3 class='text-center'>Travel deep into the Voodoo !</h3>
                        <div class="search">
                        {!! Form::open(array('method' => 'get', 'url' => 'test', 'id' => 'searchForm')) !!}
                            <div class="form-group">
                                {!! Form::text('location', null, ['id' => 'searchBox', 'class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::submit('Search', ['name' => 'submit', 'class' => 'btn-default']) !!}
                            </div>
                        {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div id ='cities'>
                            <p id="dateInput">
                                <input type="text" id="startDate" class="date start" placeholder="Check in"/>
                                <input type="text" class="date end" placeholder="Check out"/>
                            </p>
                            <div id ='cities'>

                            </div>
                            <h2 id ='eventsExampleStatus'>test</h2>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@stop

@section('page-script')

    <link rel="stylesheet" href="/owl.carousel/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="/owl.carousel/owl-carousel/owl.theme.css">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-datepicker.css" />

    <script src="/owl.carousel/assets/js/jquery-1.9.1.min.js"></script>
    <script src="/owl.carousel/owl-carousel/owl.carousel.js"></script>
    <script type="text/javascript" src="/js/bootstrap-datepicker.js"></script>

    <script type="text/javascript" src="/js/jquery.timepicker.js"></script>
    <script type="text/javascript" src="/js/datepair.js"></script>


    <script type="text/javascript">

        $('#dateInput .date').datepicker({
            'format': 'm/d/yyyy',
            'autoclose': true
        });


        // initialize datepair
        var basicExampleEl = document.getElementById('dateInput');
        var datepair = new Datepair(basicExampleEl);

        // some sample handlers
        $('#dateInput').on('rangeSelected', function() {
            $('#eventsExampleStatus').text($("#startDate").val());
        });


        var host = "{{URL::to('/')}}";
        jQuery( document ).ready( function( $ ) {


            $("#carousel").owlCarousel({
                singleItem : true
            });

            $('#searchForm').on('submit', function (e) {
                e.preventDefault();
                var searchText = $('#searchBox').val();
                $.ajax({
                    type: 'GET',
                    url: host + '/suggestions',
                    data: {location: searchText},
                    success: function (msg) {
                        $('#cities').text(msg);
                    }
                });
            });
        });

    </script>

@stop
