$(function() {
    "use strict";
    $(function() {
        $(".preloader").fadeOut();
    });

function setTime() {
var d = new Date(),
  el = document.getElementById("time");

  el.innerHTML = formatAMPM(d);

setTimeout(setTime, 1000);
}

function formatAMPM(date) {
  var hours = date.getHours(),
    minutes = date.getMinutes(),
    seconds = date.getSeconds(),
    ampm = hours >= 12 ? 'pm' : 'am';
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'
  minutes = minutes < 10 ? '0'+minutes : minutes;
  var strTime = hours + ':' + minutes + ':' + seconds + ' ' + ampm;
  return strTime;
}

setTime();


      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
         var where = 'fastmoving';
       $.post("../charts.php",{where:where},
        function(result){
          var data = $.parseJSON(result);
          var data0 = data[0][0];
          var data1 = data[0][1];
          var data2 = data[1][0];
          var data3 = data[1][1];
          var data4 = data[2][0];
          var data5 = data[2][1];
          var data6 = data[3][0];
          var data7 = data[3][1];
          var data8 = data[4][0];
          var data9 = data[4][1];
          var data10 = data[5][0];
          var data11 = data[5][1];
          var data12 = data[6][0];
          var data13 = data[6][1];
        var data = google.visualization.arrayToDataTable([
          [data0, data1],
         [data2, parseInt(data3)],
          [data4, parseInt(data5)],
          [data6, parseInt(data7)],
          [data8, parseInt(data9)],
          [data10, parseInt(data11)],
          [data12, parseInt(data13)],
        ]);
        var options = {
          title: 'Fast moving products',
          legend: 'none',
           is3D:true,
          pieSliceText: 'label',
          slices: {  1: {offset: 0.2},
                    4: {offset: 0.1},
                    0: {offset: 0.2},
                    2: {offset: 0.1},
          },
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
        });
      }

      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart2);
      function drawChart2() {
         var where = 'fastselling';
       $.post("../charts.php",{where:where},
        function(result){
          var data = $.parseJSON(result);
          var data0 = data[0][0];
          var data1 = data[0][1];
          var data2 = data[1][0];
          var data3 = data[1][1];
          var data4 = data[2][0];
          var data5 = data[2][1];
          var data6 = data[3][0];
          var data7 = data[3][1];
          var data8 = data[4][0];
          var data9 = data[4][1];
          var data10 = data[5][0];
          var data11 = data[5][1];
          var data12 = data[6][0];
          var data13 = data[6][1];
        var data = google.visualization.arrayToDataTable([
          [data0, data1],
         [data2, parseInt(data3)],
          [data4, parseInt(data5)],
          [data6, parseInt(data7)],
          [data8, parseInt(data9)],
          [data10, parseInt(data11)],
          [data12, parseInt(data13)],
        ]);
        var options = {
          title: 'Fast moving products',
          legend: 'none',
           is3D:true,
          pieSliceText: 'label',
          slices: {  1: {offset: 0.2},
                    4: {offset: 0.1},
                    0: {offset: 0.2},
                    2: {offset: 0.1},
          },
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart2'));
        chart.draw(data, options);
        });
      }

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        var where = 'salescomparison';
       $.post("../charts.php",{where:where},
        function(result){
                   var data = google.visualization.arrayToDataTable([
          ['Day', 'Royson', 'Ken', 'Reuben', 'Damaris', 'George', 'Average'],
          ['07/08/2020',  165,      938,         522,             998,           450,      614.6],
          ['08/08/2020',  135,      1120,        599,             1268,          288,      682],
          ['09/08/2020',  157,      1167,        587,             807,           397,      623],
          ['10/08/2020',  139,      1110,        615,             968,           215,      609.4],
          ['Yesterday',  136,      691,         629,             1026,          366,      569.6],
          ['Today',  136,      691,         629,             1026,          366,      569.6],
        ]);

        var options = {
          title : 'Weekly Sales Made per Deliverer',
          vAxis: {title: 'Sales'},
          hAxis: {title: 'Day'},
          seriesType: 'bars',
          series: {5: {type: 'line'}}        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
        });
      }

      google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawComparison1);
    function drawComparison1() {
      var where = 'salescomparison1';
       $.post("../charts.php",{where:where},
        function(result){
     var data = google.visualization.arrayToDataTable([
        ['Deliverer', 'Fantasy & Sci Fi', 'Romance', 'Mystery/Crime', 'General',
         'Western', 'Literature', { role: 'annotation' } ],
        ['Today', 10, 24, 20, 32, 18, 5, '']
      ]);

     var view = new google.visualization.DataView(data);

      var options = {
        width: 550,
        height: 100,
        legend: { position: 'top', maxLines: 3 },
        bar: { groupWidth: '75%' },
        isStacked: true
      };
      var chart = new google.visualization.BarChart(document.getElementById("salesComparison1"));
      chart.draw(view, options);
      });
  }

  google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawComparison2);
    function drawComparison2() {
      var where = 'salescomparison2';
       $.post("../charts.php",{where:where},
        function(result){
     var data = google.visualization.arrayToDataTable([
        ['Deliverer', 'Fantasy & Sci Fi', 'Romance', 'Mystery/Crime', 'General',
         'Western', 'Literature', { role: 'annotation' } ],
        ['Yesterday', 10, 24, 20, 32, 18, 5, '']
      ]);

     var view = new google.visualization.DataView(data);

      var options = {
        width: 550,
        height: 100,
        legend: { position: 'top', maxLines: 3 },
        bar: { groupWidth: '75%' },
        isStacked: true
      };
      var chart = new google.visualization.BarChart(document.getElementById("salesComparison2"));
      chart.draw(view, options);
       });
  }

  google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawComparison3);
    function drawComparison3() {
      var where = 'salescomparison3';
       $.post("../charts.php",{where:where},
        function(result){
     var data = google.visualization.arrayToDataTable([
        ['Deliverer', 'Fantasy & Sci Fi', 'Romance', 'Mystery/Crime', 'General',
         'Western', 'Literature', { role: 'annotation' } ],
        ['Yesterday', 10, 24, 20, 32, 18, 5, '']
      ]);

     var view = new google.visualization.DataView(data);

      var options = {
        width: 550,
        height: 100,
        legend: { position: 'top', maxLines: 3 },
        bar: { groupWidth: '75%' },
        isStacked: true
      };
      var chart = new google.visualization.BarChart(document.getElementById("salesComparison3"));
      chart.draw(view, options);
        });
  }

  google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawComparison4);
    function drawComparison4() {
      var where = 'salescomparison4';
       $.post("../charts.php",{where:where},
        function(result){
          var data = $.parseJSON(result);
          // alert(data)
          var names = data[0];
          var figures = data[1];
         // alert(names)
         // alert(figures)
     var data = google.visualization.arrayToDataTable([
        names,
        figures
      ]);

     var view = new google.visualization.DataView(data);

      var options = {
        width: 550,
        height: 100,
        legend: { position: 'top', maxLines: 3 },
        bar: { groupWidth: '75%' },
        isStacked: true
      };
      var chart = new google.visualization.BarChart(document.getElementById("salesComparison4"));
      chart.draw(view, options);
       });
  }

  google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawComparison5);
    function drawComparison5() {
      var where = 'salescomparison5';
       $.post("../charts.php",{where:where},
        function(result){
          var data = $.parseJSON(result);
          var data0 = data[0];
     var data = google.visualization.arrayToDataTable([
        ['Deliverer', 'Fantasy & Sci Fi', 'Romance', 'Mystery/Crime', 'General',
         'Western', 'Literature', { role: 'annotation' } ],
        [data0, 10, 24, 20, 32, 18, 5, '']
      ]);

     var view = new google.visualization.DataView(data);

      var options = {
        width: 550,
        height: 100,
        legend: { position: 'top', maxLines: 3 },
        bar: { groupWidth: '75%' },
        isStacked: true
      };
      var chart = new google.visualization.BarChart(document.getElementById("salesComparison5"));
      chart.draw(view, options);
      });
  }

  google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawComparison6);
    function drawComparison6() {
      var where = 'salescomparison6';
       $.post("../charts.php",{where:where},
        function(result){
          var data = $.parseJSON(result);
          var data0 = data[0];
     var data = google.visualization.arrayToDataTable([
        ['Deliverer', 'Fantasy & Sci Fi', 'Romance', 'Mystery/Crime', 'General',
         'Western',  { role: 'annotation' } ],
        [data0, 10, 24, 20, 32, 18, '']
      ]);

     var view = new google.visualization.DataView(data);
      var options = {
        width: 550,
        height: 100,
        legend: { position: 'top', maxLines: 3 },
        bar: { groupWidth: '75%' },
        isStacked: true
      };
      var chart = new google.visualization.BarChart(document.getElementById("salesComparison6"));
      chart.draw(view, options);
      });
  }

      /*  var data = google.visualization.arrayToDataTable([
          [data0, data1],
         [data2, parseInt(data3)],
          [data4, parseInt(data5)],
          [data6, parseInt(data7)],
          [data8, parseInt(data9)],
          [data10, parseInt(data11)],
          [data12, parseInt(data13)],
        ]);*/
      google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawExpenditureChart);
    function drawExpenditureChart() {
      var where = 'biggestExpenses';
       $.post("../charts.php",{where:where},
        function(result){
         var data = $.parseJSON(result);  
        var data0 = data[0][0];
          var data1 = data[0][1];
          var data2 = data[1][0];
          var data3 = data[1][1];
          var data4 = data[2][0];
          var data5 = data[2][1];
          var data6 = data[3][0];
          var data7 = data[3][1];
          var data8 = data[4][0];
          var data9 = data[4][1];
      var data = google.visualization.arrayToDataTable([
        ["Expense", "Amount", { role: "style" } ],
        [data0, parseInt(data1), "#b87333"],
        [data2, parseInt(data3), "silver"],
        [data4, parseInt(data5), "gold"],
        [data6, parseInt(data7), "color: #e5e4e2"],
        [data8, parseInt(data9), "brown"],
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Expenditure comparison for the month",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
      chart.draw(view, options);
      });
  }

      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawKeyCustomersChart);
      function drawKeyCustomersChart() {
        var where = 'biggestPayers';
       $.post("../charts.php",{where:where},
        function(result){
          var data = $.parseJSON(result);
          var data0 = data[0][0];
          var data1 = data[0][1];
          var data2 = data[1][0];
          var data3 = data[1][1];
          var data4 = data[2][0];
          var data5 = data[2][1];
          var data6 = data[3][0];
          var data7 = data[3][1];
          var data8 = data[4][0];
          var data9 = data[4][1];
        var data = google.visualization.arrayToDataTable([
          [data0, data1],
         [data2, parseInt(data3)],
          [data4, parseInt(data5)],
          [data6, parseInt(data7)],
          [data8, parseInt(data9)]
        ]);

        var options = {
          title: 'Biggest payers of the month',
          width:500,
        };

        var chart = new google.visualization.PieChart(document.getElementById('keyCutomersChart'));
        chart.draw(data, options);
        });
      }

      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawKeyCustomersChart);
      function drawKeyCustomersChart() {
        var where = 'customerType';
       $.post("../charts.php",{where:where},
        function(result){
          var data = $.parseJSON(result);
          var data0 = data[0][0];
          var data1 = data[0][1];
          var data2 = data[1][0];
          var data3 = data[1][1];
          var data4 = data[2][0];
          var data5 = data[2][1];
        var data = google.visualization.arrayToDataTable([
          [data0, data1],
         [data2, parseInt(data3)],
          [data4, parseInt(data5)]
        ]);

        var options = {
          title: 'Customer types in the past month',
          width:1030,
        };

        var chart = new google.visualization.PieChart(document.getElementById('customerTypeChart'));
        chart.draw(data, options);
        });
      }

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawRevenueExpenseChart);
      function drawRevenueExpenseChart() {
        var where = 'salesExpenses';
       $.post("../charts.php",{where:where},
        function(result){
          var data = $.parseJSON(result);
          var data0 = data[0];
          var data1 = data[1];
          var data2 = data[2];
          var data3 = data[3];
          var data4 = data[4];
          var data5 = data[5];
          var data6 = data[6];
          var data7 = data[7];
        var data = google.visualization.arrayToDataTable([
          ['Week', 'Sales', 'Costs'],
          ['Week 1',  parseInt(data0),  parseInt(data1)],
          ['Week 2', parseInt(data2),   parseInt(data3)],
          ['Week 3', parseInt(data4),    parseInt(data5)],
          ['Week 4', parseInt(data6),    parseInt(data7)]
        ]);

        var options = {
          title: 'Sales & Variable-Costs Comparison for the month',
          hAxis: {title: 'Week',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_divide'));
        chart.draw(data, options);
        });
      }

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawProfitChart);

      function drawProfitChart() {
        var where = 'profit/loss';
       $.post("../charts.php",{where:where},
        function(result){
           var data = $.parseJSON(result);
          var data0 = data[0];
          var data1 = data[1];
          var data2 = data[2];
          var data3 = 0;
          var data4 = 0;
          if (data0 > 0 && data2 > 0) {
          var data = google.visualization.arrayToDataTable([
          ['Title', 'Amount'],
          ['Gross Profit',  parseInt(data0)],
          ['Expenditure',  parseInt(data1)],
          ['Net Profit', parseInt(data2)],
        ]);

        var options = {
          title: 'Profit for the month',
          pieHole: 0.7,
          pieSliceText:'none',

        };
          }
          else if (data0 < 0 && data2 < 0) {
            data3 = data3 - data0;
            data4 = parseInt(data1) + parseInt(data3);
            var data = google.visualization.arrayToDataTable([
          ['Title', 'Amount'],
          ['Gross Loss',  parseInt(data3)],
          ['Expenditure',  parseInt(data1)],
          ['Net Loss', parseInt(data4)],
        ]);

        var options = {
          title: 'Loss for the month',
          pieHole: 0.7,
          pieSliceText:'none',

        };
          }
         else if (data0 > 0 && data2 < 0) {
            data4 = parseInt(data1) - parseInt(data0);
            var data = google.visualization.arrayToDataTable([
          ['Title', 'Amount'],
          ['Gross Profit',  parseInt(data0)],
          ['Expenditure',  parseInt(data1)],
          ['Net Loss', parseInt(data4)],
        ]);

        var options = {
          title: 'Loss for the month',
          pieHole: 0.7,
          pieSliceText:'none',

        };
          }
        var chart = new google.visualization.PieChart(document.getElementById('profitchart'));
        chart.draw(data, options);
        });
      }

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawSalesChart);

      function drawSalesChart() {
        var where = 'salesTotal';
       $.post("../charts.php",{where:where},
        function(result){
          var data = $.parseJSON(result);
          var data0 = data[0];
          var data1 = data[1];
          var data2 = data[2];
          var data3 = data[3];
        var data = google.visualization.arrayToDataTable([
          ['Week ', 'Sales'],
          ['Week 1',  parseInt(data0)],
          ['Week 2',  parseInt(data1)],
          ['Week 3',  parseInt(data2)],
          ['Week 4',  parseInt(data3)]
        ]);

        var options = {
          title: 'Total sales value for the month',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
        });
      }


 $(document).ready(function(){
         $(".paginate").DataTable({
          "ordering": false
         });

       });


   $(document).ready(function(){
         $("#customerOrderSearch").DataTable({
          "ordering": false,
          "pageLength": 5,
          "lengthChange": false,
          "info": false,
           "oLanguage": {
            "sSearch": "<i class='fa fa-search'></i>&ensp;Customer Search:",
            "sZeroRecords": "Customer Not Found"
          }
         });
       });

    $(document).ready(function(){
         $("#sellerRequisitionSearch").DataTable({
          "ordering": false,
          "pageLength": 5,
          "lengthChange": false,
          "info": false,
           "oLanguage": {
            "sSearch": "<i class='fa fa-search'></i>&ensp;Seller Search:",
            "sZeroRecords": "Seller Not Found"
          }
         });
       });

   $(document).ready(function(){
         $("#employeePayslipSearch").DataTable({
          "ordering": false,
          "pageLength": 5,
          "lengthChange": false,
          "info": false,
           "oLanguage": {
            "sSearch": "<i class='fa fa-search'></i>&ensp;Employee Search:",
            "sZeroRecords": "Employee Not Found"
          }
         });
       });

    $(document).ready(function(){
         $("#productOrderSearch").DataTable({
          "ordering": false,
          "pageLength": 5,
          "lengthChange": false,
          "info": false,
           "oLanguage": {
          "sSearch": "<i class='fa fa-search'></i>&ensp;Product Search:",
          "sZeroRecords": "Product Not Found"
        }
         });
       });

    $(document).ready(function(){
         $("#productSalesSearch").DataTable({
          "ordering": false,
          "pageLength": 5,
          "lengthChange": false,
          "info": false,
           "oLanguage": {
          "sSearch": "<i class='fa fa-search'></i>&ensp;Product Search:",
          "sZeroRecords": "Product Not Found"
        }
         });
       });
});
/*
       $(document).ready(function(){
            $('#customerSearch').keyup(function(){
            var txt = $('#customerSearch').val();
            var where = 'customer';
            if(txt != '')
            {
              $.ajax({
                url: '../search.php',
                type:"post",
                data:{search:txt,where:where},
                dataType:"text",
                success:function(data)
                {
                  $('#customer_results').html(data);
                }
              });
            }
            else
            {
              $('#customer_results').html('');
              $.ajax({
                url: '../search.php',
                type:"post",
                data:{search:txt,where:where},
                dataType:"text",
                success:function(data)
                {
                  $('#customer_results').html('');
                }
              });
            }
         });
            $(document).on('click','a',function(){
        $("#customerSearch").val($(this).find('.idX').text());
        $("#customer_results").html('');
        var customerId = $('#customerSearch').val();
           var where = 'customerDetails';
           $.post("../search.php",{customerId:customerId,where:where},
            function(result){var data = $.parseJSON(result);
              var customerDetails = "";
              var Name = data[0].Name;
               var Location = data[0].Location;
                var Deliverer = data[0].Deliverer;
            customerDetails += "<h5>Confirm Customer Details</h5>&emsp;&emsp;-";
            customerDetails += "&emsp;&emsp;Name: ";
            customerDetails += Name;
             customerDetails += "<br>&emsp;&emsp;&emsp;&emsp;&ensp;Location: ";
            customerDetails += Location;
             customerDetails += "<br>&emsp;&emsp;&emsp;&emsp;&ensp;Deliverer: ";
            customerDetails += Deliverer;
            if ($('#customerDetails').html('')){
            $("#customerDetails").append(customerDetails);
          }
          });
       });
        });



       $(document).ready(function(){
        var txt2 = $('#customerSearch').val();
            $('#productSearch').keyup(function(){
            var txt = $('#productSearch').val();
            var where = 'product';
            if(txt != '')
            {
              $.ajax({
                url: '../search.php',
                type:"post",
                data:{search2:txt,where:where},
                dataType:"text",
                success:function(data)
                {
                  $('#product_results').html(data);
                }
              });
            }
            else
            {
              $('#product_results').html('');
              $.ajax({
                url: '../search.php',
                type:"post",
                data:{search2:txt,where:where},
                dataType:"text",
                success:function(data)
                {
                  $('#product_results').html('');
                }
              });
            }
         });
            $(document).on('click','#selected2',function(){
        $("#productSearch").val($(this).text());
        $("#product_results").html('');
         $("#customerSearch").val(txt2.text());
       });
        });


         $(document).ready(function(){
        var txt = $('#productSearch').val();
        var button = document.getElementById('addToCart');
          if ($('#product_results').html('') && txt != '') {
            button.disabled = false;
          }
          else{
            button.disabled = true;
          }
       });



       $(document).ready(function(){
        $('#addToCart').click(function(){
           var productName = $('#productSearch').val();
           var productQty = $('#orderQty').val();
           var where = 'cart';
           $.post("../search.php",{productName:productName,where:where},
            function(result){var data = $.parseJSON(result);
              var Quantity = data[0].Quantity;
              alert(Quantity);
              alert(productQty);
               if (productQty > Quantity) {
            var productDetails = "";
            var id = data[0].id;
              var Price = data[0].Price;
                var Total = Price * productQty;
                var initial = $('#cartTotal').html();
                var Cost = +initial + +Total;
                $('#cartTotal').html(Cost);
                productDetails += "<tr>";
                productDetails += `<th id="id${id}" class='uneditable'>${id}</th>`;
                productDetails += `<td id="productName${id}" class='uneditable'>${productName}</td>`;
                productDetails += `<td id="Price${id}" class='uneditable'>${Price}</td>`;
                productDetails += `<td id="productQty${id}" class='editable'>${productQty}</td>`;
                productDetails += `<td class='uneditable'><button onclick="deleteCart();" type='button' class='btn btn-danger btn-sm deleteFromCart' id="deleteFromCart${id}"><i class='fa fa-times-circle'></i>&ensp;Remove</button></td>`;
                productDetails += `<td id="Total${id}" class='uneditable'>${Total}</td>`;
                productDetails += "</tr>";
                $("#cartData").append(productDetails);
              }
              else{
                alert("Quantity of Product ordered is currently unavailable.");
              }
            });
        });
      });
*/

