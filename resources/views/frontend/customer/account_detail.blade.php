@extends('frontend.layouts.master')
@section('content')
<section class="breadcrumb-section py-4">
   <div class="container">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Acount Information</li>
         </ol>
      </nav>
   </div>
</section>
<div class="profile-dashboard-section custom-margin">
   <div class="container">
      <div class="row gy-4">
         <div class="col-lg-3 col-md-4 col-sm-12">
            @include('frontend.customer.sidebar')
         </div>
         <div class="col-lg-9 col-md-8 col-sm-12">
            <div class="profile">
               <div class="title">
                  <span>Update Profile</span>
               </div>
               @if(session()->has('success_msg'))
                    <div class="mt-4 alert alert-success">
                        {{ session()->get('success_msg') }}
                    </div>
               @endif

               @if(session()->has('error_msg'))
                    <div class="mt-3 alert alert-error">
                        {{ session()->get('error_msg') }}
                    </div>
               @endif

               <form action="{{ route('customer.update', auth()->user()->id) }}" method="post" id="user-submit-form" autocomplete="off">
                  @csrf()
                  @method('put')
                  <div class="pt-2">
                     <label for="name">Name:</label>
                     <input type="text" name="name" id="name" value="{{ auth()->user()->name }}" autocomplete="off" placeholder="Name" />
                     @error('name')
                        <span class="error-message pt-3 text-danger">{{ $errors->first('name') }}</span>
                     @enderror
                  </div>
                  <div class="email pt-3">
                     <label for="email">E-mail</label>
                     <input type="email" name="email" id="email" value="{{ auth()->user()->email }}" autocomplete="off" placeholder="Email" />

                     @error('email')
                        <span class="error-message pt-3 text-danger">{{ $errors->first('email') }}</span>
                     @enderror
                  </div>
                  <div class="number pt-3">
                     <label for="phone">Contact Number</label>
                     <input type="phone" name="phone" id="phone" value="{{ auth()->user()->phone }}" autocomplete="off" placeholder="Contact Number" />
                     @error('phone')
                        <span class="error-message pt-3 text-danger">{{ $errors->first('phone') }}</span>
                     @enderror
                  </div>

                  <div class="provience pt-3">
                     <label for="province"> Province </label>
                     <select name="provience" id="provience">
                        <option value="">Select Province</option>
                        @if($provinces->isNotEmpty())
                           @foreach($provinces as $province)
                              <option value="{{ $province->id }}" @if($province_id == $province->id) {{ "selected='selected'" }} @endif>
                                 {{ $province->province_name }}
                              </option> 
                           @endforeach
                        @endif
                     </select>
                     @error('provience')
                        <span class="error-message pt-3 text-danger">{{ $errors->first('provience') }}</span>
                     @enderror
                  </div>

                  <div class="district pt-3">
                     <label for="district">District</label>
                     <select name="district" id="district">
                        <option value="">Select District</option>
                     </select>
                     @error('district')
                        <span class="error-message pt-3 text-danger">{{ $errors->first('district') }}</span>
                     @enderror
                  </div>

                  <div class="address pt-3">
                     <label for="address">Address</label>
                     <input type="text" name="address" id="address" value="{{ auth()->user()->address }}" autocomplete="off" />
                     @error('address')
                        <span class="error-message pt-3 text-danger">{{ $errors->first('address') }}</span>
                     @enderror
                  </div>

                  <div class="submit-button d-block"><button type="submit">Update</button></div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection