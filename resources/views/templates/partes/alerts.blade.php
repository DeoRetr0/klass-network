@if (Session::has('info'))
    <div class="alert alert-info" role="alert" style="margin: 20px">
        {{Session::get('info')}}
    </div>
@endif
