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

    var table = $('#datatable-expense').DataTable({
        processing: true,
        serverSide: true,
        ajax: url+'/expense',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'expenses_name', name: 'expenses_name'},
            {data: 'date', name: 'date'},
            {data: 'amount', name: 'amount'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

});
