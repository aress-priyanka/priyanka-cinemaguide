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
                <h2>{{ __('Cinemas') }}</h2>
              </div>
              <div class="col-sm-6">
                <a href="{{ route('cinemas.create') }}" class="btn btn-success"><i class="fas fa-plus-circle"></i> <span>{{ __('Add Cinema') }}</span></a>
              </div>
            </div>
          </div>
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Address') }}</th>
                <th>{{ __('Latitude') }}</th>
                <th>{{ __('Longitude') }}</th>
                <th>{{ __('Seating Capacity') }}</th>
                <th>{{ __('Actions') }}</th>
              </tr>
            </thead>
            <tbody>
              @if(!empty($cinemas) && $cinemas->count())
                @foreach($cinemas as $key => $cinema)
                  <tr>
                    <td>{{ $cinema->name }}</td>
                    <td>{{ $cinema->address }}</td>
                    <td>{{ $cinema->latitude }}</td>
                    <td>{{ $cinema->longitude }}</td>
                    <td>{{ $cinema->seating_capacity }}</td>
                    <td>
                      <a href="{{ route('cinemas.show',$cinema->id)}}" class="view"><i class="fas fa-eye" data-toggle="tooltip" title="{{ __('View') }}"></i></a>
                      <a href="{{ route('cinemas.edit',$cinema->id)}}" class="edit"><i class="fas fa-edit" data-toggle="tooltip" title="{{ __('Edit') }}"></i></a>
                      <a href="#deleteCinemaModal" data-toggle="modal" class="delete" data-action="{{ route('cinemas.destroy', $cinema->id) }}"><i class="fas fa-trash-alt" data-toggle="tooltip" title="{{ __('Delete') }}"></i></a>
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
            {{ $cinemas->links('pagination::bootstrap-4') }}
          </div>
        </div>
      </div>
    </div>

    <!-- Delete Modal HTML -->
    <div id="deleteCinemaModal" class="modal fade">
      <div class="modal-dialog">
        <form method="post">
          @csrf
          @method('DELETE')

          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{ __('Delete Cinema') }}</h5>
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
    $('#deleteCinemaModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var action = button.data('action');
      var modal = $(this);
      modal.find('form').attr('action', action);
    });
  </script>
@endsection