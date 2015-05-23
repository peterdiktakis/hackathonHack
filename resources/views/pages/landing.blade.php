@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<h1 class='text-center'>Welcome to our Travel App</h1>
            <h3 class='text-center'>Travel deep into the Voodoo !</h3>

            {!! Form::open(array('method' => 'get', 'url' => 'test', 'id' => 'searchForm')) !!}
                <div class="form-group col-xs-10">
                    {!! Form::text('location', null, ['id' => 'searchBox', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group col-xs-2">
                    {!! Form::submit('Search', ['name' => 'submit', 'class' => 'btn btn-primary form-control']) !!}
                </div>
            {!! Form::close() !!}

            <div id ='cities'>

            </div>

        </div>
        <div class="col-lg-4">
            <div class="section">
                <h3>Title</h3>
                <p>text text text text text text text text text text text
                    text text text text text text text text text text text
                    text text text text text text text text text text text
                    text text text text text text text text text text text</p>
                <a href="#" class="btn-default">Button</a>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="section">
                <h3>Title</h3>
                <p>text text text text text text text text text text text
                    text text text text text text text text text text text
                    text text text text text text text text text text text
                    text text text text text text text text text text text</p>
                <a href="#" class="btn-default">Button</a>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="section">
                <h3>Title</h3>
                <p>text text text text text text text text text text text
                    text text text text text text text text text text text
                    text text text text text text text text text text text
                    text text text text text text text text text text text</p>
                <a href="#" class="btn-default">Button</a>
            </div>
        </div>
	</div>
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
