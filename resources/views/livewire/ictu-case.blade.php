<div class="card">
    <div class="card-header">
        <h4 class="card-title">
            <i class="fas fa-users"></i>
            {{ __('F0 Cases of ICTU') }}
        </h4>
    </div>
    <div class="card-body">
        <ul class="list-group">
            @foreach($data as $name)
                <li class="list-group-item">
                    {{ $name }}
                </li>
            @endforeach
        </ul>
    </div>
</div>
