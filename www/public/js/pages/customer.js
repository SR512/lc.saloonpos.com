// $(document).ready(function () {
//     $('#datatable').DataTable(); //Buttons examples
//
//     var table = $('#datatable-buttons').DataTable({
//         lengthChange: false,
//         buttons: ['copy', 'excel', 'pdf', 'colvis']
//     });
//     table.buttons().container().appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
// });
$(function () {

    var table = $('#datatable-customer').DataTable({
        processing: true,
        serverSide: true,
        ajax: window.origin+'/customer',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'first_name'},
            {data: 'email', name: 'email'},
            {data: 'mobile_number', name: 'mobile_number'},
            {data: 'date_of_birth', name: 'date_of_birth'},
            {data: 'date_of_anniversary', name: 'date_of_anniversary'},
            {data: 'address', name: 'address'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

});
