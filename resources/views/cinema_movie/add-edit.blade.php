@extends('layouts.mainlayout')

@section('content')

  <div class="container">

    <div class="row">
      <div class="col-lg-6 offset-3">
        <div class="page-header-container">
          <div class="page-title">
            <div class="row">
              <div class="col-sm-12">
                <h2>
                  @if (isset($cinemaMovie))
                    {{ __('Edit Movie show time for ').' '.$cinema->name }}
                  @else
                    {{ __('Add Movie show time for ').' '.$cinema->name }}
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

          @if (isset($cinemaMovie))
            <form method="POST" action="{{ route('cinema-movie.update', $cinemaMovie->id) }}" id="cinemaForm">
              @method('PUT')
          @else
            <form method="POST" action="{{ route('cinema-movie.store') }}" id="cinemaForm">
          @endif
            @csrf

            {{-- Movie field --}}
            <div class="form-group">
              <label for="movie">{{ __('Movie') }}</label>
              <select id="movie_id" name="movie_id" class="form-control">
                <option value="">{{ __('Select Movie') }}</option>
                @foreach ($movies as $movie)
                  <option value="{{ $movie->id }}" @if (isset($cinemaMovie) && $cinemaMovie->movie_id == $movie->id)selected="selected"@endif>{{ $movie->title }}</option>
                @endforeach
              </select>
            </div>

            {{-- Movie Time field --}}
            <div class="form-group">
              <label for="movie_time">{{ __('Session Date Time') }}</label>
              <input id="movie_time" name="movie_time" type="text" class="form-control" value="@if(isset($cinemaMovie)){{ $cinemaMovie->movie_time }}@endif">
            </div>

            <div class="form-group text-right">
              <input type="hidden" value="@if(isset($cinemaMovie)){{ $cinemaMovie->cinema_id }}@else{{ $cinema_id }}@endif" name="cinema_id" id="cinema_id">
              <a href="{{ route('cinemas.index') }}" class="btn btn-default">{{ __('Cancel') }}</a>
              <input type="submit" class="btn btn-success" value="@if (isset($cinemaMovie)) {{ __('Update') }} @else {{ __('Add') }} @endif">
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
      $('#movie_time').datetimepicker({
        format: 'YYYY-MM-DD HH:mm',
        icons: {
	        time: 'fas fa-clock',
        }
      });

      $("#cinemaForm").validate({
        rules: {
          movie_id: {
            required: true
          },
          movie_time: {
            required: true
          }
        }
      });
    });
  </script>
@endsection