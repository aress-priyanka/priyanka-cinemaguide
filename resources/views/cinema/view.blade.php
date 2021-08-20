@extends('layouts.mainlayout')

@section('content')

  <div class="container">

    <div class="container-xl">

      <div class="row mt-4">
        <div class="col-lg-12">
          @if ($message = Session::get('success'))
            <div class="alert alert-success">
              {{ $message }}
            </div>
          @endif
        </div>
      </div>

      <div class="table-responsive">
        <div class="table-wrapper">
          <div class="table-title">

            <div class="row">
              <div class="col-sm-6">
                <h2>{{ __('Movies at') . ' ' . $cinema->name }}</h2>
              </div>
              <div class="col-sm-6">
                <a href="{{ route('cinema-movie.create', $cinema->id) }}" class="btn btn-success"><i class="fas fa-plus-circle"></i> <span>{{ __('Add Movie to'). ' ' . $cinema->name }}</span></a>
              </div>
            </div>
          </div>
          <div class="row detail-row">
            <div class="col-sm-6">
              <div><span>{{ __('Address') }}</span>: {{ $cinema->address }}</div>
              <div><span>{{ __('Location') }}</span>: {{ $cinema->latitude }},{{ $cinema->longitude }}</div>
              <div><span>{{ __('Seating Capacity') }}</span>: {{ $cinema->seating_capacity }}</div>
            </div>
          </div>
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>{{ __('Poster') }}</th>
                <th>{{ __('Title') }}</th>
                <th>{{ __('Parental Rating') }}</th>
                <th>{{ __('Movie Length (minutes)') }}</th>
                <th>{{ __('Time') }}</th>
                <th>{{ __('Actions') }}</th>
              </tr>
            </thead>
            <tbody>
              @if(!empty($movies) && $movies->count())
                @foreach($movies as $key => $movie)
                  <tr>
                    <td>
                      <img src="{{url(config('cinemaguide.poster_upload_path').$movie->poster)}}" width="100" onerror="this.onerror=null;this.src='{{ asset('images/default-poster.jpg') }}';"/>
                    </td>
                    <td>{{ $movie->title }}</td>
                    <td>{{ $movie->parental_rating }}</td>
                    <td>{{ $movie->movie_length }}</td>
                    <td>{{ date('d M Y H:i', strtotime($movie->movie_time)) }}</td>
                    <td>
                      <a href="{{ route('cinema-movie.edit',$movie->id)}}" class="edit"><i class="fas fa-edit" data-toggle="tooltip" title="{{ __('Edit') }}"></i></a>
                      <a href="#deleteMovieModal" data-toggle="modal" class="delete" data-action="{{ route('cinema-movie.destroy', $movie->id) }}"><i class="fas fa-trash-alt" data-toggle="tooltip" title="{{ __('Delete') }}"></i></a>
                    </td>
                  </tr>
                @endforeach
              @else
                <tr>
                  <td colspan="5" class="text-center">No records found.</td>
                </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Delete Modal HTML -->
    <div id="deleteMovieModal" class="modal fade">
      <div class="modal-dialog">
        <form method="post">
          @csrf
          @method('DELETE')

          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{ __('Delete Movie added to ') . ' '. $cinema->name }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              {{ __('Are you sure you want to delete the record?') }}
            </div>
            <div class="modal-footer">
              <button type="button" class="btn bg-white" data-dismiss="modal">{{ __('Close') }}</button>
              <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
            </div>
          </div>

        </form>
      </div>
    </div>

  </div>
@endsection

@section('script')
  <script>
    $('#deleteMovieModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var action = button.data('action');
      var modal = $(this);
      modal.find('form').attr('action', action);
    });
  </script>
@endsection