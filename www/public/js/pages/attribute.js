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

    var table = $('#datatable-attributes').DataTable({
        processing: true,
        serverSide: true,
        ajax: url+'/attribute',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'size', name: 'size'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

});
