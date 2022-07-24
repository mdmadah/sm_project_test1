$(document).ready(function () {

    $(document).on('click', '.add', function () {

        // for (let item of result) {
        //     option = option+'<option value = "'+item['us->id'];
        //     option = option+'">'+item['$us->firstname'];
        //     option = option+item['$us->lastname']+'</option>';
        // }

        var html ='';

        html += '<tr>';
        html += '<td>';
        html +='<div class="row">';
        html +='<div class="col-md-6"><div class="mb-3">';
        html +='<label for="task-title" class="form-label">ชื่องาน</label>';
        html +='<input type="text" name="name" class="form-control form-control-light" id="task-title">';
        html +='</div></div>';
        html +='<div class="col-md-6"><div class="mb-3">';
        html +='<label for="task-title" class="form-label">ระยะเวลาที่ใช้ปกติ (วัน)</label>';
        html +='<input type="text" name="NT" class="form-control form-control-light" id="task-title">';
        html +='</div></div></div>';
        html +='</td></tr>';
                                
                                    
                                        
                                        
                                    
                                

                                
                                    
                                        
                                        
                                    
                                
                            
        

        // var html = '';
        // html += '<tr>';
        // html += '<td>';

        // html += '<div class="row">';
        // html += '<div class="col-md-6">';
        // html += '<div class="mb-3">';
        // html += '<label class="form-label">ชื่อโครงการ</label>';
        // html += '<select class="form-select form-control-light" id="input_sw" name="sw_id">';
        // html += '<option value="">เลือกโครงการ</option>';
        // html += '@foreach ($softwares as $sw)';
        // html += '<option value="{{ $sw->id }}">{{ $sw->name }}</option>';
        // html += '@endforeach</select></div></div>';
        // html += '<div class="col-md-6">';
        // html += '<label class="form-label">ชื่อบริษัทเจ้าของโครงการ</label>';
        // html += '<input type="text" class="form-control form-control-light" disabled';
        // html += 'id="input_company"></div></div>';
        // html += '<div class="row">';
        // html += '<div class="col-md-6">';
        // html += '<div class="mb-3">';
        // html += '<label class="form-label">User Story Type</label>';
        // html += '<select class="form-select form-control-light" id="input_ust">';
        // html += '<option>เลือกประเภทกิจกรรม</option></select></div></div>';
        // html += '<div class="col-md-6">';
        // html += '<label class="form-label">User Story</label>';
        // html += '<select class="form-select form-control-light" name="us_id" id="input_us">';
        // html += '<option>เลือก User Story</option></select></div></div>';
        // html += '<div class="row">';
        // html += '<div class="col-md-6">';
        // html += '<div class="mb-3">';
        // html += '<label for="task-title"';
        // html += 'class="form-label">งบประมาณในการเร่งงานต่อวัน</label>';
        // html += '<input type="text" name="rush_cost_per_day"';
        // html += 'class="form-control form-control-light" id="task-title"></div></div>';
        // html += '<div class="col-md-6">';
        // html += '<div class="mb-3">';
        // html += '<label for="task-title" class="form-label">ระยะเวลาที่ใช้ปกติ(วัน)</label>';
        // html += '<input type="text" name="NT" class="form-control form-control-light"';
        // html += 'id="task-title"></div></div></div>';
        // html += '<div class="row">';
        // html += '<div class="col-md-6">';
        // html += '<div class="mb-3">';
        // html += '<label for="task-title" class="form-label">จำนวนวันที่เร่งได้</label>';
        // html += '<input type="text" name="rush_day" class="form-control form-control-light"';
        // html += 'id="task-title"></div></div></div>';

        // html += '<div class="row">';
        // html += '<div class="col-md-6">';
        // html += '<div class="mb-3">';
        // html += '<label for="task-title" class="form-label">ชื่องาน</label>';
        // html += '<input type="text" name="name" class="form-control form-control-light"';
        // html += 'id="task-title"></div></div>';

        // html += '<div class="col-md-6">';
        // html += '<div class="mb-3">';
        // html += '<label class="form-label">ผู้รับชอบงาน</label>';
        // html += '<select class="form-select form-control-light" name="ts_id">';
        // html += '@foreach ($teams as $us)';
        // html += '<option value="{{ $us->id }}">{{ $us->firstname }}';
        // html += '{{ $us->lastname }}</option>';
        // html += '@endforeach';
        // html += '</select></div></div></div></td></tr>';



















        // html += '<td><input type="text" name="item_name[]" class="form-control item_name" /></td>';
        // html += '<td><input type="text" name="item_quantity[]" class="form-control item_quantity" /></td>';
        // html += '<td><select name="item_unit[]" class="form-control item_unit"><option value="">Select Unit</option><?php echo fill_unit_select_box($connect); ?></select></td>';
        // html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
        $('#item_table').append(html);
    });

    $(document).on('click', '.remove', function () {
        $(this).closest('tr').remove();
    });

    $('#insert_form').on('submit', function (event) {
        event.preventDefault();
        var error = '';
        $('.item_name').each(function () {
            var count = 1;
            if ($(this).val() == '') {
                error += "<p>Enter Item Name at " + count + " Row</p>";
                return false;
            }
            count = count + 1;
        });

        $('.item_quantity').each(function () {
            var count = 1;
            if ($(this).val() == '') {
                error += "<p>Enter Item Quantity at " + count + " Row</p>";
                return false;
            }
            count = count + 1;
        });

        $('.item_unit').each(function () {
            var count = 1;
            if ($(this).val() == '') {
                error += "<p>Select Unit at " + count + " Row</p>";
                return false;
            }
            count = count + 1;
        });
        var form_data = $(this).serialize();
        if (error == '') {
            $.ajax({
                url: "insert.php",
                method: "POST",
                data: form_data,
                success: function (data) {
                    if (data == 'ok') {
                        $('#item_table').find("tr:gt(0)").remove();
                        $('#error').html('<div class="alert alert-success">Item Details Saved</div>');
                    }
                }
            });
        }
        else {
            $('#error').html('<div class="alert alert-danger">' + error + '</div>');
        }
    });

});

