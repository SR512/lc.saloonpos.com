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

    var url = $('meta[name="base_url"]').attr('content');

    var table = $('#datatable-service').DataTable({
        processing: true,
        serverSide: true,
        ajax: url+'/service',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'service_name', name: 'service_name'},
            {data: 'price', name: 'price'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

});
