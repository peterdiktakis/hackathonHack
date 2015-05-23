@extends('app')

@section('content')
    <div class="container">
        <h1>About us</h1>

        <p>Hackathon 2015 Mo Fuckers</p>

        <div>I JOIN THE BATTLE</div>
        <p>this is sparta!</p>

    {!! Form::open(array('method' => 'get', 'url' => 'test', 'id' => 'searchForm')) !!}
        <div class="form-group col-xs-8">
            {!! Form::text('location', null, ['id' => 'searchBox', 'class' => 'form-control']) !!}
        </div>
        <div class="form-group col-xs-4">
            {!! Form::submit('Search', ['name' => 'submit', 'class' => 'btn btn-primary form-control']) !!}
        </div>
    {!! Form::close() !!}

    </div>
@stop

@section('page-script')
    <script type="text/javascript">


        var host = "{{URL::to('/')}}";
        jQuery( document ).ready( function( $ ) {

            $('#searchForm').on('submit', function (e) {
                e.preventDefault();
                var searchText = $('#searchBox').val();
                $.ajax({
                    type: 'GET',
                    url: host + '/test',
                    data: {location: searchText},
                    success: function (msg) {
                        console.log(msg);
                    }
                });
            });
        });

    </script>
@stop