@extends('app')

@section('content')
    <div class="loader-wrapper">
        <div class="loader"></div>
        <div class="loader-overlay"></div>
    </div>


@section('page-script')


    <script type="text/javascript">

        $(document).ready(function () {
            setTimeout(function(){$('body').addClass('loaded');},1000)



        });


    </script>
@stop
@stop