<a href="{{route('products.show',$row->id)}}" class="edit btn btn-primary btn-sm"><i class="mdi mdi-eye"></i>View</a>
<a href="{{route('products.edit',$row->id)}}" class="edit btn btn-primary btn-sm"><i class="mdi mdi-pencil"></i>Edit</a>
<a href="#" class="edit btn btn-danger btn-sm" onclick="if(confirm('Are you sure you want to delete.')) document.getElementById('delete-{{ $row->id }}').submit()">
    <i class="fa fa-trash"></i>
    Delete
</a>
<form id="delete-{{ $row->id }}" action="{{ route('products.destroy', $row->id) }}" method="POST">
    @method('DELETE')
    @csrf
</form>
