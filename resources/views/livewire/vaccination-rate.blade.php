<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-chart-pie mr-1"></i>
                {{ __('Rate') }}
            </h3>
        </div>
        <div class="card-body">
            <canvas id="vaccination"></canvas>
        </div>
    </div>
    <script>
        var data = @json($data);

        var barColors = ["#b91d47", "#E8D803", "#00D69D"];

        new Chart("vaccination", {
            type: "pie",
            data: {
                labels: Object.keys(data),
                datasets: [{
                    backgroundColor: barColors,
                    data: Object.values(data)
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "Vaccination Rate"
                }
            }
        });
    </script>
</div>