$('.salesTab').on('click', function(){
    $('.salesTab').removeClass('selected');
    $('.tab-pane fade').removeClass('show active');
    $(this).addClass('selected');
    $('.tab-pane fade').addClass('active');
});

function updateProfile(){
  var username = $(`#username`).val();
  var email = $(`#email`).val();
  var number = $(`#number`).val();
  var nationalid = $(`#nationalid`).val();
  var staffid = $(`#staffid`).text();
   var where = 'profile';
  $.post("../save.php",{staffid:staffid,username:username,email:email,number:number,nationalid:nationalid,where:where},
  function(result){if (result == 'saved') {alert("Profile Updated");}});
}

var payrollArr = new Array();
function selectEmployee(selection) {
        var id = selection.value;
        var name = $(`#name${id}`).text();
        var gross = $(`#gross${id}`).text();
        var kra = $(`#kra${id}`).text();
        var nssf = $(`#nssf${id}`).text();
        var nhif = $(`#nhif${id}`).text();
        var net = $(`#net${id}`).text();
        $.post("payslipPDF.php",{id:id,name:name,gross:gross,kra:kra,nssf:nssf,nhif:nhif,net:net},
         function(result){
          var mywindow = window.open('', 'Sympha Fresh', 'height=400,width=600');
                        mywindow.document.write('<html><head><title></title>');
                        mywindow.document.write('</head><body>');
                        mywindow.document.write(result);
                        mywindow.document.write('</body></html>');
                        mywindow.document.close();
                        mywindow.focus();
                        mywindow.print();
                        mywindow.close();
          }); 
}
 
