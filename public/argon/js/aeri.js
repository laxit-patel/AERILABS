console.log("custom aeri.js initiated");

$("#items_table_tax").hide();
$("#items_table_total_qty").hide();
$("#items_table_total_amount").hide();


//only digits & floating point validator
$(".allownumericwithdecimal").on("keypress keyup blur",function (event) {
    //this.value = this.value.replace(/[^0-9\.]/g,'');
    $(this).val($(this).val().replace(/[^0-9\.]/g,''));
    if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
        event.preventDefault();
    }
});

//only digits validator
$(".allownumericwithoutdecimal").on("keypress keyup blur",function (event) {
    $(this).val($(this).val().replace(/[^\d].+/, ""));
    if ((event.which < 48 || event.which > 57)) {
        event.preventDefault();
    }
});


//logic for custom ajax select menu for inward test
$("#inward_test_datalist").on('change', function () {
    var val = this.value;
    var client = $('#inward_client').val();

    if(client == null)
    {
        alert("Please Select A Client First");
    }
    else
    {
        if($('#inward_test_datalist option').filter(function(){
            return this.value.toUpperCase() === val.toUpperCase();
        }).length) {
            //sending ajax request to retrieve related materials
            $.ajax({
                type:'GET',
                url:'/getTest/'+val,
                data: {val: val, client: client},
                success:function(data) {
                    $("#inward_material_dropdown").html("<option value='"+ data[0].material_id+"'>"+ data[0].material_name +"</option>");
                    $("#test_price").val(data[0].test_rate);
                }
            });
        }
    }
});

// select client id on select event on inward_client input
$("#inward_client").on('change',function () {
   $('#selected_client').val(this.value);
    $('#inward_test_datalist').prop('selectedIndex',0);
    $("#inward_material_dropdown").empty();
    $("#test_price").val(null);
});


//login for test prgress phases
$('.progress-btn').append("<i class='fas fa-exclamation-circle text-white'></i>");

var progress_bar = 0;
$('.progress-meter').text(progress_bar + '%');
$('.submit-test').addClass('disabled');
$('#report_input_fields').hide();

if(typeof document.getElementById("phase_one") !== 'undefined' && document.getElementById("phase_one") !== null) {
    var phase_one = document.getElementById("phase_one").getAttribute('data-status');
  }
  if(typeof document.getElementById("phase_two") !== 'undefined' && document.getElementById("phase_two") !== null) {
    var phase_two = document.getElementById("phase_two").getAttribute('data-status');
  }
  if(typeof document.getElementById("phase_three") !== 'undefined' && document.getElementById("phase_three") !== null) {
    var phase_three = document.getElementById("phase_three").getAttribute('data-status');
  }
  if(typeof document.getElementById("phase_four") !== 'undefined' && document.getElementById("phase_four") !== null) {
    var phase_four = document.getElementById("phase_four").getAttribute('data-status');
  }





