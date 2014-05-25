@if (Session::has('error_message'))
    <div class="container">
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('error_message') }}
        </div>
    </div>
@endif

@if (Session::has('success_message'))
<div class="container">
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('success_message') }}
    </div>
</div>
@endif