function showUS() {
    let input_ust = document.querySelector("#input_ust");
    console.log("hey3");
    let url = "{{ url('/api/US') }}?input_ust=" + input_ust.value;
    console.log(url);
    fetch(url)
        .then(response => response.json())
        .then(result => {

            console.log(result);
            console.log(result[0]);
            // console.log(result[0][1]);
            let input_us = document.querySelector("#input_us");
            // input_ust.innerHTML = '<option value="">กรุณาเลือกเขต/อำเภอ</option>';
            for (let item of result) {
                let option = document.createElement("option");
                option.text = item['us_name'];
                option.value = item['us_id'];

                input_us.appendChild(option);
            }



        });

}

function showCompa() {

    let input_sw = document.querySelector("#input_sw");
    console.log("hey2");
    let url = "{{ url('/api/company') }}?input_sw=" + input_sw.value;
    console.log(url);
    fetch(url)
        .then(response => response.json())
        .then(result => {
            console.log(result);
            let input_company = document.getElementById("input_company");
            // input_zipcode.value = "";
            for (let item of result) {
                input_company.value = item.organ_name_th;
                break;
            }
        });
}

function showUST() {
    let input_sw = document.querySelector("#input_sw");
    console.log(input_sw.value);
    let url = "{{ url('/api/sw/USType') }}?input_sw=" + input_sw.value;
    console.log(url);
    fetch(url)
        .then(response => response.json())
        .then(result => {

            console.log(result);
            console.log(result[0]['ust_name']);
            // console.log(result[0][1]);

            console.log(result.length.length);
            let input_ust = document.querySelector("#input_ust");
            // input_ust.innerHTML = '<option value="">กรุณาเลือกเขต/อำเภอ</option>';
            for (let item of result) {
                let option = document.createElement("option");
                option.text = item['ust_name'];
                option.value = item['ust_id'];

                input_ust.appendChild(option);
            }

            showCompa();

        });


}
document.querySelector('#input_sw').addEventListener('change', (event) => {
    showUST();
    console.log("hey2");
});

document.querySelector('#input_ust').addEventListener('change', (event) => {
    showUS();
});








//     $(document).ready(function(){

//         $('#softwares').DataTable({
//             processing: true,
//             serverSide: true,
//             ajax: {
//                 url: "{{ route('test') }}",
//             },
//             columns: [
//                 {
//                     data: 'sw_name',
//                     name: 'sw_name'
//                 },
//                 {
//                     data: 'ow_firstname',
//                     name: 'ow_firstname'
//                 },
//                 {
//                     data: 'action',
//                     name: 'action',
//                     orderable: false
//                 }
//             ]
//         });

//     $('#create_record').click(function(){
//         $('.modal-title').text('Add New Record');
//     $('#action_button').val('Add');
//     $('#action').val('Add');
//     $('#form_result').html('');

//     $('#formModal').modal('show');
//  });

//     $('#sample_form').on('submit', function(event){
//         event.preventDefault();
//     var action_url = '';

//     if($('#action').val() == 'Add')
//     {
//         action_url = "{{ route('sample.store') }}";
//   }

//     if($('#action').val() == 'Edit')
//     {
//         action_url = "{{ route('sample.update') }}";
//   }

//     $.ajax({
//         url: action_url,
//     method:"POST",
//     data:$(this).serialize(),
//     dataType:"json",
//     success:function(data)
//     {
//     var html = '';
//     if(data.errors)
//     {
//         html = '<div class="alert alert-danger">';
//     for(var count = 0; count < data.errors.length; count++)
//     {
//         html += '<p>' + data.errors[count] + '</p>';
//      }
//     html += '</div>';
//     }
// if (data.success) {
//     html = '<div class="alert alert-success">' + data.success + '</div>';
//     $('#sample_form')[0].reset();
//     $('#user_table').DataTable().ajax.reload();
// }
// $('#form_result').html(html);
//    }
//   });
//  });

// $(document).on('click', '.edit', function () {
//     var id = $(this).attr('id');
//     $('#form_result').html('');
//     $.ajax({
//         url: "/sample/" + id + "/edit",
//         dataType: "json",
//         success: function (data) {
//             $('#first_name').val(data.result.first_name);
//             $('#last_name').val(data.result.last_name);
//             $('#hidden_id').val(id);
//             $('.modal-title').text('Edit Record');
//             $('#action_button').val('Edit');
//             $('#action').val('Edit');
//             $('#formModal').modal('show');
//         }
//     })
// });

// var user_id;

// $(document).on('click', '.delete', function () {
//     user_id = $(this).attr('id');
//     $('#confirmModal').modal('show');
// });

// $('#ok_button').click(function () {
//     $.ajax({
//         url: "sample/destroy/" + user_id,
//         beforeSend: function () {
//             $('#ok_button').text('Deleting...');
//         },
//         success: function (data) {
//             setTimeout(function () {
//                 $('#confirmModal').modal('hide');
//                 $('#user_table').DataTable().ajax.reload();
//                 alert('Data Deleted');
//             }, 2000);
//         }
//     })
// });

// });
