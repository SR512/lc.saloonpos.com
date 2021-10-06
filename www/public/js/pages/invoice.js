// $(document).ready(function () {
//     $('#datatable').DataTable(); //Buttons examples
//
//     var table = $('#datatable-buttons').DataTable({
//         lengthChange: false,
//         buttons: ['copy', 'excel', 'pdf', 'colvis']
//     });
//     table.buttons().container().appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
// });

var productOption;
if ($("#datatable-invoice").length) {
    $(function () {
        var url = $('meta[name="base_url"]').attr('content');
        var table = $('#datatable-invoice').DataTable({
            processing: true,
            serverSide: true,
            ajax: url+'/invoice',
            columns: [
                {data: 'invoicedate', name: 'invoicedate'},
                {data: 'name', name: 'name'},
                {data: 'amount', name: 'amount'},
                {data: 'paid', name: 'paid'},
                {data: 'due', name: 'due'},
                {data: 'status', name: 'status'},
                {data: 'method', name: 'method'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: true},
            ]
        });
    });

}


var path = $('.site_url').val();

function fourdigits(number) {
    return (number < 1000) ? number + 1900 : number;
}

function roundNumber(number, decimals) {
    var newString;
    decimals = Number(decimals);
    if (decimals < 1) {
        newString = (Math.round(number)).toString();
    } else {
        var numString = number.toString();
        if (numString.lastIndexOf(".") == -1) {
            numString += ".";
        }
        var cutoff = numString.lastIndexOf(".") + decimals;
        var d1 = Number(numString.substring(cutoff, cutoff + 1));
        var d2 = Number(numString.substring(cutoff + 1, cutoff + 2));
        if (d2 >= 5) {
            if (d1 == 9 && cutoff > 0) {
                while (cutoff > 0 && (d1 == 9 || isNaN(d1))) {
                    if (d1 != ".") {
                        cutoff -= 1;
                        d1 = Number(numString.substring(cutoff, cutoff + 1));
                    } else {
                        cutoff -= 1;
                    }
                }
            }
            d1 += 1;
        }
        if (d1 == 10) {
            numString = numString.substring(0, numString.lastIndexOf("."));
            var roundedNum = Number(numString) + 1;
            newString = roundedNum.toString() + '.';
        } else {
            newString = numString.substring(0, cutoff) + d1.toString();
        }
    }
    if (newString.lastIndexOf(".") == -1) {
        newString += ".";
    }
    var decs = (newString.substring(newString.lastIndexOf(".") + 1)).length;
    for (var i = 0; i < decimals - decs; i++) newString += "0";
    return newString;
}

function update_total() {
    var total = 0;
    $('.item-price').each(function (i) {
        price = $(this).val();
        if (!isNaN(price)) {
            total += Number(price);
        }
    });

    var taxtotal = $('.tax-total').val();

    total = total;
    taxprice = taxtotal;
    var amount = +total + +((total * taxtotal) / 100)
    $('.sub-total').val(total);
    $('.tax-total').val(taxprice);
    $('.total-amount').val(amount.toFixed());
    $('.due-amount').val(amount.toFixed());

    update_balance();
}

function update_balance() {
    var subtotal = Number($(".sub-total").val()), tax = Number($(".tax-total").val()),
        discount = Number($(".discount-total").val());
    var after_discount = (subtotal) + ((subtotal * tax) / 100);

    if ($('.discount-type').val() === "FLAT") {
        after_discount = after_discount - discount;
        //after_discount = after_discount;
        console.log(after_discount)
    } else if ($('.discount-type').val() === "%") {
        if (discount <= 100) {
            discount = discount * after_discount * 0.01;
            after_discount = after_discount - discount;
            after_discount = after_discount
        } else {
            alert("You can not set more then 100% discount.");
            $(".discount-total").val(0);
        }
    } else {
        $(".discount-total").val('');
    }

    var due = (after_discount) - $(".paid-amount").val();
    due = due;
    $('.discount_amount').val(discount);
    $('.total-amount').val(after_discount.toFixed());
    $('.due-amount').val(due.toFixed());
}

function update_price() {
    $('.item-row').each(function () {
        var row = $(this), price = row.find('.item-cost').val() * row.find('.item-quantity').val();

        var unit_price = (+price);

        isNaN(price) ? row.find('.item-price').val("N/A") : row.find('.item-price').val(price);
        isNaN(unit_price) ? row.find('.item-total-price').val("N/A") : row.find('.item-total-price').val(price);

        update_total();
    });
}

function bind() {
    $(".item-cost").on('blur', update_price);
    $(".item-quantity").on('blur', update_price);
    $("body").on('change', '.tax-total', update_price);
    $("body").on('change', '.discount-type', update_balance);
}


