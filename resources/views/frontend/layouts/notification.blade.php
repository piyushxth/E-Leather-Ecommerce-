@if (session('success_msg'))
    <div class="alert alert-success alert-dismissable fade show text-center">
        <button class="close" data-dismiss="alert" aria-label="Close">×</button>
        {{ session('success_msg') }}
    </div>
@endif


@if (session('error_msg'))
    <div class="alert alert-danger alert-dismissable fade show text-center">
        <button class="close" data-dismiss="alert" aria-label="Close">×</button>
        {{ session('error_msg') }}
    </div>
@endif
