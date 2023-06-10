<button class="btn btn-danger btn-sm delete-button">
    <i class="fa fa-trash"></i>
</button>
<form action='{{ $url }}' method='POST' class="delete-form">
    @csrf
    @method('DELETE')
</form>
