<div class="table-responsive">
    <table {{ $attributes->merge(['class' => 'table table-striped border w-100 datatable']) }}>
        {{ $slot }}
    </table>
</div>
