<div>
    <div wire:ignore>
        <select class="form-control" id="Citydropdown">
            <option value="">Select city</option>
            @foreach($cities as $city)
            <option value="{{ $city -> id }}">{{ $city -> name }}</option>
            @endforeach
        </select>
    </div>
</div>
@push('scripts')
<script>
    // $(document).ready(function () {
    //     $('#Citydropdown').select2();
    //     $('#Citydropdown').on('change', function (e) {
    //         var data = $('#Citydropdown').select2("val");
    //         @this.set('ottPlatform', data);
    //     });
    // });
</script>
@endpush