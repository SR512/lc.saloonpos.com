// $(document).ready(function () {
//     $('#datatable').DataTable(); //Buttons examples
//
//     var table = $('#datatable-buttons').DataTable({
//         lengthChange: false,
//         buttons: ['copy', 'excel', 'pdf', 'colvis']
//     });
//     table.buttons().container().appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
// });
var option;
if($('#datatable-membership').length){
    var url = $('meta[name="base_url"]').attr('content');
    $(function () {

        var table = $('#datatable-membership').DataTable({
            processing: true,
            serverSide: true,
            ajax: url+'/membership',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'membership_no', name: 'membership_no'},
                {data: 'customer_id', name: 'customer_id'},
                {data: 'package_id', name: 'package_id'},
                {data: 'end_date', name: 'end_date'},
                {data: 'status', name: 'status'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

    });
}