$('input:radio[name="selectedCustomer"]').change(function(){
  $("#newCustomer").attr('disabled','disabled');
});

$('input:radio[id="selectedUnregisteredCustomer"]').change(function(){
$("#newCustomer").removeAttr("disabled");
$("#newCustomer").val('');
var name = $("#newCustomer").val();
  customerDetails = "";
        customerDetails += "<h5>Confirm Customer Details</h5>&emsp;&emsp;-";
            customerDetails += "&emsp;&emsp;Name: ";
            customerDetails += name;
             customerDetails += "<br>&emsp;&emsp;&emsp;&emsp;&ensp;Location: ";
            customerDetails += 'N/A';
            customerDetails += "<br>&emsp;&emsp;&emsp;&emsp;&ensp;Contact: ";
            customerDetails += 'N/A';
             customerDetails += "<br>&emsp;&emsp;&emsp;&emsp;&ensp;Deliverer: ";
            customerDetails += 'N/A';
            if ($('#customerDetails').html('')){
            $("#customerDetails").append(customerDetails);
          }
          newCustomer = $(`#newCustomer`).val();
});

var newCustomer = '';
$("#newCustomer").on("keyup", function() {
  var name = $("#newCustomer").val();
  customerDetails = "";
        customerDetails += "<h5>Confirm Customer Details</h5>&emsp;&emsp;-";
            customerDetails += "&emsp;&emsp;Name: ";
            customerDetails += name;
             customerDetails += "<br>&emsp;&emsp;&emsp;&emsp;&ensp;Location: ";
            customerDetails += 'N/A';
            customerDetails += "<br>&emsp;&emsp;&emsp;&emsp;&ensp;Contact: ";
            customerDetails += 'N/A';
             customerDetails += "<br>&emsp;&emsp;&emsp;&emsp;&ensp;Deliverer: ";
            customerDetails += 'N/A';
            if ($('#customerDetails').html('')){
            $("#customerDetails").append(customerDetails);
          }
          newCustomer = $(`#newCustomer`).val();
})

var customerArr = new Array();
function selectCustomer(selection) {
        var id = selection.value;
        var name = '';
        var location = '';
        var number = '';
        var deliverer = '';
        while(customerArr.length > 0) {
          customerArr.pop();
        }
        customerArr.push(id);
        if(id == 'N/A')
        {
          name = $(`#newCustomer${id}`).val();
          location = 'N/A';
          number = 'N/A';
          deliverer = 'N/A';
          newCustomer = $(`#newCustomer`).val();
        }
        else{
          newCustomer = 'N/A';
          name = $(`#customerName${id}`).text();
         location = $(`#customerLocation${id}`).text();
         number = $(`#customerNumber${id}`).text();
         deliverer = $(`#customerDeliverer${id}`).text();
        }
        customerDetails = "";
        customerDetails += "<h5>Confirm Customer Details</h5>&emsp;&emsp;-";
            customerDetails += "&emsp;&emsp;Name: ";
            customerDetails += name;
             customerDetails += "<br>&emsp;&emsp;&emsp;&emsp;&ensp;Location: ";
            customerDetails += location;
            customerDetails += "<br>&emsp;&emsp;&emsp;&emsp;&ensp;Contact: ";
            customerDetails += number;
             customerDetails += "<br>&emsp;&emsp;&emsp;&emsp;&ensp;Deliverer: ";
            customerDetails += deliverer;
            if ($('#customerDetails').html('')){
            $("#customerDetails").append(customerDetails);
          }
}

var sellerArr = new Array();
function selectSeller(selection) {
        var id = selection.value;
        sellerArr.push(id);
        var name = $(`#sellerName${id}`).text();
        var number = $(`#sellerNumber${id}`).text();
        var vehicle = $(`#sellerVehicle${id}`).text();
        var route = $(`#sellerRoute${id}`).text();
        var sellerDetails = "";
        sellerDetails += "<h5>Confirm Seller Details</h5>&emsp;&emsp;-";
            sellerDetails += "&emsp;&emsp;Name: ";
            sellerDetails += name;
             sellerDetails += "<br>&emsp;&emsp;&emsp;&emsp;&ensp;Contact: ";
            sellerDetails += number;
            sellerDetails += "<br>&emsp;&emsp;&emsp;&emsp;&ensp;Vehicle: ";
            sellerDetails += vehicle;
             sellerDetails += "<br>&emsp;&emsp;&emsp;&emsp;&ensp;Route: ";
            sellerDetails += route;
            if ($('#sellerDetails').html('')){
            $("#sellerDetails").append(sellerDetails);
          }
}

       var cartItems = new Array();
       function cartArray(Id){
          var id = Id;
          var productId = $(`#id${id}`).text();
          var productName = $(`#name${id}`).text();
          var productPrice = $(`#sp${id}`).text();
          var available = $(`#qty${id}`).text();
          var quantity = '1';
          var discount = $(`#Discount${id}`).text();
          var button = document.getElementById(`add_product${id}`);
          button.disabled = true;
           cartItems.push([productId,productName, productPrice,quantity, discount,available,button]);
               populateCart();
       };


       function populateCart(){
        productDetails = "";
        var initial = $('#cartTotal').html();
        for (var i = 0; i < cartItems.length; i++) {
          var id =cartItems[i][0];
          var price = cartItems[i][2];
          var name = cartItems[i][1];
          var qty = cartItems[i][3];
          var discount = cartItems[i][4];
          var cost = price - discount;
          var subTotal = cost  * qty;
          var Total = +initial + +subTotal;
          $('#cartTotal').html(Total);
          productDetails += `<tr style="text-align: center;">
           <td class="uneditable">${id}</td>
            <td class="uneditable">${cartItems[i][1]}</td>
             <td class="uneditable" id="price${id}">${price}</td>
              <td class="editable" id="quantity${id}">${qty}</td>
              <td class="editable" id="discount${id}">${discount}</td>
               <td> <button class="btn">
               <i id="upQuantity${id}" onclick="upQuantity(${id},${price},${qty})" class='fa fa-plus'></i>
               </button>
               <button class="btn">
               <i id="downQuantity${id}" onclick="downQuantity(${id},${price},${qty})" class='fa fa-minus'></i>
               </button>
               <button id="deleteCart${id}" onclick="deleteCart(${id},this,${price},${qty})" type='button' class='btn btn-danger btn-sm deleteFromCart' >
               <i class='fa fa-times-circle'></i>&ensp;Remove</button>
               </td>
              <td class="uneditable" id="subTotal${id}">${subTotal}</td>
                 </tr>`;
                 $('#cartData').html(productDetails);
                 $('#cartEditable').editableTableWidget();
          $('#cartEditable td.uneditable').on('change', function(evt, newValue) {
          return false;
        });
          $('#cartEditable td').on('change', function(evt, newValue) {
            for (var i = 0; i < cartItems.length; i++) {
              var availableQty = cartItems[i][5];
               if (parseInt($(`#quantity${cartItems[i][0]}`).html()) == newValue) {
                if (parseInt(newValue) <= availableQty && parseInt(newValue) > 0) {
                  var id = cartItems[i][0];
                  var price = parseInt($(`#price${id}`).html());
                  var discount = parseInt($(`#discount${id}`).html());
                  var cost = price - discount;
                  newSub = newValue * cost;
                  //$(`#upQuantity${id}`).setAttribute('onclick',`upQuantity(${id},${price},${newValue})`);
                  cartItems[i][3] = newValue;
                  $(`#subTotal${id}`).html(newSub);
                } else{
                  alert('Quantity Not Available');
                  return false;
                }
              }

 /*
              document.getElementById(`upQuantity${id}`).setAttribute('onclick',`upQuantity(${id},${price},${newValue})`);
                   */

              if (parseInt($(`#discount${cartItems[i][0]}`).html()) == newValue) {
                if (newValue <= parseInt($(`#price${cartItems[i][0]}`).html())) {
                  var cost = parseInt($(`#price${cartItems[i][0]}`).html()) - newValue;
                  newSub2 = parseInt($(`#quantity${cartItems[i][0]}`).html()) * cost;
                  cartItems[i][4] = newValue;
                  $(`#subTotal${cartItems[i][0]}`).html(newSub2);
                } else {
                  alert('Discount cannot be greater than unit price.');
                  return false;
                }
              }
            }
            calculateTotal();
        });
        }
       }


       function calculateTotal(){
         var total=0;
         for (var i = 0; i < cartItems.length; i++) {
           total = total + parseInt($(`#subTotal${cartItems[i][0]}`).html());
         }
         $(`#cartTotal`).html(total)
       }

       function upQuantity(a,b,c){
         for (var i = 0; i < cartItems.length; i++) {
           if (cartItems[i][0]==a) {
             currentQ = cartItems[i][3];
             newQ = parseInt(currentQ) + 1;
             if (newQ <= cartItems[i][5]) {
               cartItems[i][3] = newQ;
             }else {
               alert('Quantity Not Available');
             }

           }
         }
         populateCart();
         calculateTotal();
       }
       function downQuantity(a,b,c){
         for (var i = 0; i < cartItems.length; i++) {
           if (cartItems[i][0]==a) {
             currentQ = cartItems[i][3];
             if (currentQ > 1) {
               newQ = parseInt(currentQ) - 1;
               cartItems[i][3] = newQ;
             }else {
               alert('Quantity cannot be below 1');
             }
           }
         }
         populateCart();
         calculateTotal();
       }

   /* function sumCart(){
      var table = document.getElementById("cartEditable");
      var sum = 0;
      for(var i =1; i < table.rows.length; i++){
        sum = sum + parseInt(table.rows[i].cells[5].innerHTML);
      }
      $('#cartTotal').html(sum);
    }
*/
//[productId,productName, productPrice,quantity, discount,available]

   function deleteCart(id,item,price,qty){
    var el = item;
    var Total = '';
      bootbox.confirm('Do you really want to remove the seleted item from the cart?',function(result)
        {if(result){
              $(el).closest('tr').css('background','tomato');
              $(el).closest('tr').fadeOut(800,function(){
                $(this).remove();
     });
     for (var i = 0; i < cartItems.length; i++) {
      if (cartItems[i][0]==id) {
     var discount =  cartItems[i][4];     
    var subTotal = (price * qty) - +discount;
     var initial = $('#cartTotal').html();
     Total = +initial - +subTotal ;
     var button = cartItems[i][6];
       button.disabled = false;
      var check = getIndexOfProduct(cartItems,id);
  cartItems.splice(check, 1);
   }
   }
        $('#cartTotal').html(Total);
    }
  });
}

