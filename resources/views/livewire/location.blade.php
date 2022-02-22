<div class="card">
    <div class="card-header">
        <h4 class="card-title">
            <i class="fas fa-chart-bar"></i>
            {{ __('Statistic') }}
        </h4>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Cases</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($locations as $location)
                    <tr>
                        <td>{{ $location->name }}</td>
                        <td>
                            @if ($location->casesToday)
                                <small class="text-success mr-1">
                                    <i class="fas fa-arrow-up"></i>
                                    {{ $location->casesToday }}
                                </small>
                            @endif
                            {{ $location->cases }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer clearfix">
        {{ $locations->links() }}
    </div>
</div>
