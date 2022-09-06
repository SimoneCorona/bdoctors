@extends('layouts.app')

@section('content')
<div>
  <canvas id="myChart"></canvas>
</div>
{{-- <div class="d-flex justify-content-around flex-wrap">
  <div class="chart">
    <canvas id="totale-messaggi" width="200" height="200"></canvas>
  </div>
  {{-- <div class="chart">
    <canvas id="totale-recensioni" width="200" height="200"></canvas>
  </div> --}}
  
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const labels = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
  ];

  const data = {
    labels: labels,
    datasets: [{
      label: 'My First dataset',
      backgroundColor: 'rgb(255, 99, 132)',
      borderColor: 'rgb(255, 99, 132)',
      data: [0, 10, 5, 2, 20, 30, 45],
    }]
  };

  const config = {
    type: 'line',
    data: data,
    options: {}
  };
</script>
<script>
  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>
  
  @endsection