function getIndexOfProduct(arr, k) {
  for (var i = 0; i < arr.length; i++) {
    if (k==arr[i][0]) {
      return i;
    }
  }
}

        $('.completeOrder').click(function(){
            completeOrderBalance(customerArr[0],cartItems,newCustomer);
        });

      function completeOrderBalance(custID,cartArr,newCust){
        for (var i = 0; i < cartArr.length; i++) {
          var stockID = cartArr[i][0];
          $.post("../add.php",{where:'order',price:cartArr[i][2],quantity:cartArr[i][3], discount:cartArr[i][4] ,customer:custID, stockid:cartArr[i][0], lateOrder:$(`#deliveryDate`).val(),newCustomer:newCust},
          function(result){
            if (result=='success') {
                cartArr.shift();
                customerArr.shift();
                //alert("Order Successfully Added"); 
            }
            else if(result=='unavailable'){
                alert("Quantity for stock id "+ stockID +" reduced below ordered quantity in ordering process. Order for the prodcust could not be completed.");
            }
          });
        }
        alert("Order Successfully Added");
      }

        $('.completeRequisition').click(function(){
            completeSalesBalance(sellerArr[0],cartItems);
        });

      function completeSalesBalance(sellerID,cartArr){
        for (var i = 0; i < cartArr.length; i++) {
          var stockID = cartArr[i][0];
          $.post("../add.php",{where:'sales',price:cartArr[i][2],quantity:cartArr[i][3], discount:cartArr[i][4] ,seller:sellerID, stockid:cartArr[i][0], salesDate:$(`#deliveryDate`).val()},
          function(result){
            if (result=='success') {
                cartArr.shift();
                sellerArr.shift();
               // alert("Requisition Successfully Completed");
            }
            else if(result=='unavailable'){
                alert("Quantity for stock id "+ stockID +" reduced below ordered quantity in ordering process. Order for the product could not be completed.");
            }
          });
        }
        alert("Requisition Successfully Completed");
      }

      function fineCustomerLastMonth(idx){
           var id = idx;
           var balance = $(`#balanceLastMonth${id}`).text();
              var where = 'fine';
              $.post("../save.php",{id:id,balance:balance,where:where},
              function(result){
                //alert(result);
                location.reload(true);
                var obj = parseJSON(result);
              //  alert(`Message: ${obj.msg}`);
              });
       }


       function fineCustomerYesterday(idx){
           var id = idx;
           var balance = $(`#balanceYesterday${id}`).text();
              var where = 'fine';
              $.post("../save.php",{id:id,balance:balance,where:where},
              function(result){
                //alert(result);
                location.reload(true);
                var obj = parseJSON(result);
              //  alert(`Message: ${obj.msg}`);
              });
       }

       function fineCustomerToday(idx){
           var id = idx;
           var balance = $(`#balanceToday${id}`).text();
              var where = 'fine';
              $.post("../save.php",{id:id,balance:balance,where:where},
              function(result){
                //alert(result);
                location.reload(true);
                var obj = parseJSON(result);
              //  alert(`Message: ${obj.msg}`);
              });
       }

       function fineCustomerTomorrow(idx){
           var id = idx;
           var balance = $(`#balanceTomorrow${id}`).text();
              var where = 'fine';
              $.post("../save.php",{id:id,balance:balance,where:where},
              function(result){
                //alert(result);
                location.reload(true);
                var obj = parseJSON(result);
              //  alert(`Message: ${obj.msg}`);
              });
       }

       function deleteOrderLastMonth(order,idx){
        var id = idx;
        var el = order;
        var cost = $(`#costLastMonth${id}`).text();
        var where = 'order';
            bootbox.confirm('Do you really want to delete the selected order?',function(result)
        {if(result){
          $.post("../delete.php",{id:id,cost:cost,where:where},
        function(result){
            if(result == 1){
              $(el).closest('tr').css('background','tomato');
              $(el).closest('tr').fadeOut(800,function(){
                $(this).remove();
              });
            }
        });
      }});
       }

       function deleteSalesLastMonth(sale,idx){
        var id = idx;
        var el = sale;
        var cost = $(`#costLastMonth${id}`).text();
        var where = 'sales';
            bootbox.confirm('Do you really want to delete the selected product from the sales?',function(result)
        {if(result){
          $.post("../delete.php",{id:id,cost:cost,where:where},
        function(result){
            if(result == 1){
              $(el).closest('tr').css('background','tomato');
              $(el).closest('tr').fadeOut(800,function(){
                $(this).remove();
              });
            }
        });
      }});
       }

       function deleteOrderNextMonth(order,idx){
        var id = idx;
        var el = order;
        var cost = $(`#costNextMonth${id}`).text();
        var where = 'order';
            bootbox.confirm('Do you really want to delete the selected order?',function(result)
        {if(result){
          $.post("../delete.php",{id:id,cost:cost,where:where},
        function(result){
            if(result == 1){
              $(el).closest('tr').css('background','tomato');
              $(el).closest('tr').fadeOut(800,function(){
                $(this).remove();
              });
            }
        });
      }});
       }

       function deleteOrderYesterday(order,idx){
        var id = idx;
        var el = order;
        var cost = $(`#costYesterday${id}`).text();
        var where = 'order';
            bootbox.confirm('Do you really want to delete the selected order?',function(result)
        {if(result){
          $.post("../delete.php",{id:id,cost:cost,where:where},
        function(result){
            if(result == 1){
              $(el).closest('tr').css('background','tomato');
              $(el).closest('tr').fadeOut(800,function(){
                $(this).remove();
              });
            }
        });
      }});
       }

       function deleteSalesYesterday(sale,idx){
        var id = idx;
        var el = sale;
        var cost = $(`#costYesterday${id}`).text();
        var where = 'sales';
            bootbox.confirm('Do you really want to delete the selected product from the sales?',function(result)
        {if(result){
          $.post("../delete.php",{id:id,cost:cost,where:where},
        function(result){
            if(result == 1){
              $(el).closest('tr').css('background','tomato');
              $(el).closest('tr').fadeOut(800,function(){
                $(this).remove();
              });
            }
        });
      }});
       }

       function deleteOrderToday(order,idx){
        var id = idx;
        var el = order;
        var cost = $(`#costToday${id}`).text();
        var where = 'order';
            bootbox.confirm('Do you really want to delete the selected order?',function(result)
        {if(result){
          $.post("../delete.php",{id:id,cost:cost,where:where},
        function(result){
            if(result == 1){
              $(el).closest('tr').css('background','tomato');
              $(el).closest('tr').fadeOut(800,function(){
                $(this).remove();
              });
            }
        });
      }});
       }

       function deleteSalesToday(sale,idx){
        var id = idx;
        var el = sale;
        var cost = $(`#costToday${id}`).text();
        var where = 'sales';
            bootbox.confirm('Do you really want to delete the selected product from the sales?',function(result)
        {if(result){
          $.post("../delete.php",{id:id,cost:cost,where:where},
        function(result){
            if(result == 1){
              $(el).closest('tr').css('background','tomato');
              $(el).closest('tr').fadeOut(800,function(){
                $(this).remove();
              });
            }
        });
      }});
       }

       function deleteOrderTomorrow(order,idx){
        var id = idx;
        var el = order;
        var cost = $(`#costTomorrow${id}`).text();
        var where = 'order';
            bootbox.confirm('Do you really want to delete the selected product from the requested products?',function(result)
        {if(result){
          $.post("../delete.php",{id:id,cost:cost,where:where},
        function(result){
            if(result == 1){
              $(el).closest('tr').css('background','tomato');
              $(el).closest('tr').fadeOut(800,function(){
                $(this).remove();
              });
            }
        });
      }});
       }

    function deleteSalesTomorrow(sale,idx){
        var id = idx;
        var el = sale;
        var cost = $(`#costTomorrow${id}`).text();
        var where = 'sales';
            bootbox.confirm('Do you really want to delete the selected product from the requested products?',function(result)
        {if(result){
          $.post("../delete.php",{id:id,cost:cost,where:where},
        function(result){
            if(result == 1){
              $(el).closest('tr').css('background','tomato');
              $(el).closest('tr').fadeOut(800,function(){
                $(this).remove();
              });
            }
        });
      }});
       }   



  $('#customersEditable').editableTableWidget();
  $('#customersEditable td.uneditable').on('change', function(evt, newValue) {
  return false;
});
  $('#customersEditable td').on('change', function(evt, newValue) {
   var rowx = parseInt(evt.target._DT_CellIndex.row)+1;
  var id = $(`#id${rowx}`).text();
  var name = $(`#name${rowx}`).text();
  var number = $(`#number${rowx}`).text();
  var location = $(`#location${rowx}`).text();
  var deliverer = $(`#deliverer${rowx}`).text();
  var note = $(`#note${rowx}`).text();
  var where = 'customer';
  $.post("../save.php",{id:id,name:name,location:location,number:number,deliverer:deliverer,note:note,where:where},
  function(result){});
});


  $('#stockEditable').editableTableWidget();
  $('#stockEditable td.uneditable').on('change', function(evt, newValue) {
  return false;
});
  $('#stockEditable td').on('change', function(evt, newValue) {
   var rowx = parseInt(evt.target._DT_CellIndex.row)+1;
  var id = $(`#id${rowx}`).text();
  var category = $(`#category${rowx}`).text();
  var name = $(`#name${rowx}`).text();
  var bp = $(`#bprice${rowx}`).text();
  var discount = $(`#discount${rowx}`).text();
  var sp = $(`#sprice${rowx}`).text();
  var qty = $(`#qty${rowx}`).text();
  var restock_Level = $(`#restock_Level${rowx}`).text();
  var where = 'stock';
  $.post("../save.php",{id:id,name:name,bp:bp,discount:discount,restock_Level:restock_Level,category:category,qty:qty,sp:sp,where:where},
  function(result){});
});


