@extends('dashboard.layouts.main')
@section('page-heading', 'Dashboard')

@section('content')

    <div class="row g-3">
        <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="card">
                <div class="card-body d-flex align-items-center">
                    <i class="fa-duotone fa-user-circle fa-3x text-primary"></i>
                    <div class="d-flex flex-column ms-3">
                        <h5 class="card-title fs-6 mb-0">Welder</h5>
                        <p class="card-text fs-4 fw-semibold">{{ $total_welder }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="card">
                <div class="card-body d-flex align-items-center">
                    <i class="fa-duotone fa-newspaper fa-3x text-dark"></i>
                    <div class="d-flex flex-column ms-3">
                        <h5 class="card-title fs-6 mb-0">Berita</h5>
                        <p class="card-text fs-4 fw-semibold">{{ $total_berita }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card p-4 mt-4">
        <canvas id="myChart"></canvas>
    </div>

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    label: 'Traffic',
                    borderColor: "#8f44fd",
                    backgroundColor: "#8f44fd",
                    data: {!! json_encode($chartData) !!},
                    fill: true,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        suggestedMin: 0,
                        suggestedMax: 50,
                        grid: {
                            display: true,
                            drawBorder: true,
                            drawOnChartArea: true,
                            drawTicks: true,
                            color: "rgba(255, 255, 255, 0.08)",
                            borderColor: "transparent",
                            borderDash: [5, 5],
                            borderDashOffset: 2,
                            tickColor: "transparent"
                        },
                        beginAtZero: true
                    }
                },
                tension: 0.3,
                elements: {
                    point: {
                        radius: 8,
                        hoverRadius: 12,
                        backgroundColor: "#9BD0F5",
                        borderWidth: 0,
                    },
                },
            }
        });
    </script>
@endsection
