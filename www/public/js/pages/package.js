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
if ($('#datatable-package').length) {
    var url = $('meta[name="base_url"]').attr('content');
    $(function () {

        var table = $('#datatable-package').DataTable({
            processing: true,
            serverSide: true,
            ajax: url + '/package',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'packagename', name: 'packagename'},
                {data: 'duration', name: 'duration'},
                {data: 'totalprice', name: 'totalprice'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: true, searchable: true},
            ]
        });

    });
}


$('#add-item').on('click', function () {
    if ($(".medicine-delete").length < 1) {
        $(".medicine-delete").hide();
    } else {
        $(".medicine-delete").show();
    }
    var count = $('.medicine-table .item-row:last .product-size').attr('name').split('[')[2];
    count = parseInt(count.split(']')[0]) + 1;
    $(".item-row:last").after('<tr class="item-row">\n' +
        '                                    <td>\n' +
        '                                        <select class="form-control product-size" name="product[detail][' + count + '][size]" required>\n' +
        '                                            <option value="">Select size</option>\n' + option + '</select>\n' +
        '                                    </td>\n' +
        '                                    <td><input type="number" value="" class="form-control" name="product[detail][' + count + '][qty]" placeholder="Qty" required></td>\n' +
        '                                    <td><button class="btn btn-danger medicine-delete"><i class="fa fa-trash"></i></button></td>\n' +
        '                                </tr>');
});


if ($(".medicine-delete").length < 2) {
    $(".medicine-delete").hide();
} else {
    $(".medicine-delete").show();
}

$('body').on('click', '.medicine-delete', function () {
    $(this).parents('tr').remove();
    if ($(".medicine-delete").length < 2) $(".medicine-delete").hide();
});
