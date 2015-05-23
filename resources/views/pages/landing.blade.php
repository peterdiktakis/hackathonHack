@extends('app')
@section('title')
    Rolling in the Voodoo
@stop
@section('content')
<div class="container">
    <div class="page">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div id="carousel" class="owl-carousel">
                    <div class="carousel-item">
                        <h1 class='text-center'>Welcome to our Travel App</h1>
                        <h3 class='text-center'>Travel deep into the Voodoo !</h3>
                        <div class="search">
                        {!! Form::open(array('method' => 'get', 'url' => 'test', 'id' => 'searchForm')) !!}
                            <div class="form-group col-xs-10">
                                {!! Form::text('location', null, ['id' => 'searchBox', 'class' => 'form-control']) !!}
                            </div>
                            <div class="form-group col-xs-2">
                                {!! Form::submit('Search', ['name' => 'submit', 'class' => 'btn-default']) !!}
                            </div>
                        {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div id ='cities'>
                            <h1>You know i'm all about that bass Jerry !</h1>
                        </div>
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
    <script src="/owl.carousel/assets/js/jquery-1.9.1.min.js"></script>
    <script src="/owl.carousel/owl-carousel/owl.carousel.js"></script>
    <script type="text/javascript">



        var host = "{{URL::to('/')}}";
        jQuery( document ).ready( function( $ ) {


            $("#carousel").owlCarousel({
                items : 1,
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
