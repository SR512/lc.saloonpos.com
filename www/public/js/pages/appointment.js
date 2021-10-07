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

    var table = $('#datatable-appointment').DataTable({
        processing: true,
        serverSide: true,
        ajax: url + '/appointment',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'customer_id', name: 'customer_id'},
            {data: 'service_id', name: 'service_id'},
            {data: 'employee_id', name: 'employee_id'},
            {data: 'appointment_date_time', name: 'appointment_date_time'},
            {data: 'appointment_status', name: 'appointment_status'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

});
