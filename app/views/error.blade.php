@if ($error)
  <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Por favor corrige los siguentes campos:</strong>
    <ul>
        <li>{{ $error }}</li>
    </ul>
  </div>
@endif