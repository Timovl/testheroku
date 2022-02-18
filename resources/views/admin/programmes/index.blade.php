@extends('layouts.template')
@section('title', 'Programmes')
@section('main')
    <h1>Programmes</h1>
    <p>
        <a href="/admin/programmes/create" class="btn btn-outline-success">
            <i class="fas fa-plus-circle mr-1"></i>Create new programme
        </a>
    </p>
    <ul class="list-group">
        @foreach($programmes as $programme)
            <div class="list-group-item">
                <a href="/admin/programmes/{{ $programme->id }}">{{ $programme->name }}</a>
                <form action="/admin/programmes/{{ $programme->id }}" method="post" class="text-right">
                    @method('delete')
                    @csrf
                    <div class="btn-group btn-group-sm">
                        <a href="/admin/programmes/{{ $programme->id }}/edit" class="btn btn-outline-success"
                           data-toggle="tooltip"
                           title="Edit {{ $programme->name }}">
                            <i class="fas fa-edit"></i>
                        </a>

                        <button type="button" class="btn btn-outline-danger deleteGenre"
                                data-toggle="tooltip"
                                data-progname="{{ $programme->name }}"
                                title="Delete {{ $programme->name }}">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </form>
            </div>
        @endforeach
    </ul>
@endsection
@section('script_after')
    <script>
        $('.deleteGenre').click(function () {
            const programmes = $(this).data('programmes');
            let msg = `Delete this programme ?`;
            if (programmes > 0) {
                msg += `\nThe ${programmes} programme be deleted!`
            }
            if (confirm(msg)) {
                $(this).closest('form').submit();
            }
        })
    </script>
@endsection
