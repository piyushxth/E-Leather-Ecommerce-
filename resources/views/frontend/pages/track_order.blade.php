@extends('frontend.layouts.master')
@section('content')
    <section class="category sec-padding">
        <div class="container">
            <div class="sec-title text-center">
                <h2>Track Order</h2>
                <h3>Track Order</h3>
            </div>
            @if ($order->status)
                <div class="text-center p-4">
                    <p><strong>Your product is <span class="text-info">{{ $order->status }}</span></strong></p>
                </div>
            @endif
            <form action="{{ route('track.order') }}" method="GET">
                @csrf
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="track_order" id="track_order"
                                value="{{ old('track_order') }}" placeholder="Eg: ORD-1FE4DFHSD4" required>
                            @error('track_order')
                                <span class="text-danger">
                                    {{ $errors->first('track_order') }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-md submit">Submit</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </section>


@endsection
