@if($row->appointment_status == 'PENDING')
    <a href="{{route('appointment.status',[$row->id,'COMPLETED'])}}" class="edit btn btn-success btn-sm"><i
            class="mdi mdi-account-edit"></i>Completed</a>
    <a href="{{route('appointment.status',[$row->id,'CANCEL'])}}" class="edit btn btn-danger btn-sm"><i
            class="mdi mdi-account-edit"></i>Cancel</a>
@endif
<a href="{{route('appointments.edit',$row->id)}}" class="edit btn btn-primary btn-sm"><i
        class="mdi mdi-account-edit"></i>Edit</a>
<a href="#" class="edit btn btn-danger btn-sm"
   onclick="if(confirm('Are you sure you want to delete.')) document.getElementById('delete-{{ $row->id }}').submit()">
    <i class="fa fa-trash"></i>
    Delete
</a>
<form id="delete-{{ $row->id }}" action="{{ route('appointments.destroy', $row->id) }}" method="POST">
    @method('DELETE')
    @csrf
</form>
