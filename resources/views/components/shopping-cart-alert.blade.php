@if (session('success'))
    <div class="alert custom-alert alert-dismissible fade show" role="alert">
        <p>{{ session('success') }}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
          <i class="fa fa-times"></i>
        </button>
      </div>
@endif