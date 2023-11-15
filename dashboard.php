<?php
//Start the session.
session_start();
if(!isset($_SESSION['user'])) header('location: login.php');

$user = $_SESSION['user'];


//Get graph data -> purchase order by status...
include('database/po_status_pie_graph.php');

//Get graph data -> supplier product count...
include('database/supplier_product_bar_graph.php');
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="author" content="Vipul Ray">
<meta name="description" content="Dashboard of Retactics-The Inventory Management System">
<title>Dashboard | Retactics</title>
<?php include('partials/app-header-scripts.php') ?>
</head>
<body>
<div id="dashboardMainContainer">
<?php include('partials/app-sidebar.php')?>
<div class="dashboard_content_container" id="dashboard_content_container">
<?php include('partials/app-topnav.php') ?>
<div class="dashboard_content">
<div class="dashboard_content_main">
<div class="col50">
    <figure class="highcharts-figure">
        <div id="container"></div>
        <p class="highcharts-description">
            Here is the breakdown of the purchase order by status.
        </p>
    </figure>
</div>
<div class="col50">
    <figure class="highcharts-figure">
        <div id="containerBarChart"></div>
        <p class="highcharts-description">
            Here is the breakdown of the suppliers and their products.
        </p>
    </figure>
</div>
</div>
</div>
</div>
</div>
<script src="js/script.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>


<script>
    var graphData = <?= json_encode($results) ?>;


    Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Purchase Orders By Status',
        align: 'left'
    },
    tooltip: {
        pointFormatter: function(){
            var point = this,
            series = point.series;

            return `<b>${point.name}</b>: ${point.y}`
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.y}'
            }
        }
    },
    series: [{
        name: 'Status',
        colorByPoint: true,
        data: graphData
    }]
});



    var barGraphData = <?= json_encode($bar_chart_data) ?>;
    var barGraphCategories = <?= json_encode($categories) ?>;

    Highcharts.chart('containerBarChart', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Product Count Assigned to Supplier ',
    },
    xAxis: {
        categories: barGraphCategories,
        crosshair: true,
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Product Count'
        }
    },
    tooltip: {
        pointFormatter: function(){
            var point = this,
            series = point.series;



            return `<b>${point.category}</b>: ${point.y}`
        }

    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
            name: 'Suppliers',
            data: barGraphData
        }],
});






</script>
</body>
</html>