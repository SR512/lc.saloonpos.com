<a href="{{route('memberships.show',$row->id)}}" class="edit btn btn-primary btn-sm"><i class="mdi mdi-eye"></i>View</a>
<a href="{{route('memberships.edit',$row->id)}}" class="edit btn btn-primary btn-sm"><i class="mdi mdi-pencil"></i>Edit</a>
<a href="#" class="edit btn btn-danger btn-sm"
   onclick="if(confirm('Are you sure you want to delete.')) document.getElementById('delete-{{ $row->id }}').submit()">
    <i class="fa fa-trash"></i>
    Delete
</a>
@if($row->status == 'ACTIVE')
    <a href="{{route('membership.status',$row->id)}}" class="edit btn btn-danger btn-sm"><i
            class="mdi mdi-account-edit"></i>Deactive</a>
@else
    <a href="{{route('membership.status',$row->id)}}" class="edit btn btn-success btn-sm"><i
            class="mdi mdi-account-edit"></i>Active</a>
@endif

<form id="delete-{{ $row->id }}" action="{{ route('memberships.destroy', $row->id) }}" method="POST">
    @method('DELETE')
    @csrf
</form>
