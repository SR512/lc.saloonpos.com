<a href="{{route('invoices.show',$row->id)}}" class="edit btn btn-primary btn-sm"><i class="mdi mdi-eye"></i>View invoice</a>
<a href="{{route('invoices.edit',$row->id)}}" class="edit btn btn-primary btn-sm"><i class="mdi mdi-account-edit"></i>Edit</a>
<a href="#" class="edit btn btn-danger btn-sm" onclick="if(confirm('Are you sure you want to delete.')) document.getElementById('delete-{{ $row->id }}').submit()">
    <i class="fa fa-trash"></i>
    Delete
</a>
<form id="delete-{{ $row->id }}" action="{{ route('invoices.destroy', $row->id) }}" method="POST">
    @method('DELETE')
    @csrf
</form>
