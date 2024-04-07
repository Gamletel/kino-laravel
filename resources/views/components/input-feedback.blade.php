@php($id = $attributes->get('id'))

@error($id)
<div id="{{$id}}" class="invalid-feedback">
    {{ $message }}
</div>
@enderror
