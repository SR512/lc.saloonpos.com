// $(document).ready(function () {
//     $('#datatable').DataTable(); //Buttons examples
//
//     var table = $('#datatable-buttons').DataTable({
//         lengthChange: false,
//         buttons: ['copy', 'excel', 'pdf', 'colvis']
//     });
//     table.buttons().container().appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
// });

var url = $('meta[name="base_url"]').attr('content');

if ($("#datatable-employee").length) {

    $(function () {

        var table = $('#datatable-employee').DataTable({
            processing: true,
            serverSide: true,
            ajax: url+'/employee',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'first_name'},
                {data: 'email', name: 'email'},
                {data: 'mobile_number', name: 'mobile_number'},
                {data: 'date_of_birth', name: 'date_of_birth'},
                {data: 'date_of_anniversary', name: 'date_of_anniversary'},
                {data: 'address', name: 'address'},
                {data: 'city', name: 'city'},
                {data: 'pin_code', name: 'pin_code'},
                {data: 'job_type', name: 'job_type'},
                {data: 'commission_percentage', name: 'commission_percentage'},
                {data: 'salary', name: 'salary'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });

}

$(".job_type").on('change', function () {
    var jobtype = $(this).val();
    if (jobtype == 'BOTH') {
        $("#commission_percentage").show();
        $("#salary").show();
        $(".commission_percentage").val('');
        $(".salary").val('');
    } else if (jobtype == 'COMMISSION') {
        $("#commission_percentage").show();
        $("#salary").hide();
        $(".commission_percentage").val('');
        $(".salary").val('');
    } else if (jobtype == 'SALARIED'){
        $("#commission_percentage").hide();
        $("#salary").show();
        $(".commission_percentage").val('');
        $(".salary").val('');
    }else {
        $("#commission_percentage").hide();
        $("#salary").hide();
        $(".commission_percentage").val('');
        $(".salary").val('');
    }
})
