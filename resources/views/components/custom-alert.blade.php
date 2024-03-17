@if (session('message'))
    <div class="alert custom-alert {{session('message.status')}} alert-dismissible fade show" id="custom-alert" role="alert">
        <p>{{ session('message.content') }}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
          <i class="fa fa-times"></i>
        </button>
    </div>
@endif

<script>
  let alerta = document.getElementById("custom-alert");

  setTimeout(function () {
      alerta.classList.remove("show");
      alerta.classList.add("hide");
      setTimeout(function () {
          alerta.remove();
      }, 1000);
  }, 2500);
</script>