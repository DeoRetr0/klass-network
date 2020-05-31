@if (Session::has('info'))
    <div class="alert alert-info" role="alert" style="margin: 20px">
        {{Session::get('info')}}
    </div>
    <script>
        setTimeout(function() {
            $('.alert-info').remove();
        }, 5000);
    </script>
@endif