if(phase_one == 0 && phase_two == 0 && phase_three == 0 && phase_four == 0)
{
    $('#phase_one').append("<i class='fas fa-exclamation-circle text-white'></i>");
    $('#phase_two').append("<i class='fas fa-exclamation-circle text-white'></i>");
    $('#phase_two').addClass('disabled');
    $('#phase_three').append("<i class='fas fa-exclamation-circle text-white'></i>");
    $('#phase_three').addClass('disabled');
    $('#phase_four').append("<i class='fas fa-exclamation-circle text-white'></i>");
    $('#phase_four').addClass('disabled');
    $('.progress-meter').text('0%');
    $('#progress-bar').css('width','0%');
}
else if(phase_one == 1 && phase_two == 0 && phase_three == 0 && phase_four == 0)
{
    $('#phase_one').append("<i class='fas fa-check text-white'></i>");
    $('#phase_one').removeClass('bg-danger');
    $('#phase_one').addClass('bg-success disabled');
    $('#phase_two').append("<i class='fas fa-exclamation-circle text-white'></i>");
    $('#phase_three').append("<i class='fas fa-exclamation-circle text-white'></i>");
    $('#phase_three').addClass('disabled');
    $('#phase_four').append("<i class='fas fa-exclamation-circle text-white'></i>");
    $('#phase_four').addClass('disabled');
    $('.progress-meter').text('25%');
    $('#progress-bar').css('width','25%');
}
else if(phase_one == 1 && phase_two == 1 && phase_three == 0 && phase_four == 0)
{
    $('#phase_one').append("<i class='fas fa-check text-white'></i>");
    $('#phase_one').removeClass('bg-danger');
    $('#phase_one').addClass('bg-success disabled');
    $('#phase_two').append("<i class='fas fa-check text-white'></i>");
    $('#phase_two').removeClass('bg-danger');
    $('#phase_two').addClass('bg-success disabled');
    $('#phase_three').append("<i class='fas fa-exclamation-circle text-white'></i>");
    $('#phase_three').removeClass('disabled');
    $('#phase_four').append("<i class='fas fa-exclamation-circle text-white'></i>");
    $('#phase_four').addClass('disabled');  
    $('.progress-meter').text('50%');
    $('#progress-bar').css('width','50%');
}
else if(phase_one == 1 && phase_two == 1 && phase_three == 1 && phase_four == 0)
{
    $('#phase_one').append("<i class='fas fa-check text-white'></i>");
    $('#phase_one').removeClass('bg-danger');
    $('#phase_one').addClass('bg-success disabled');
    $('#phase_two').append("<i class='fas fa-check text-white'></i>");
    $('#phase_two').removeClass('bg-danger');
    $('#phase_two').addClass('bg-success disabled');
    $('#phase_three').append("<i class='fas fa-check text-white'></i>");
    $('#phase_three').removeClass('bg-danger');
    $('#phase_three').addClass('bg-success disabled');
    $('#phase_four').append("<i class='fas fa-exclamation-circle text-white'></i>");
    $('#phase_four').removeClass('disabled'); 
    $('.progress-meter').text('75%');
    $('#progress-bar').css('width','75%');
}
else if(phase_one == 1 && phase_two == 1 && phase_three == 1 && phase_four == 1)
{
    $('#phase_one').append("<i class='fas fa-check text-white'></i>");
    $('#phase_one').removeClass('bg-danger');
    $('#phase_one').addClass('bg-success disabled');
    $('#phase_two').append("<i class='fas fa-check text-white'></i>");
    $('#phase_two').removeClass('bg-danger');
    $('#phase_two').addClass('bg-success disabled');
    $('#phase_three').append("<i class='fas fa-check text-white'></i>");
    $('#phase_three').removeClass('bg-danger');
    $('#phase_three').addClass('bg-success disabled');
    $('#phase_four').append("<i class='fas fa-check text-white'></i>");
    $('#phase_four').removeClass('bg-danger');
    $('#phase_four').addClass('bg-success disabled'); 
    $('.progress-meter').text('100%');
    $('#progress-bar').css('width','100%');
    $('#report_input_fields').fadeIn();
    $('.submit-test').removeClass('disabled');

}

function progress(button)
{
    
    var record_id = document.getElementById('record_id').value;
    var phase = button.getAttribute('data-phase');
    var status = button.getAttribute('data-status');
    $.ajax({
        type:'GET',
        url:'/updateRecordPhase',
        data:{
            'record_id':record_id,
            'phase':phase,
            'status':status
        },
        success:function(data) {
            if(data == 1)
            {
                location.reload();
            }
        }
    });
}

//logic to load test details in table  on addinwardtest

$('#select_inward_filltable').on('change', function () {
    var inward = this.value;
    $.ajax({
        type:'GET',
        url:'/getTestForInward/'+inward,
        data:inward,
        success:function(data) {
            $("#test_table_body").empty();
            data.forEach(element => $("#test_table_body").append("<tr><td colspan=5>" + element.test_name + "</td></tr>"));

        }
     });
});

