<label {{ $attributes->class(['input-group-text']) }}>
    {{$slot}}

    @if($attributes->has('required'))
        <div class="text-danger">
            {{__('*')}}
        </div>
    @endif
</label>
