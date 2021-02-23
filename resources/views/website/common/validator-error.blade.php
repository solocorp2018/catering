@if ($errors)
    <div class="validater_error">
        <ul style="list-style-type:none;">
            @foreach ($errors as $error)
                <li class="text-danger">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