$('#blacklistEditable').editableTableWidget();
  $('#blacklistEditable td.uneditable').on('change', function(evt, newValue) {
  return false;
});
  $('#blacklistEditable td').on('change', function(evt, newValue) {
   var rowx = parseInt(evt.target._DT_CellIndex.row)+1;
  var id = $(`#id${rowx}`).text();
  var location = $(`#location${rowx}`).text();
  var number = $(`#number${rowx}`).text();
  var balance = $(`#balance${rowx}`).text();
  var where = 'blacklist';
  $.post("../save.php",{id:id,location:location,number:number,balance:balance,where:where},
  function(result){});
});


$('#categoriesEditable').editableTableWidget();
  $('#categoriesEditable td.uneditable').on('change', function(evt, newValue) {
  return false;
});
  $('#categoriesEditable td').on('change', function(evt, newValue) {
   var rowx = parseInt(evt.target._DT_CellIndex.row)+1;
  var id = $(`#id${rowx}`).text();
  var name = $(`#category${rowx}`).text();
  var where = 'categories';
  $.post("../save.php",{id:id,name:name,where:where},
  function(result){});
});

  $('#inventoryUnitsEditable').editableTableWidget();
  $('#inventoryUnitsEditable td.uneditable').on('change', function(evt, newValue) {
  return false;
});
  $('#inventoryUnitsEditable td').on('change', function(evt, newValue) {
   var rowx = parseInt(evt.target._DT_CellIndex.row)+1;
  var id = $(`#id${rowx}`).text();
  var name = $(`#unit${rowx}`).text();
  var where = 'inventory_units';
  $.post("../save.php",{id:id,name:name,where:where},
  function(result){});
});

  $('#damagedEditable').editableTableWidget();
  $('#damagedEditable td.uneditable').on('change', function(evt, newValue) {
  return false;
});
  $('#damagedEditable td').on('change', function(evt, newValue) {
   var rowx = parseInt(evt.target._DT_CellIndex.row)+1;
  var id = $(`#id${rowx}`).text();
  var qty = $(`#newDamaged${rowx}`).text();
  var where = 'damaged';
  $.post("../save.php",{id:id,qty:qty,where:where},
  function(result){
    location.reload(true);
  });
});

  $('#leftoversEditable').editableTableWidget();
  $('#leftoversEditable td.uneditable').on('change', function(evt, newValue) {
  return false;
});
  $('#leftoversEditable td').on('change', function(evt, newValue) {
   var rowx = parseInt(evt.target._DT_CellIndex.row)+1;
  var id = $(`#id${rowx}`).text();
  var difference = $(`#difference${rowx}`).text();
  var where = 'leftovers';
  $.post("../save.php",{id:id,difference:difference,where:where},
  function(result){
    location.reload(true);
  });
});

$('#suppliersEditable').editableTableWidget();
  $('#suppliersEditable td.uneditable').on('change', function(evt, newValue) {
  return false;
});
  $('#suppliersEditable td').on('change', function(evt, newValue) {
   var rowx = parseInt(evt.target._DT_CellIndex.row)+1;
  var id = $(`#id${rowx}`).text();
  var contact = $(`#contact${rowx}`).text();
  var where = 'suppliers';
  $.post("../save.php",{id:id,contact:contact,where:where},
  function(result){});
});

$('#vehiclesEditable').editableTableWidget();
  $('#vehiclesEditable td.uneditable').on('change', function(evt, newValue) {
  return false;
});
  $('#vehiclesEditable td').on('change', function(evt, newValue) {
   var rowx = parseInt(evt.target._DT_CellIndex.row)+1;
  var id = $(`#id${rowx}`).text();
  var route = $(`#route${rowx}`).text();
  var mileage = $(`#mileage${rowx}`).text();
  var where = 'vehicles';
  $.post("../save.php",{id:id,route:route,mileage:mileage,where:where},
  function(result){});
});

  $('#sickoffEditable').editableTableWidget();
  $('#sickoffEditable td.uneditable').on('change', function(evt, newValue) {
  return false;
});
  $('#sickoffEditable td').on('change', function(evt, newValue) {
   var rowx = parseInt(evt.target._DT_CellIndex.row)+1;
  var id = $(`#id${rowx}`).text();
  var reason = $(`#reason${rowx}`).text();
  var start = $(`#start${rowx}`).text();
  var days = $(`#days${rowx}`).text();
  var where = 'sickoff';
  $.post("../save.php",{id:id,reason:reason,start:start,days:days,where:where},
  function(result){});
});

  $('#leaveEditable').editableTableWidget();
  $('#leaveEditable td.uneditable').on('change', function(evt, newValue) {
  return false;
});
  $('#leaveEditable td').on('change', function(evt, newValue) {
   var rowx = parseInt(evt.target._DT_CellIndex.row)+1;
  var id = $(`#id${rowx}`).text();
  var standIn = $(`#standIn${rowx}`).text();
  var start = $(`#start${rowx}`).text();
  var days = $(`#days${rowx}`).text();
  var where = 'leave';
  $.post("../save.php",{id:id,standIn:standIn,start:start,days:days,where:where},
  function(result){alert(result);});
});

  $('#deliverersEditable').editableTableWidget();
  $('#deliverersEditable td.uneditable').on('change', function(evt, newValue) {
  return false;
});
  $('#deliverersEditable td').on('change', function(evt, newValue) {
   var rowx = parseInt(evt.target._DT_CellIndex.row)+1;
  var id = $(`#id${rowx}`).text();
  var contact = $(`#contact${rowx}`).text();
  var staffId = $(`#staffId${rowx}`).text();
  var nationalId = $(`#nationalId${rowx}`).text();
  var kra = $(`#kra${rowx}`).text();
  var nssf = $(`#nssf${rowx}`).text();
  var nhif = $(`#nhif${rowx}`).text();
  var salary = $(`#salary${rowx}`).text();
  var where = 'deliverer';
  $.post("../save.php",{id:id,contact:contact,staffId:staffId,nationalId:nationalId,kra:kra,nssf:nssf,nhif:nhif,salary:salary,where:where},
  function(result){});
});

   $('#cooksEditable').editableTableWidget();
  $('#cooksEditable td.uneditable').on('change', function(evt, newValue) {
  return false;
});
  $('#cooksEditable td').on('change', function(evt, newValue) {
   var rowx = parseInt(evt.target._DT_CellIndex.row)+1;
  var id = $(`#id${rowx}`).text();
  var contact = $(`#contact${rowx}`).text();
  var staffId = $(`#staffId${rowx}`).text();
  var nationalId = $(`#nationalId${rowx}`).text();
  var kra = $(`#kra${rowx}`).text();
  var nssf = $(`#nssf${rowx}`).text();
  var nhif = $(`#nhif${rowx}`).text();
  var salary = $(`#salary${rowx}`).text();
  var where = 'cook';
  $.post("../save.php",{id:id,contact:contact,staffId:staffId,nationalId:nationalId,kra:kra,nssf:nssf,nhif:nhif,salary:salary,where:where},
  function(result){});
});

  $('#cleanersEditable').editableTableWidget();
  $('#cleanersEditable td.uneditable').on('change', function(evt, newValue) {
  return false;
});
  $('#cleanersEditable td').on('change', function(evt, newValue) {
   var rowx = parseInt(evt.target._DT_CellIndex.row)+1;
  var id = $(`#id${rowx}`).text();
  var contact = $(`#contact${rowx}`).text();
  var staffId = $(`#staffId${rowx}`).text();
  var nationalId = $(`#nationalId${rowx}`).text();
  var kra = $(`#kra${rowx}`).text();
  var nssf = $(`#nssf${rowx}`).text();
  var nhif = $(`#nhif${rowx}`).text();
  var salary = $(`#salary${rowx}`).text();
  var where = 'cleaner';
  $.post("../save.php",{id:id,contact:contact,staffId:staffId,nationalId:nationalId,kra:kra,nssf:nssf,nhif:nhif,salary:salary,where:where},
  function(result){});
});

