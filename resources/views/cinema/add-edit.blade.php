@extends('layouts.mainlayout')

@section('content')

  <div class="container">

    <div class="row">
      <div class="col-lg-6 offset-3">
        <div class="page-header-container">
          <div class="page-title">
            <div class="row">
              <div class="col-sm-6">
                <h2>
                  @if (isset($cinema))
                    {{ __('Edit Cinema') }}
                  @else
                    {{ __('Add Cinema') }}
                  @endif
                  </h2>
              </div>
            </div>
          </div>

          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          @if (isset($cinema))
            <form method="POST" action="{{ route('cinemas.update', $cinema->id) }}" id="cinemaForm">
              @method('PUT')
          @else
            <form method="POST" action="{{ route('cinemas.store') }}" id="cinemaForm">
          @endif
            @csrf

            {{-- Name field --}}
            <div class="form-group">
              <label for="name">{{ __('Name') }}</label>
              <input id="name" name="name" type="text" class="form-control" value="@if(isset($cinema)){{ $cinema->name }}@endif">
            </div>

            {{-- Address field --}}
            <div class="form-group">
              <label for="address">{{ __('Address') }}</label>
              <textarea id="address" name="address" class="form-control">@if (isset($cinema)){{ $cinema->address }}@endif</textarea>
            </div>

            {{-- Latitude field --}}
            <div class="form-group">
              <label for="latitude">{{ __('Latitude') }}</label>
              <input id="latitude" name="latitude" type="text" class="form-control" value="@if (isset($cinema)){{ $cinema->latitude }}@endif">
            </div>

            {{-- Longitude field --}}
            <div class="form-group">
              <label for="longitude">{{ __('Longitude') }}</label>
              <input id="longitude" name="longitude" type="text" class="form-control" value="@if (isset($cinema)){{ $cinema->longitude }}@endif">
            </div>

            {{-- Seating Capacity field --}}
            <div class="form-group">
              <label for="seating_capacity">{{ __('Seating Capacity') }}</label>
              <input id="seating_capacity" name="seating_capacity" type="text" class="form-control" value="@if (isset($cinema)){{ $cinema->seating_capacity }}@endif">
            </div>

            <div class="form-group text-right">
              <a href="{{ route('cinemas.index') }}" class="btn btn-default">{{ __('Cancel') }}</a>
              <input type="submit" class="btn btn-success" value="@if (isset($cinema)) {{ __('Update') }} @else {{ __('Add') }} @endif">
            </div>

          </form>
        </div>
      </div>
    </div>

  </div>
@endsection

@section('script')
  <script>
    $(document).ready(function() {
      $("#cinemaForm").validate({
        rules: {
          name: {
            required: true
          },
          address: {
            required: true
          },
          latitude: {
            required: true
          },
          longitude: {
            required: true
          },
          seating_capacity: {
            required: true,
            number: true
          }
        }
      });
    });
  </script>
@endsection