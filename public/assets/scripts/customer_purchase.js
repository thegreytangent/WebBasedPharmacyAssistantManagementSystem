$(document).ready(function () {
    let medicines = [];
    let medicine_table = null;
    let purchases = {};



    $('.form-select').change(function () {
        let id =$(this).find('option:selected').val();
        let name = $(this).find('option:selected').text();
        let price = $(this).find('option:selected').attr("price");

        let data = {
            medicine_id: id,
            medicine_name: name,
            price: price,
            qty: 0
        };

        medicines.push(data)
        medicine_table = data;
    });


    $('#purchase_form').submit(function (e){
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

        purchases['medicines'] = medicines;

        if (confirm("The record will be save. Are you sure to submit?")) {

            $.ajax({
                url: `/api/purchase-pharmacy` ,
                type: 'POST',
                contentType: "application/json",
                dataType: 'JSON',
                data:  JSON.stringify(purchases),
                success: function(data) {
                    location.reload();
                }
            });
        }
    });

    $('#cash').on('input', function (){
        let cash = $(this).val();
        let total = $("#amount").val();
        let change = cash - total;
        $("#change").val(change.toFixed(2));
    });




    $("#add_to_table").click(function () {
        let qty = $("#qty").val();
        if (!medicine_table || !medicine_table.medicine_name || !qty) {
            alert("Some fields are required!")
            return
        }

        medicines[medicines.length - 1].qty = qty

        table_medicines_template(medicine_table, qty);

        $("#amount").val(computeTotal(medicines,qty).toFixed(2));
    });



    function computeTotal(obj, qty) {
        let total = 0;
        medicines.map((obj) => {
            total += obj.price * qty;
        });
        return total;
    }

















    function table_medicines_template(medicine_table, qty) {
        const price = Math.round((medicine_table.price) * 1e12) / 1e12;
        $('#table-medicine').append(` <tr>
                                                <th scope="row">${medicine_table.medicine_name}</th>
                                                <td>${price.toFixed(2)}</td>
                                                <td>${qty}</td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm"><i class="bx bx-trash-alt"></i></button>
                                                </td>
                                            </tr>`);
    }



});