//invoice select inward based on client selection logic

$('#invoice_client').on('change', function(){
    var client = this.value;
    $.ajax({
        type:'GET',
        url:'/getInwardsForClient/'+client,
        data:client,
        success:function (data) {
            var i=0;
            $("#invoice_inward").empty();
            $("#invoice_inward").append("<option disabled selected> Select Inward </option>");
            for(i=0; i<data.length;i++) {

                $("#invoice_inward").append("<option value='" + data[i].inward_id + "'>" + data[i].inward_id + "</option>");
            }


        }
    });
});

$('#invoice_inward').on('change',function () {

    var inward = this.value;

    $.ajax({
        type:'GET',
        url:'/getRecordsForInward/'+inward,
        data:inward,
        success:function(data) {
            let grand_total = 0
            let total_qty = 0;
            let total_amount = 0;
            let counter = 0;
            $("#items_table_body").empty();
            data.forEach(element => {

                $("#items_table_body").append("<tr class='bg-dark text-white '>" +
                    "<td >" + element.test_name + "</td>" +
                    "<td >" + element.material_name + "</td>" +
                    "<td >" + element.record_price + "</td>" +
                    "<td >" + element.record_qty + "</td>" +
                    "<td > <span class=\"btn btn-sm bg-white text-dark\">" + (element.record_price * element.record_qty) + "</span></td>" +
                    "</tr>" );

                grand_total = grand_total + (element.record_price * element.record_qty);
                total_qty = +total_qty + +element.record_qty;
                total_amount = +total_amount + +element.record_price;
                $("#items_table_total_amount").val(grand_total).fadeIn("slow");
                $("#items_table_total_qty").val(total_qty).fadeIn("slow");
                $("#items_table_tax").fadeIn("slow");

                counter++;
                }

            );
            $('#invoice_item_counter').val(counter);
        }
    });

});

$("#invoice_gst").on('change',function () {
    var tax_rate = this.value;
    var price = $("#items_table_total_amount").val();
    var raw_tax =  price / 100 * tax_rate;
    tax = Math.trunc(raw_tax);
    rounded = Number((raw_tax-tax).toFixed(2));
    var total = +tax + +price;

    $("#invoice_tax").val(tax);
    $("#invoice_roundoff").val(rounded);
    $("#invoice_total").val(total);
 
})


//ratelist select client to show rates
$("#select_rate_client").on('change',function(){
    var client_name = $("#select_rate_client option:selected").text();
    $.ajax({
        type:'GET',
        url:'/getRatesForClient',
        data: {
            client_id: this.value
        },
        success:function (data) {
            $('#table_title').html(client_name + "'s Price List ");
            $('#placeholder_row').hide();
            $("#tbody_rates_table").empty();
            data.forEach(element => {

                $('#tbody_rates_table').append(
                    "<tr>" +
                    "<td>" + element.test_name + "</td>" +
                    "<td>" + element.test_rate + "</td>" +
                    "<td>" + element.rate_price + "</td>" +
                    "<td>" + "<a href='' class='avatar avatar-sm rounded-circle bg-success' id='modal_trigger' data-toggle='modal' data-client=' "+ element.client_id +" ' data-test=' "+ element.test_id +" ' data-clientname=' "+ element.client_name +" ' data-testname=' "+ element.test_name +" ' > <i class='fa fa-edit'></i> </a>" + "</td>" +
                    "</tr>"
                );

            });
        }
    });
});

// ratelist select price along with test name when the client get selected
$('#rates_test').on('change',function () {

    $.ajax({
        type:'GET',
        url:'/getBaseRates',
        data: {
            test_id: this.value
        },
        success:function (data) {
            $('input[name$="rates_base_rates"]').val(data);
        }
    });

});

