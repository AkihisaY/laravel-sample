$(function(){

    // donutsChart();
    // circleChart();
    // barChart();
    ajax_func();
});

function ajax_func(){
    var url = '/data/top/stocks';
    for(i = 0 ; i < 2 ; i++){
        if(i == 1){
            url = '/data/top/assets';
        }
        ajax_action(url,i);
    }
    function ajax_action(url,cnt){
        $.ajax({
            haeder:{ 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
            url : url,
            type : 'GET',
            data : {},
            cache : false,
            dataType : 'json'
        })
        .done(function(data){
            if(data.status){
                if(cnt == 0){
                    donutsChart(data.assets);
                }else{
                    barChart(data.assets);
                }
            }else{
                window.location.href = "/error";
            }
        })
        .fail(function(XMLHttpRequest, textStatus, errorThrown){
            alert('Please reach out System Administrator');            
        })
    }
}

function donutsChart($asset){
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [
              'Cash(J)',
              'Cash(D)',
              'Inv(J)',
              'Inv(D)',
              'Stock(US)',
              'Stock(Other)'
            ],
            datasets: [{
              label: 'Asset Category',
              data: [$asset[0]['cash_jpy'], $asset[0]['cash_dol']
                    ,$asset[0]['cash_inv_jpy'],$asset[0]['cash_inv_dol']
                    ,$asset[0]['stock_us'],$asset[0]['stock_other']],
              backgroundColor: [
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(255, 99, 132)',
                'rgb(153, 102, 51)',
                'rgb(0, 153, 51)',
                'rgb(204, 51, 255)',
              ],
              hoverOffset: 10
            }]
        },
    });
}


function circleChart(){
    var ctx = document.getElementById('circleChart').getContext('2d');
    var circleChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

function barChart(asset){
    // console.log(asset);
    arr_label = [];
    arr_cash_jp = [];
    arr_cash_en = [];
    arr_inv_jp = [];
    arr_inv_en = [];
    arr_stock_us = [];
    arr_stock_other = [];
    var cont = asset.length - 1;
    while(cont >= 0){
        arr_label.push(asset[cont]['input_date']);
        arr_cash_jp.push(asset[cont]['cash_jpy']);
        arr_cash_en.push(asset[cont]['cash_dol']);
        arr_inv_jp.push(asset[cont]['cash_inv_jpy']);
        arr_inv_en.push(asset[cont]['cash_inv_dol']);
        arr_stock_us.push(asset[cont]['stock_us']);
        arr_stock_other.push(asset[cont]['stock_other']);
        cont -= 1;
    }
    var ctx = document.getElementById('circleChart2').getContext('2d');
    var circleChart2 = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: arr_label,
            datasets: [{
                label: "Cash(J)",
                backgroundColor: "orange",
                data: arr_cash_jp
            },
             {
                label: "Cash(D)",
                // borderWidth:1,
                backgroundColor: "yellow",
                // borderColor: "#1d3681",
                data: arr_cash_en
            },{
                label: "Inv(J)",
                backgroundColor: "red",
                data: arr_inv_jp
            },{
                label: "Inv(D)",
                backgroundColor: "blue",
                data: arr_inv_en
            },{
                label: "Stock(US)",
                backgroundColor: "green",
                data: arr_stock_us
            },{
                label: "Stock(Other)",
                backgroundColor: "gray",
                data: arr_stock_other
            }]
        },
        options: {
            scales: {
                x: {
                    stacked: true
                },
                y: {
                    stacked: true
                }
            }
        }
    });
}

//Delete Asset Info
function deleteData(id){
    console.log(id);
    ajax_action(id);
    function ajax_action(id){
        var url = '/data/top/delete';
        $.ajax({
            haeder:{ 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')},
            url : url,
            type : 'GET',
            data : { asset_id : id},
            cache : false,
            dataType : 'json'
        })
        .done(function(data){
            location.reload();
        })
        .fail(function(XMLHttpRequest, textStatus, errorThrown){
            alert('Please reach out System Administrator');            
        })
    }
}