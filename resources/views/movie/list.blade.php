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
                <h2>{{ __('Movies') }}</h2>
              </div>
              <div class="col-sm-6">
                <a href="{{ route('movies.create') }}" class="btn btn-success"><i class="fas fa-plus-circle"></i> <span>{{ __('Add Movie') }}</span></a>
              </div>
            </div>
          </div>
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>{{ __('Poster') }}</th>
                <th>{{ __('Title') }}</th>
                <th>{{ __('Parental Rating') }}</th>
                <th>{{ __('Movie Length (minutes)') }}</th>
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
                    <td>
                      <a href="{{ route('movies.edit',$movie->id)}}" class="edit"><i class="fas fa-edit" data-toggle="tooltip" title="{{ __('Edit') }}"></i></a>
                      <a href="#deleteMovieModal" data-toggle="modal" class="delete" data-action="{{ route('movies.destroy', $movie->id) }}"><i class="fas fa-trash-alt" data-toggle="tooltip" title="{{ __('Delete') }}"></i></a>
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
          <div class="clearfix">
            {{ $movies->links('pagination::bootstrap-4') }}
          </div>
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
              <h5 class="modal-title">{{ __('Delete Movie') }}</h5>
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