$('#officeEditable').editableTableWidget();
  $('#officeEditable td.uneditable').on('change', function(evt, newValue) {
  return false;
});
  $('#officeEditable td').on('change', function(evt, newValue) {
   var rowx = parseInt(evt.target._DT_CellIndex.row)+1;
  var id = $(`#id${rowx}`).text();
  var contact = $(`#contact${rowx}`).text();
  var staffId = $(`#staffId${rowx}`).text();
  var nationalId = $(`#nationalId${rowx}`).text();
  var kra = $(`#kra${rowx}`).text();
  var nssf = $(`#nssf${rowx}`).text();
  var nhif = $(`#nhif${rowx}`).text();
  var salary = $(`#salary${rowx}`).text();
  var role = $(`#role${rowx}`).text();
  var where = 'office';
  $.post("../save.php",{id:id,contact:contact,staffId:staffId,nationalId:nationalId,kra:kra,nssf:nssf,nhif:nhif,salary:salary,role:role,where:where},
  function(result){});
});

  /*$('#salesEditableLastMonth').editableTableWidget();
  $('#salesEditableLastMonth td.uneditable').on('change', function(evt, newValue) {
  return false;
});
  $('#salesEditableLastMonth td').on('change', function(evt, newValue) {
   var rowx = parseInt(evt.target._DT_CellIndex.row)+1;
  var id = $(`#idLastMonth${rowx}`).text();
  var qty = $(`#qtyLastMonth${rowx}`).text();
  var mpesa = $(`#mpesaLastMonth${rowx}`).text();
  var cash = $(`#cashLastMonth${rowx}`).text();
  var date = $(`#dateLastMonth${rowx}`).text();
  var returned = $(`#returnedLastMonth${rowx}`).text();
  var banked = $(`#bankedLastMonth${rowx}`).text();
  var slip = $(`#slipLastMonth${rowx}`).text();
  var banker = $(`#bankerLastMonth${rowx}`).text();
  var where = 'orders';
  $.post("../save.php",{id:id,qty:qty,mpesa:mpesa,cash:cash,returned:returned,date:date,banked:banked,slip:slip,banker:banker,where:where},
  function(result){
    if (result == 'Unavailable') {
      alert("Quantity Entered Unavailable");
    }
    else if (result == 'excess returned') {
      alert("Error: Returned greater than quantity requested");
    }
    else if (result == 'false qty') {
      alert("Error: Quantity cannot be a negative");
    }
    else if (result == 'false returned') {
      alert("Error: Returned cannot be a negative");
    }
    else{
    //location.reload(true);
  }
  });
});


  $('#salesEditableNextMonth').editableTableWidget();
  $('#salesEditableNextMonth td.uneditable').on('change', function(evt, newValue) {
  return false;
});
  $('#salesEditableNextMonth td').on('change', function(evt, newValue) {
   var rowx = parseInt(evt.target._DT_CellIndex.row)+1;
  var id = $(`#idNextMonth${rowx}`).text();
  var qty = $(`#qtyNextMonth${rowx}`).text();
  var mpesa = $(`#mpesaNextMonth${rowx}`).text();
  var cash = $(`#cashNextMonth${rowx}`).text();
  var date = $(`#dateNextMonth${rowx}`).text();
  var returned = 0;
  var banked = $(`#bankedNextMonth${rowx}`).text();
  var slip = $(`#slipNextMonth${rowx}`).text();
  var banker = $(`#bankerNextMonth${rowx}`).text();
  var where = 'orders';
  $.post("../save.php",{id:id,qty:qty,mpesa:mpesa,cash:cash,date:date,banked:banked,returned:returned,slip:slip,banker:banker,where:where},
  function(result){
     if (result == 'Unavailable') {
      alert("Quantity Entered Unavailable");
    }
    else if (result == 'excess returned') {
      alert("Error: Returned greater than quantity requested");
    }
    else{
    //location.reload(true);
  }
  });
});

  $('#salesEditableYesterday').editableTableWidget();
  $('#salesEditableYesterday td.uneditable').on('change', function(evt, newValue) {
  return false;
});
  $('#salesEditableYesterday td').on('change', function(evt, newValue) {
   var rowx = parseInt(evt.target._DT_CellIndex.row)+1;
  var id = $(`#idYesterday${rowx}`).text();
  var qty = $(`#qtyYesterday${rowx}`).text();
  var mpesa = $(`#mpesaYesterday${rowx}`).text();
  var cash = $(`#cashYesterday${rowx}`).text();
  var date = $(`#dateYesterday${rowx}`).text();
  var banked = $(`#bankedYesterday${rowx}`).text();
  var returned = $(`#returnedYesterday${rowx}`).text();
  var slip = $(`#slipYesterday${rowx}`).text();
  var banker = $(`#bankerYesterday${rowx}`).text();
  var where = 'orders';
  $.post("../save.php",{id:id,qty:qty,mpesa:mpesa,cash:cash,date:date,banked:banked,returned:returned,slip:slip,banker:banker,where:where},
  function(result){
     if (result == 'Unavailable') {
      alert("Quantity Entered Unavailable");
    }
    else if (result == 'excess returned') {
      alert("Error: Returned greater than quantity requested");
    }
    else{
    //location.reload(true);
  }
  });
});


  $('#salesEditableToday').editableTableWidget();
  $('#salesEditableToday td.uneditable').on('change', function(evt, newValue) {
  return false;
});
  $('#salesEditableToday td').on('change', function(evt, newValue) {
   var rowx = parseInt(evt.target._DT_CellIndex.row)+1;
  var id = $(`#idToday${rowx}`).text();
  var qty = $(`#qtyToday${rowx}`).text();
  var mpesa = $(`#mpesaToday${rowx}`).text();
  var cash = $(`#cashToday${rowx}`).text();
  var date = $(`#dateToday${rowx}`).text();
  var returned = $(`#returnedToday${rowx}`).text();
  var banked = $(`#bankedToday${rowx}`).text();
  var slip = $(`#slipToday${rowx}`).text();
  var banker = $(`#bankerToday${rowx}`).text();
  var where = 'orders';
  $.post("../save.php",{id:id,qty:qty,mpesa:mpesa,cash:cash,date:date,banked:banked,returned:returned,slip:slip,banker:banker,where:where},
  function(result){
     if (result == 'Unavailable') {
      alert("Quantity Entered Unavailable");
    }
    else if (result == 'excess returned') {
      alert("Error: Returned greater than quantity requested");
    }
    else{
    //location.reload(true);
  }
  });
});*/