function item_html(count) {

    var item_html = '<tr class="item-row">' +
        '<td class="">' +
        '<select name="item[' + count + '][name]" class="item-name form-control" data-row="' + count + '" onchange="getProduct(event)" required>' +
        '<option value="">Select Product</option>' + productOption +
        '</select>' +
        ' <input type="hidden" name="item[' + count + '][product_id]" class="item-product-id form-control" required>'+
        '</td>' +
        '<td class="">' +
        '<select name="item[' + count + '][size]" class="item-size form-control" data-row="' + count + '" onchange="getSizePrice(event)" required>' +
        '<option value="">Select size</option>' +
        '</select>' +
        '<input type="hidden" name="item[' + count + '][size_id]" class="item-size-id form-control" required>'+
        '</td>' +
        '<td class="invoice-item">' +
        '<textarea name="item[' + count + '][descr]" class="item-descr form-control"></textarea>' +
        '</td>' +
        '<td class="">' +
        '<input type="number" name="item[' + count + '][quantity]" value="1" class="item-quantity form-control" required>' +
        '</td>' +
        '<td class="">' +
        '<input type="number" name="item[' + count + '][cost]" class="item-cost form-control" required onkeypress="return numericValidation(event)">' +
        '</td>' +
        '<td class="">' +
        '<input type="number" name="item[' + count + '][price]" class="item-total-price form-control">' +
        '<input type="hidden" class="item-price">' +
        '</td>' +
        '<td>' +
        '<button type="button" class="btn btn-sm btn-danger delete m-1">X</button>' +
        '</td>' +
        '</tr>';

    if (count === 0) {
        $(".invoice-items tbody").prepend(item_html);
    } else {
        $(".item-row:last").after(item_html);
    }
}


function numericValidation(e) {
    var keyCode = e.keyCode || e.which;

    //Regex for Valid Characters i.e. Alphabets and Numbers.
    var regex = /^[0-9]+$/;

    //Validate TextBox value against the Regex.
    var isValid = regex.test(String.fromCharCode(keyCode));
    if (!isValid) {
        return isValid
    }

    return isValid;
}

$(document).ready(function () {
    "use strict";
    var tax_html = '', items = [];

    $(".discount-total").on('blur', update_balance);
    $(".paid-amount").on('blur', update_balance);


    $('.invoice-items').on('click', '.add-items', function () {
        if ($(".item-row").length === 0) {
            item_html(0);
        } else {
            var count = $('.invoice-items table tr.item-row:last .item-name').attr('name').split('[')[1];
            count = parseInt(count.split(']')[0]) + 1;
            item_html(count);
        }
        bind();
    });

    $('.invoice-items').on('click', '.delete', function () {
        var ele = $(this), ele_par = ele.parents('.item-row');
        if ($('.item-row').length > 1) {
            ele.parents('.item-row').remove();
        } else {
            toastr.error('One row is compulsory for invoice.', 'Warning');
        }
        bind();
        update_price()
        return false;
    });

    bind();

    if ($(".customer-name").length) {

        $(".customer-name").autocomplete({
            source: window.origin + '/find/customer',
            minLength: 0,
            focus: function () {
                return false;
            },
            select: function (event, ui) {
                $('.customer-name').val(ui.item.first_name + " " + ui.item.last_name);
                $('.customer-mail').val(ui.item.email);
                $('.customer-mobile').val(ui.item.mobile_number);
                return false;
            }
        }).data("uiAutocomplete")._renderItem = function (ul, item) {
            return $("<li>")
                .append("<a>Name: " + item.first_name + " " + item.last_name + "<br>" + "Mobile: " + item.mobile_number + "<br>" + "Email: " + item.email + "</a>")
                .appendTo(ul);
        };
    }

});


function getProduct(e) {
    var size = $(e.currentTarget).find(':selected').data('size');
    var row = $(e.currentTarget).data('row');
    var id = $(e.currentTarget).find(':selected').data('id');

    if (size != null) {
        $('select[name="item[' + row + '][size]"]').find('option').remove();
        $('select[name="item[' + row + '][size]"]').append('<option value="">Select size</option>');
        $.each(size, function (key, val) {
            $('select[name="item[' + row + '][size]"]').append('<option value="' + val.size + '" data-price="' + val.price + '" data-id="' + val.id + '">' + val.size + '</option>')
        });
        $('input[name="item[' + row + '][product_id]"]').val(id);

    } else {
        alert("Product size not found.!");
    }
}


function getSizePrice(e) {
    var price = $(e.currentTarget).find(':selected').data('price');
    var row = $(e.currentTarget).data('row');
    var id = $(e.currentTarget).find(':selected').data('id')

    if (price != null) {
        $('input[name="item[' + row + '][cost]"]').val(price);
        $('input[name="item[' + row + '][quantity]"]').val(1);
        $('input[name="item[' + row + '][size_id]"]').val(id);
        update_price()

    } else {
        alert("Product size price not found.!");
    }
}
