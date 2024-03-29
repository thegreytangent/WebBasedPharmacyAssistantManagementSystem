$(document).ready(function () {
    let medicines = [];
    let medicine_table = null;
    let purchases = {};
    let inventories = [];
    let inventory = {};


    $.ajax({
        url: `/pharmacy_assistant/api/purchase-pharmacy/inventories`,
        type: 'GET',
        contentType: "application/json",
        dataType: 'JSON',
        success: function (res) {
            $('.single-select').select2({
                theme: 'bootstrap4',
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                allowClear: Boolean($(this).data('allow-clear')),
            });

            inventories = res.data;


            dropDownSelect()


        }
    });


    function dropDownSelect() {

        $('.single-select').change(function () {
            var id = $('.single-select').val();
            var name = $('.single-select option:selected').text();
            let price = $('.single-select option:selected').attr("price");

            inventory = inventories.find(i => i.id == id);
            const balance = !inventory ? 0 : inventory.balance;

            $("#balance").val(balance);

            let data = {
                medicine_id: id,
                medicine_name: name,
                price: price,
                qty: 0
            };

            medicines.push(data)
            medicine_table = data;
        });


    }


    $('#purchase_form').submit(function (e) {
        e.preventDefault();
        let has_error = false;

        $(this).serializeArray().map((obj, i) => {
            if (obj.value === '' && !has_error) {
                alert(obj.name + " cannot be empty!");
                has_error = true;
                return;
            }
            if (obj.value) {
                purchases[obj.name] = obj.value;
            }
        });
        if (has_error) return;

        if (medicines.length === 0) {
            alert("Please select medicine");
            return;
        }

        purchases['medicines'] = medicines.filter(item => item.medicine_id !== "");

        if (confirm("The record will be save. Are you sure to submit?")) {

            $.ajax({
                url: `/pharmacy_assistant/api/purchase-pharmacy`,
                type: 'POST',
                contentType: "application/json",
                dataType: 'JSON',
                data: JSON.stringify(purchases),
                success: function (data) {
                    location.reload();
                }
            });
        }
    });

    $('#cash').on('input', function () {
        let cash = $(this).val();
        let total = $("#amount").val();
        let change = cash - total;
        $("#change").val(change.toFixed(2));
    });


    $("#add_to_table").click(function () {

        let qty = parseFloat($("#qty").val());
        let balance = parseFloat($("#balance").val());

        if (balance < qty) {
            alert("You have no medicine left!");
            return;
        }


        if (!medicine_table || !medicine_table.medicine_name || !qty) {
            alert("Some fields are required!")
            return
        }

        medicines[medicines.length - 1].qty = qty



        let i = inventories.findIndex(i => i.id == inventory.id);

        inventories[i].balance -= qty;


        table_medicines_template(medicine_table, qty);

        $("#amount").val(computeTotal(medicines, qty).toFixed(2));

        clear_forms();

    });

    function clear_forms() {
        $("#qty").val(null);
        $("#balance").val(null);
        $('.single-select').val(null).trigger('change');
    }


    function computeTotal(obj, qty) {

        let total = 0;
        for (let x = 0; x < medicines.length; x++) {


            if (medicines[x].price) {

                let price = Number(medicines[x].price);
                let _qty = Number(medicines[x].qty);
                total += price * _qty;
            }

        }

        return total;
    }


    function table_medicines_template(medicine_table, qty) {

        const price = Math.round((medicine_table.price) * 1e12) / 1e12;
        $('#table-medicine').append(` <tr id="row-${medicine_table.medicine_id}">
            <th scope="row">${medicine_table.medicine_name}</th>
                <td>${price.toFixed(2)}</td>
                    <td>${qty}</td>
                        <td>
                        <button id="${medicine_table.medicine_id}" class="btn btn-danger btn-sm delete"><i class="bx bx-trash-alt"></i></button>
                              </td>
                                            </tr>`);
    }


    $(document).on('click', '.delete', function ($event) {
        const id = $(this).attr('id');
        if (confirm("Do you want to delete this medicine?")) {
            $('#row-' + id).remove();
            let i = medicines.findIndex(a => a.medicine_id == id);
            medicines.splice(i, 1);
        }

    });


});