function saveOrderToday(idx){
  var id = idx;
  var qty = $(`#qty_Today${id}`).val();
  var mpesa = $(`#mpesa_Today${id}`).val();
  var cash = $(`#cash_Today${id}`).val();
  var date = $(`#date_Today${id}`).val();
  var returned = $(`#returned_Today${id}`).val();
  var banked = $(`#banked_Today${id}`).val();
  var slip = $(`#slip_Today${id}`).val();
  var banker = $(`#banked_By_Today${id}`).val();
  var where = 'orders';
  $.post("../save.php",{id:id,qty:qty,mpesa:mpesa,cash:cash,date:date,banked:banked,returned:returned,slip:slip,banker:banker,where:where},
  function(result){
    if (result == 'Unavailable') {
      alert("Quantity Entered Unavailable");
    }
    else if (result == 'excess returned') {
      alert("Error: Returned greater than quantity requested");
    }
    else{
    location.reload(true);
  }
  });
 }

 function saveOrderTomorrow(idx){
  var id = idx;
  var qty = $(`#qty_Tomorrow${id}`).val();
  var mpesa = $(`#mpesa_Tomorrow${id}`).val();
  var cash = $(`#cash_Tomorrow${id}`).val();
  var date = $(`#date_Tomorrow${id}`).val();
  var returned = $(`#returned_Tomorrow${id}`).val();
  var banked = $(`#banked_Tomorrow${id}`).val();
  var slip = $(`#slip_Tomorrow${id}`).val();
  var banker = $(`#banked_By_Tomorrow${id}`).val();
  var where = 'orders';
  $.post("../save.php",{id:id,qty:qty,mpesa:mpesa,cash:cash,date:date,banked:banked,returned:returned,slip:slip,banker:banker,where:where},
  function(result){
    if (result == 'Unavailable') {
      alert("Quantity Entered Unavailable");
    }
    else if (result == 'excess returned') {
      alert("Error: Returned greater than quantity requested");
    }
    else{
    location.reload(true);
  }
  });
 }

 function saveOrderLastMonth(idx){
  var id = idx;
  var qty = $(`#qty_LastMonth${id}`).val();
  var mpesa = $(`#mpesa_LastMonth${id}`).val();
  var cash = $(`#cash_LastMonth${id}`).val();
  var date = $(`#date_LastMonth${id}`).val();
  var returned = $(`#returned_LastMonth${id}`).val();
  var banked = $(`#banked_LastMonth${id}`).val();
  var slip = $(`#slip_LastMonth${id}`).val();
  var banker = $(`#banked_By_LastMonth${id}`).val();
  var where = 'orders';
  $.post("../save.php",{id:id,qty:qty,mpesa:mpesa,cash:cash,date:date,banked:banked,returned:returned,slip:slip,banker:banker,where:where},
  function(result){
    if (result == 'Unavailable') {
      alert("Quantity Entered Unavailable");
    }
    else if (result == 'excess returned') {
      alert("Error: Returned greater than quantity requested");
    }
    else{
    location.reload(true);
  }
  });
 }

 function saveOrderNextMonth(idx){
  var id = idx;
  var qty = $(`#qty_NextMonth${id}`).val();
  var mpesa = $(`#mpesa_NextMonth${id}`).val();
  var cash = $(`#cash_NextMonth${id}`).val();
  var date = $(`#date_NextMonth${id}`).val();
  var returned = $(`#returned_NextMonth${id}`).val();
  var banked = $(`#banked_NextMonth${id}`).val();
  var slip = $(`#slip_NextMonth${id}`).val();
  var banker = $(`#banked_By_NextMonth${id}`).val();
  var where = 'orders';
  $.post("../save.php",{id:id,qty:qty,mpesa:mpesa,cash:cash,date:date,banked:banked,returned:returned,slip:slip,banker:banker,where:where},
  function(result){
    if (result == 'Unavailable') {
      alert("Quantity Entered Unavailable");
    }
    else if (result == 'excess returned') {
      alert("Error: Returned greater than quantity requested");
    }
    else{
    location.reload(true);
  }
  });
 }

 function saveOrderYesterday(idx){
  var id = idx;
  var qty = $(`#qty_Yesterday${id}`).val();
  var mpesa = $(`#mpesa_Yesterday${id}`).val();
  var cash = $(`#cash_Yesterday${id}`).val();
  var date = $(`#date_Yesterday${id}`).val();
  var returned = $(`#returned_Yesterday${id}`).val();
  var banked = $(`#banked_Yesterday${id}`).val();
  var slip = $(`#slip_Yesterday${id}`).val();
  var banker = $(`#banked_By_Yesterday${id}`).val();
  var where = 'orders';
  $.post("../save.php",{id:id,qty:qty,mpesa:mpesa,cash:cash,date:date,banked:banked,returned:returned,slip:slip,banker:banker,where:where},
  function(result){
    if (result == 'Unavailable') {
      alert("Quantity Entered Unavailable");
    }
    else if (result == 'excess returned') {
      alert("Error: Returned greater than quantity requested");
    }
    else{
    location.reload(true);
  }
  });
 }

  function readsales() {
            $.ajax({
                type: 'get',
                url: 'loadExtraSalesToday.php',
                dataType: 'html',
                success: function (data) {
                    $('#extraSalesEditableToday').html(data);
                }
            })
        }


  /*$('#salesEditableTomorrow').editableTableWidget();
  $('#salesEditableTomorrow td.uneditable').on('change', function(evt, newValue) {
  return false;
});
  $('#salesEditableTomorrow td').on('change', function(evt, newValue) {
   var rowx = parseInt(evt.target._DT_CellIndex.row)+1;
  var id = $(`#idTomorrow${rowx}`).text();
  var qty = $(`#qtyTomorrow${rowx}`).text();
  var mpesa = $(`#mpesaTomorrow${rowx}`).text();
  var cash = $(`#cashTomorrow${rowx}`).text();
  var date = $(`#dateTomorrow${rowx}`).text();
  var returned = 0;
  var banked = $(`#bankedTomorrow${rowx}`).text();
  var slip = $(`#slipTomorrow${rowx}`).text();
  var banker = $(`#bankerTomorrow${rowx}`).text();
  var where = 'orders';
  $.post("../save.php",{id:id,qty:qty,mpesa:mpesa,cash:cash,date:date,banked:banked,slip:slip,returned:returned,banker:banker,where:where},
  function(result){
     if (result == 'Unavailable') {
      alert("Quantity Entered Unavailable");
    }
    else{
    //location.reload(true);
  }
  });
});*/

   $('#expenseHeadingEditable').editableTableWidget();
  $('#expenseHeadingEditable td.uneditable').on('change', function(evt, newValue) {
  return false;
});
  $('#expenseHeadingEditable td').on('change', function(evt, newValue) {
   var rowx = parseInt(evt.target._DT_CellIndex.row)+1;
  var id = $(`#id${rowx}`).text();
  var name = $(`#name${rowx}`).text();
  var where = 'expenseHeading';
  $.post("../save.php",{id:id,name:name,where:where},
  function(result){
  });
});

  $('#expensesEditable').editableTableWidget();
  $('#expensesEditable td.uneditable').on('change', function(evt, newValue) {
  return false;
});
  $('#expensesEditable td').on('change', function(evt, newValue) {
   var rowx = parseInt(evt.target._DT_CellIndex.row)+1;
  var id = $(`#id${rowx}`).text();
  var party = $(`#party${rowx}`).text();
  var particular = $(`#particular${rowx}`).text();
   var total = $(`#total${rowx}`).text();
    var paid = $(`#paid${rowx}`).text();
     var due = total - paid;
     var date = $(`#date${rowx}`).text();
  var where = 'expense';
  $.post("../save.php",{id:id,party:party,particular:particular,total:total,paid:paid,due:due,date:date,where:where},
  function(result){
  });
});

 function formAjax(module){
    var form_data = new FormData($('form')[0]);
    $.ajax({
      url: '../add.php',
      type: 'post',
      data: form_data,
      contentType : false,
      processData : false,
      cache : false,
        success : function(data){
         if (data == 'success') {
          alert(module+' Added Successfully');
          location.reload(true);
         }
          else if (data == 'exists') {
          alert(module+' Already Exists');
         }
           else{
          alert("Something went wrong");
         }
         }
        });
 }

  $(document).on('click','#addCustomer',function(){
      formAjax('Customer');
  });

   $(document).on('click','#addStock',function(){
     formAjax('Product');
      });

  $(document).on('click','#uploadFile',function(){
        var name = $('#name').val();
        var description = $('#description').val();
        var form = $('#upload').serialize(); 
        var form = $('form')[0]; 
        // You need to use standard javascript object here
        var upload = new FormData(form);
        var location = $('#location').val();
        var where = 'files';
        $.post("../add.php",{name:name,description:description,location:location,upload:upload,where:where},
        function(result){
         if (result == 'success') {
          alert('File Uploaded Successfully');
          location.reload(true);
         }
          else if (result == 'exists') {
          alert('File Already Exists');
         }
         else{
          alert("Something went wrong");
         }
         });
       });

  $(document).on('click','#addCategory',function(){
    formAjax('Category');
    });

    $(document).on('click','#addFAQ',function(){
      formAjax('Question');
      });
      
      $(document).on('click','#addBlog',function(){
        var blog_text = tinyMCE.get('blog').getContent();
        var form_data = new FormData($('form')[0]);
        form_data.append('blog_text', blog_text);
        $.ajax({
          url: '../add.php',
          type: 'post',
          data: form_data,
          contentType : false,
          processData : false,
          cache : false,
            success : function(data){
               if (data == 'exists') {
              alert('Blog Already Exists');
              location.reload(true);
            }
              else{
              alert("Blog Added Successfully");
              location.reload(true);
            }
            }
            });
        }); 

  $(document).on('click','#addUnit',function(){
    formAjax('Unit');
       });

  $(document).on('click','.editAutomation',function(){
        var el = $(this);
        var id = el.attr("id");
        var stock = $(`#stock${id}`).val();
        var unit = $(`#unit${id}`).val();
        var contains = $(`#contains${id}`).val();
        var subunit = $(`#subunit${id}`).val();
        var replenish = $(`#replenish${id}`).val();
        var restock = $(`#restock${id}`).val();
        var where = 'stock_automation';
        $.post("../save.php",{stock:stock,unit:unit,contains:contains,subunit:subunit,replenish:replenish,restock:restock,where:where},
        function(result){
         if (result == 'success') {
          alert('Automation Successfully Set for Selected Stock');
          location.reload(true);
         }
         else{
          alert("Something went wrong");
         }
         });
       });

  $(document).on('click','#addSupplier',function(){
    formAjax('Supplier');
       });

  $(document).on('click','#addNote',function(){
        var title = $('#title').val();
         var message = $('#body').val();
         var radios = document.getElementsByName('access');
          for (var i = 0, length = radios.length; i < length; i++) {
          if (radios[i].checked) {
            var access = radios[i].value;
          }
         }
        var where = 'note';
        $.post("../add.php",{title:title,message:message,access:access,where:where},
        function(result){
         if (result == 'success') {
          alert('Note Added Successfully');
          location.reload(true);
         }
           else{
          alert("Something went wrong");
         }
         });
       });

  $(document).on('click','#addVehicle',function(){
    formAjax('Vehicle');
       });

  $(document).on('click','#addExpense',function(){
    formAjax('Expense');
       });

  $(document).on('click','#addSickoffApplication',function(){
        var employee = $('#employee').val();
        var reason = $('#sickoffReason').val();
         var start = $('#sickOffStart').val();
         var number = $('#sickoffNumber').val();
        var where = 'sickoff';
        $.post("../add.php",{employee:employee,reason:reason,start:start,number:number,where:where},
        function(result){
         if (result == 'success') {
          alert('Sick leave application successful');
          location.reload(true);
         }
          else{
            alert(result)
          alert("Something went wrong");
         }
         });
       });

  $(document).on('click','#addLeaveApplication',function(){
        var employee = $('#employee').val();
         var start = $('#leaveStart').val();
         var number = $('#leaveNumber').val();
         var standIn = $('#standIn').val();
        var where = 'leave';
        $.post("../add.php",{employee:employee,standIn:standIn,start:start,number:number,where:where},
        function(result){
         if (result == 'success') {
          alert('Leave application successful');
          location.reload(true);
         }
         else if(result == 'exceeded'){
          alert('Days applied exceeded days remaining. Application failed.');
         }
         else if(result == 'failed'){
          alert('Kindly select another stand in employee. Application failed.');
         }
          else{
          alert("Something went wrong");
         }
         });
       });

  $(document).on('click','#addExpenseHeading',function(){
    formAjax('Expense Heading');
       });

  $(document).on('click','#addDeliverer',function(){
    formAjax('Deliverer');
       });

  $(document).on('click','#addCook',function(){
    formAjax('Cook');
       });

  $(document).on('click','#addCleaner',function(){
    formAjax('Cleaner');
       });

   $(document).on('click','#addOfficeStaff',function(){
    formAjax('Office Staff');
       });

    function deleteAjax(id, el, module, where){
      bootbox.confirm('Do you really want to delete the selected '+module+'?',function(result)
        {if(result){
          $.post("../delete.php",{id:id,where:where},
        function(result){
            if(result == 1){
              $(el).closest('tr').css('background','tomato');
              $(el).closest('tr').fadeOut(800,function(){
               el.remove();
              });
            }
        });
      }});
    }

    $('.deleteCustomer').click(function(){
       deleteAjax($(this).attr("id"),$(this),'customer', 'customer');
    });

    $('.deleteStock').click(function(){
      deleteAjax($(this).attr("id"),$(this),'stock', 'stock');
    });

    $('.deleteBlacklist').click(function(){
      deleteAjax($(this).attr("id"),$(this),'blacklisted customer', 'blacklist');
    });

    $('.deleteExpenseHeading').click(function(){
      deleteAjax($(this).attr("id"),$(this),'expense heading', 'expenseHeading');
    });

    $('.deleteExpense').click(function(){
      deleteAjax($(this).attr("id"),$(this),'expense', 'expense');
    });


    $('.deleteCategory').click(function(){
      deleteAjax($(this).attr("id"),$(this),'category', 'category');
    });

    $('.deleteUnit').click(function(){
      deleteAjax($(this).attr("id"),$(this),'unit', 'unit');
    });

    $('.deleteSupplier').click(function(){
      deleteAjax($(this).attr("id"),$(this),'supplier', 'supplier');
    });

    $('.deleteVehicle').click(function(){
      deleteAjax($(this).attr("id"),$(this),'vehicle', 'vehicle');
    });

    $('.deleteDeliverer').click(function(){
      deleteAjax($(this).attr("id"),$(this),'deliverer', 'deliverer');
    });

    $('.deleteCook').click(function(){
      deleteAjax($(this).attr("id"),$(this),'cook', 'cook');
    });

    $('.deleteOffice').click(function(){
      deleteAjax($(this).attr("id"),$(this),'office staff', 'office');
    });

    $('.deletePublicNote').click(function(){
      deleteAjax($(this).attr("id"),$(this),'note', 'publicNote');
    });

    $('.deletePrivateNote').click(function(){
      deleteAjax($(this).attr("id"),$(this),'note', 'privateNote');
    });

    $('.deleteFAQ').click(function(){
      deleteAjax($(this).attr("id"),$(this),'FAQ', 'faq');
    });

    $('.deleteBlog').click(function(){
      deleteAjax($(this).attr("id"),$(this),'Blog', 'blog');
    });

  $(document).ready(function(){
    $('.blacklistCustomer').click(function(){
      var el = $(this);
      var where = 'blacklist';
      var id = el.attr("id");
      bootbox.confirm('Do you really want to blacklist the selected customer?',function(result)
        {if(result){
          $.post("blacklist_restore.php",{id:id,where:where},
        function(result){
            if(result == 1){
              $(el).closest('tr').css('background','gray');
              $(el).closest('tr').fadeOut(800,function(){
                $(this).remove();
              });
            }
            else{
              alert("Error: Selected Customer hasn't made any order yet.");
            }
        });
      }});
    });
  });

  $(document).ready(function(){
    $('.restoreBlacklist').click(function(){
      var el = $(this);
      var where = 'restore';
      var id = el.attr("id");
      bootbox.confirm('Do you really want to restore the selected blacklisted customer?',function(result)
        {if(result){
          $.post("blacklist_restore.php",{id:id,where:where},
        function(result){
            if(result == 1){
              $(el).closest('tr').css('background','lime');
              $(el).closest('tr').fadeOut(800,function(){
                $(this).remove();
              });
            }
        });
      }});
    });
  });

  $(document).on('click','.editPublicNote',function(){
        var where = 'publicNote';
        var el = $(this);
        var id = el.attr("id");
        var title = $(`#title${id}`).val();
        var body = $(`#body${id}`).val();
        $.post("../save.php",{id:id,title:title,body:body,where:where},
        function(result){
          location.reload(true);
         });
       });

  $(document).on('click','.editPrivateNote',function(){
        var where = 'privateNote';
        var el = $(this);
        var id = el.attr("id");
        var title = $(`#title${id}`).val();
        var body = $(`#body${id}`).val();
        $.post("../save.php",{id:id,title:title,body:body,where:where},
        function(result){
          location.reload(true);
         });
       });

       $(document).on('click','.editFAQ',function(){
        var where = 'faq';
        var el = $(this);
        var id = el.attr("id");
        var question = $(`#question${id}`).val();
        var answer = $(`#answer${id}`).val();
        $.post("../save.php",{id:id,question:question,answer:answer,where:where},
        function(result){
          location.reload(true);
         });
       });
       
       $(document).on('click','.editBlog',function(){
        var where = 'blog';
        var el = $(this);
        var id = el.attr("id");
        var title = $(`#title${id}`).val();
        var blog = tinyMCE.get('blog'+id).getContent();
        $.post("../save.php",{id:id,title:title,blog:blog,where:where},
        function(result){
          location.reload(true);
         });
       });

  $(document).on('click','.addPurchase',function(){
        var where = 'purchase';
        var el = $(this);
        var id = el.attr("id");
        var received = $(`#received${id}`).val();
        var qty = $(`#quantity${id}`).val();
         var bp = $(`#bp${id}`).val();
        var sp = $(`#sp${id}`).val();
        var expiry = $(`#expiry${id}`).val();
        $.post("../add.php",{id:id,received:received,qty:qty,bp:bp,sp:sp,expiry:expiry,where:where},
        function(result){
          location.reload(true);
         });
       });

  $(document).on('click','.addService',function(){
        var where = 'service';
        var el = $(this);
        var id = el.attr("id");
        var now = $(`#now${id}`).val();
        var note = $(`#note${id}`).val();
         var next = $(`#next${id}`).val();
        $.post("../save.php",{id:id,now:now,note:note,next:next,where:where},
        function(result){
          location.reload(true);
         });
       });

  $(document).on('click','.addInspection',function(){
        var where = 'inspection';
        var el = $(this);
        var id = el.attr("id");
        var now = $(`#Now${id}`).val();
        var note = $(`#Note${id}`).val();
         var next = $(`#Next${id}`).val();
        $.post("../save.php",{id:id,now:now,note:note,next:next,where:where},
        function(result){
           location.reload(true);
         });
       });

   $(document).on('click','.saveDriver',function(){
        var where = 'driver';
        var el = $(this);
        var id = el.attr("id");
        var driver = $(`#driver${id}`).val();
        $.post("../save.php",{id:id,driver:driver,where:where},
        function(result){
           alert("Vehicle driver Successfully changed");
         });
       });

       $("#receiptCustomer").on("keyup", function() {
        var txt = $('#receiptCustomer').val();
        if(txt != '')
        {
          $.ajax({
            url: '../search.php',
            type:"post",
            data:{receiptSearch:txt},
            dataType:"text",
            success:function(data)
            {
    
              $('#customerReceiptResult').html(data);
            }
          });
        }
        else
        {
          $('#customerReceiptResult').html('');
        }
        $(document).on('click','a',function(){
            $("#receiptCustomer").val($(this).text());
            var id =$(this).attr("id");
            $('#customerId').val(id);
            $("#customerReceiptResult").html(''); 
        });
      })

      $(document).on('click','.printReceipt',function(){
        var name = $(`#receiptCustomer`).val();
       var date = $(`#receiptDate`).val();
       var time = $(`#receiptTime`).val();
       $.post("receiptPDF.php",{name:name,date:date,time:time},
       function(result){ var mywindow = window.open('', 'Sympha Fresh', 'height=400,width=600');
                       mywindow.document.write('<html><head><title></title>');
                       mywindow.document.write('</head><body>');
                       mywindow.document.write(result);
                       mywindow.document.write('</body></html>');
                       mywindow.document.close();
                       mywindow.focus();
                       mywindow.print();
                       //mywindow.close();
        });
      });   

 $(document).on('click','.printCustomers',function(){
                $.ajax({
                    url: 'customersPrint.php',
                    type: 'get',
                    dataType: 'html',
                    success:function(data) {
                        var mywindow = window.open('', 'Sympha Fresh', 'height=400,width=600');
                        mywindow.document.write('<html><head><title></title>');
                        mywindow.document.write('</head><body>');
                        mywindow.document.write(data);
                        mywindow.document.write('</body></html>');
                        mywindow.document.close();
                        mywindow.focus();
                        mywindow.print();
                        //mywindow.close();

                    }
        });
    });

 $(document).on('click','.printStock',function(){
                $.ajax({
                    url: 'stockPrint.php',
                    type: 'get',
                    dataType: 'html',
                    success:function(data) {
                        var mywindow = window.open('', 'Sympha Fresh', 'height=400,width=600');
                        mywindow.document.write('<html><head><title></title>');
                        mywindow.document.write('</head><body>');
                        mywindow.document.write(data);
                        mywindow.document.write('</body></html>');
                        mywindow.document.close();
                        mywindow.focus();
                        mywindow.print();
                        //mywindow.close();
                    }
        });
    });

 $(document).on('click','.printSales',function(){
                $.ajax({
                    url: 'salesPrint.php',
                    type: 'get',
                    dataType: 'html',
                    success:function(data) {
                        var mywindow = window.open('', 'Sympha Fresh', 'height=400,width=600');
                        mywindow.document.write('<html><head><title></title>');
                        mywindow.document.write('</head><body>');
                        mywindow.document.write(data);
                        mywindow.document.write('</body></html>');
                        mywindow.document.close();
                        mywindow.focus();
                        mywindow.print();
                        //mywindow.close();

                    }
        });
    });

 $(document).on('click','.printExtraSales',function(){
                $.ajax({
                    url: 'extraSalesPrint.php',
                    type: 'get',
                    dataType: 'html',
                    success:function(data) {
                        var mywindow = window.open('', 'Sympha Fresh', 'height=400,width=600');
                        mywindow.document.write('<html><head><title></title>');
                        mywindow.document.write('</head><body>');
                        mywindow.document.write(data);
                        mywindow.document.write('</body></html>');
                        mywindow.document.close();
                        mywindow.focus();
                        mywindow.print();
                        //mywindow.close();

                    }
        });
    });

  $(document).on('click','.printGatePass',function(){
         var deliverer = $(`#deliverer`).val();
        var time = $(`#gatePassTime`).val();
        $.post("gatePassPDF.php",{deliverer:deliverer,time:time},
        function(result){ var mywindow = window.open('', 'Sympha Fresh', 'height=400,width=600');
                        mywindow.document.write('<html><head><title></title>');
                        mywindow.document.write('</head><body>');
                        mywindow.document.write(result);
                        mywindow.document.write('</body></html>');
                        mywindow.document.close();
                        mywindow.focus();
                        mywindow.print();
                        //mywindow.close();
         });
       });

  $(document).on('click','.printDistribution',function(){
         var deliverer = $(`#deliverer`).val();
        var time = $(`#distributionTime`).val();
        $.post("distributionPDF.php",{deliverer:deliverer,time:time},
        function(result){
           var mywindow = window.open('', 'Sympha Fresh', 'height=400,width=600');
                        mywindow.document.write('<html><head><title></title>');
                        mywindow.document.write('</head><body>');
                        mywindow.document.write(result);
                        mywindow.document.write('</body></html>');
                        mywindow.document.close();
                        mywindow.focus();
                        mywindow.print();
                        //mywindow.close();
         });
       });

  $(document).on('click','.printSalesInvoice',function(){
         var deliverer = $(`#deliverer`).val();
        var date = $(`#invoiceDate`).val();
        $.post("sales_invoice_print.php",{deliverer:deliverer,date:date},
        function(result){
           var mywindow = window.open('', 'Sympha Fresh', 'height=400,width=600');
                        mywindow.document.write('<html><head><title></title>');
                        mywindow.document.write('</head><body>');
                        mywindow.document.write(result);
                        mywindow.document.write('</body></html>');
                        mywindow.document.close();
                        mywindow.focus();
                        mywindow.print();
                        //mywindow.close();
         });
       });

  $(document).on('click','.printCreditNote',function(){
         var deliverer = $(`#deliverer`).val();
        var date = $(`#creditDate`).val();
        $.post("credit_note_print.php",{deliverer:deliverer,date:date},
        function(result){
           var mywindow = window.open('', 'Sympha Fresh', 'height=400,width=600');
                        mywindow.document.write('<html><head><title></title>');
                        mywindow.document.write('</head><body>');
                        mywindow.document.write(result);
                        mywindow.document.write('</body></html>');
                        mywindow.document.close();
                        mywindow.focus();
                        mywindow.print();
                        //mywindow.close();
         });
       });

  $(document).on('click','.printPaymentStatus',function(){
         var deliverer = $(`#deliverer`).val();
        var date = $(`#statusDate`).val();
        $.post("payment_status_print.php",{deliverer:deliverer,date:date},
        function(result){
           var mywindow = window.open('', 'Sympha Fresh', 'height=400,width=600');
                        mywindow.document.write('<html><head><title></title>');
                        mywindow.document.write('</head><body>');
                        mywindow.document.write(result);
                        mywindow.document.write('</body></html>');
                        mywindow.document.close();
                        mywindow.focus();
                        mywindow.print();
                        //mywindow.close();
         });
       });
      
      $(document).ready(function(){
       var tableLeftovers = document.getElementById("leftoversEditable");
       var  sumVal = 0; 
            for(var i = 1; i < tableLeftovers.rows.length; i++)
            {
                sumVal += parseInt(tableLeftovers.rows[i].cells[7].innerHTML);
                document.getElementById("totalLeftoverValue").innerHTML = sumVal;
            }
      });

      function replenishDisable(){
        var input = document.getElementById(`replenish`);
        input.disabled = true;
        input.value = "0";      
     }

     function subunitsDisable(){
       var input1 = document.getElementById(`contains`);
       input1.disabled = true;
       var input2 = document.getElementById(`subunit`);
       input2.disabled = true;
       input1.value = "0";
       input2.value = "1";
     }

     function processOrder(check,action) {
       var id = check.value;
       var value = '';
       var where = 'process_order';
       if (check.checked) {
        value = '1';
      } else {
        value = '0';
      }
       $.post("../save.php",{id:id,value:value,action:action,where:where},
        function(result){

         });
    }

     function displayname(input,_this) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function (e) {
                  _this.siblings('label').html(input.files[0]['name'])
                  
              }

              reader.readAsDataURL(input.files[0]);
          }
      }
     
