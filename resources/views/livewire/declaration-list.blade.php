<div class="card">
    <div class="card-header">
        <h4 class="card-title">
            <i class="fas fa-users"></i>
            {{ __('Declaration List') }}
        </h4>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 25%">Name</th>
                    <th>Progress</th>
                    <th>Note</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($statuses as $status)
                    <tr>
                        <td>{{ $status->name }}</td>
                        <td>
                            <div class="progress progress-xs progress-striped active">
                                <div class="progress-bar bg-success" style="width: {{ round(($status->number_injected / 3) * 100, 0) }}%"></div>
                            </div>
                        </td>
                        <td>
                            {{ $status->note }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer clearfix">
        {{ $statuses->links() }}
    </div>
</div>
