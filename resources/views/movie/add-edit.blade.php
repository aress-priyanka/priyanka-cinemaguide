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
                  @if (isset($movie))
                    {{ __('Edit Movie') }}
                  @else
                    {{ __('Add Movie') }}
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

          @if (isset($movie))
            <form method="POST" action="{{ route('movies.update', $movie->id) }}" id="movieForm" enctype="multipart/form-data">
              @method('PUT')
          @else
            <form method="POST" action="{{ route('movies.store') }}" id="movieForm" enctype="multipart/form-data">
          @endif
            @csrf

            {{-- Title field --}}
            <div class="form-group">
              <label for="title">{{ __('Title') }}</label>
              <input id="title" name="title" type="text" class="form-control" value="@if(isset($movie)){{ $movie->title }}@endif">
            </div>

            {{-- Parental Rating field --}}
            <div class="form-group">
              <label for="parental_rating">{{ __('Parental Rating') }}</label>
              <select id="parental_rating" name="parental_rating" class="form-control">
                <option value="">{{ __('Select Parental Rating') }}</option>
                @foreach ($parental_rating_types as $rating_types)
                  <option value="{{ $rating_types }}" @if (isset($movie) && $movie->parental_rating == $rating_types)selected="selected"@endif>{{ $rating_types }}</option>
                @endforeach
              </select>
            </div>

            {{-- Movie Length field --}}
            <div class="form-group">
              <label for="movie_length">{{ __('Movie Length (minutes)') }}</label>
              <input id="movie_length" name="movie_length" type="text" class="form-control" value="@if (isset($movie)){{ $movie->movie_length }}@endif">
            </div>

            {{-- Poster field --}}
            <div class="form-group">
              <label for="poster">{{ __('Poster') }}</label>
              @if (isset($movie))
                <div class="mb-4">
                  <img src="{{url(config('cinemaguide.poster_upload_path').$movie->poster)}}" width="100" onerror="this.onerror=null;this.src='{{ asset('images/default-poster.jpg') }}';"/>
                </div>
              @endif
              <input id="poster" name="poster" type="file" class="form-control-file">
            </div>

            <div class="form-group text-right">
              <a href="{{ route('movies.index') }}" class="btn btn-default">{{ __('Cancel') }}</a>
              <input type="submit" class="btn btn-success" value="@if (isset($movie)) {{ __('Update') }} @else {{ __('Add') }} @endif">
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
      $("#movieForm").validate({
        rules: {
          title: {
            required: true
          },
          parental_rating: {
            required: true
          },
          movie_length: {
            required: true,
            number: true
          },
          poster: {
            required: true,
            extension: "jpg|jpeg|png"
          }
        }
      });
    });
  </script>
@endsection