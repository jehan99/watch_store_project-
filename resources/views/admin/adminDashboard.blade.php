@extends('layouts.admin')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/2.6.2/countUp.umd.js"></script>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



<div class="container-fluid ">
<div class="row mt-5 d-flex justify-content-center g-3">

<div class="card col-lg-3 col-md-6 col-8 text-center d-flex justify-content-center align-items-center pt-3 pb-3 me-3 shadow">
<h5> Total Completed Orders</h5>
<img src="{{ asset('images/A1.png') }}" alt="A1 Image" width="100px" height="auto" class="mt-2">
<h6 class="mt-4" > <strong id="orderCount">{{ $totalOrderCount['totalOrders'] }} </strong></h6>

</div>

<div class="card col-lg-3 col-md-6 col-8 text-center d-flex justify-content-center align-items-center  pt-3  pb-3 me-3 mt-3 shadow">
<h5> Total revenue</h5>
<img src="{{ asset('images/salary.png') }}" alt="A1 Image" width="100px" height="auto" class="mt-2">
<h6 class="mt-4"> <strong>LKR: {{ $revenue['totalRevenue'] }} </strong></h6>

</div>

<div class="card col-lg-3 col-md-6 col-8 text-center d-flex justify-content-center align-items-center  pt-3  pb-3 me-3 mt-3 shadow">
<h5> Total Customers</h5>
<img src="{{ asset('images/customers.png') }}" alt="A1 Image" width="100px" height="auto" class="mt-2">
<h6 class="mt-4"> <strong>{{ $customerCount['totalCustomers'] }} </strong></h6>

</div>


</div>
</div>


<div class="container-fluid">
<div class="row mt-5">

</div>

 
<div class=" d-flex flex-wrap justify-content-center align-items-center">

<div  class="ms-4 mt-4 col-xl-5  col-lg-9 col-md-10 col-12">
<h3>Weekly Sales</h3>
    <canvas id="salesChart"></canvas>
</div>



<div class="ms-4 mt-4 col-xl-5 col-lg-9 col-md-10 col-12">
<h3>Monthly Sales</h3>
<canvas id="monthlyOrdersChart" class="ms-4 mt-4 "></canvas>
</div>


</div>
</div>
</div>





<script>
document.addEventListener("DOMContentLoaded", function () {

const labels = @json($weekly['labels']);
const data = @json($weekly['data']);

    const ctx = document.getElementById('salesChart');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Weekly Sales (LKR)',
                data: data,
                borderWidth: 2,
                fill: false
            }]
        }
    });

});


//MONTHLY CHART

document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('monthlyOrdersChart').getContext('2d');

    const labels = @json($monthly['labels']);
        const data = @json($monthly['data']);

    const monthlyOrdersChart = new Chart(ctx, {
        type: 'bar', // you can use 'line' or 'bar'
        
        data: {
            labels: labels, 
          datasets: [{
             label: 'Monthly Sales (LKR)',
             data: data,     // <--- the Y-axis values
               backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                title: {
                    display: true,
                    text: 'Monthly Sales'
                }
            }
        }
    });
});

</script>

@endsection