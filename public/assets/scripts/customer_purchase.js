$(document).ready(function () {
    let medicines = [];
    let medicine_table = null;
    let purchases = {};

    // let purchases = {
    //     date: null,
    //     receipt_number: null,
    //     customer_name: null,
    //     amount: null,
    //     cash: null,
    //     change: null,
    //     medicines: medicines,
    // };


    $('.form-select').change(function () {
        var id = $(this).val();
        var name = $(this).find('option:selected').text();
        var price = $(this).find('option:selected').attr("price");

        let data = {
            medicine_id: id,
            medicine_name: name,
            price: price
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
            console.log("sumit ", purchases);
            $.ajax({
                url: "/purchase-pharmacy",
                type: 'POST',
                contentType: "application/json",
                dataType: 'JSON',
                data:  JSON.stringify(purchases),
                success: function(data) {
                    console.log(data)
                }
            });
        }


        // $.ajax({
        //     url: actionurl,
        //     type: 'post',
        //     dataType: 'application/json',
        //     data: $("#purchase_form").serialize(),
        //     success: function(data) {
        //
        //     }
        // });


    });




    $("#add_to_table").click(function () {
        let qty = $("#qty").val();
        if (!medicine_table || !medicine_table.medicine_name || !qty) {
            alert("Some fields are required!")
            return
        }
        table_medicines_template(medicine_table, qty);
    });

















    function table_medicines_template(medicine_table, qty) {
        $('#table-medicine').append(` <tr>
                                                <th scope="row">${medicine_table.medicine_name}</th>
                                                <td>${medicine_table.price}</td>
                                                <td>${qty}</td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm"><i class="bx bx-trash-alt"></i></button>
                                                </td>
                                            </tr>`);
    }



});
