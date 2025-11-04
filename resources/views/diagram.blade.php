@extends('layouts.app')

@section('content')
<div class="container my-5 text-center">
  <h2 class="text-light mb-4">Diagramok az adatbázisból</h2>

  <h4 id="selectedDay" class="text-info mb-4">
    📅 {{ str_replace('-', '.', $selectedDay) }} napi adatok
  </h4>

  <div class="row g-4">
    <div class="col-lg-6">
      <div class="card bg-dark border-secondary">
        <div class="card-header text-light">Pizzák száma kategóriánként</div>
        <div class="card-body"><canvas id="pieCat"></canvas></div>
      </div>
    </div>

    <div class="col-lg-6">
      <div class="card bg-dark border-secondary">
        <div class="card-header text-light">Rendelések naponta</div>
        <div class="card-body"><canvas id="lineOrders"></canvas></div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // PHP → JS adatok
  const catLabels = @json($catLabels);
  const catValues = @json($catValues);
  const ordLabels = @json($ordLabels);
  const ordValues = @json($ordValues);

  const dayLabel = document.getElementById('selectedDay');

  // Kördiagram – kategóriák
  const pieChart = new Chart(document.getElementById('pieCat'), {
    type: 'pie',
    data: {
      labels: catLabels,
      datasets: [{ data: catValues }]
    },
    options: {
      plugins: {
        legend: { labels: { color: '#ddd' } },
        tooltip: {
          callbacks: {
            title: ctx => `Kategória: ${ctx[0].label}`,
            label: ctx => `${ctx.formattedValue} db`
          }
        }
      }
    }
  });

  // Vonaldiagram – rendelések naponta
  const lineChart = new Chart(document.getElementById('lineOrders'), {
    type: 'line',
    data: {
      labels: ordLabels,
      datasets: [{
        label: 'Rendelések (db)',
        data: ordValues,
        tension: 0.2,
        borderColor: 'rgba(54, 162, 235, 0.8)',
        backgroundColor: 'rgba(54, 162, 235, 0.3)',
        fill: true
      }]
    },
    options: {
      onClick: (evt, elems) => {
        if (elems.length) {
          const index = elems[0].index;
          const day = ordLabels[index];
          dayLabel.textContent = `📅 ${day.replace(/-/g, '.')} napi adatok`;
          // itt később frissíthetjük a pieChartot is, ha nap szerint akarsz bontást
        }
      },
      scales: {
        x: { ticks: { color: '#ddd' }, grid: { color: '#333' } },
        y: { ticks: { color: '#ddd' }, grid: { color: '#333' } }
      },
      plugins: { legend: { labels: { color: '#ddd' } } }
    }
  });
</script>
@endsection
