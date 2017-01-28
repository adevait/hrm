<table id="{{ $id }}">
    @if($showHeaders)
        <thead>
        <tr>
            @foreach($columns as $name => $label)
                <th align="center" valign="middle" class="head-{{ $name }}">{{ $label }}</th>
            @endforeach
        </tr>
        </thead>
    @endif
</table>