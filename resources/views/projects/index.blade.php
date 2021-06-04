@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Projekty') }}</div>
                <div class="card-body">
                    <a class="float-left">
                        <button type="button" class="btn btn-primary new">Dodaj</button>
                    </a>
                    <br />
                    <br />

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nazwa</th>
                            <th scope="col">Akcje</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($projects as $project)
                            <tr>
                                <th scope="row">{{ $project->id }}</th>
                                <td>{{ $project->name }}</td>
                                <td>
                                    <a href="{{ route('projects.show', $project->id) }}">
                                        <button class="btn btn-success btn-sm">Z</button>
                                    </a>
                                    <a href="{{ route('projects.edit', $project->id) }}">
                                        <button class="btn btn-primary btn-sm">E</button>
                                    </a>
                                    <button class="btn btn-danger btn-sm delete" data-id="{{ $project->id }}">X</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $projects->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
    $( document ).ready(function() {
        $('.new').click(function(){
            Swal.fire({
            title: 'Wpisz nazwę',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Utwórz',
            cancelButtonText: 'Anuluj',
            showLoaderOnConfirm: true,
            preConfirm: (newname1) => {
                $.ajax({
                method: "POST",
                url: "{{ config('app.url', 'Laravel') }}/projects",
                data: { name: `${newname1}`}
                })
                .done(function( msg ) {
                    window.location.reload();
                })
                .fail(function( msg ) {
                    Swal.fire('Error', '', 'error')
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
            })
        });


        $('.delete').click(function(){
            Swal.fire({
            title: 'Usunąć projekt?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Tak',
            cancelButtonText: 'Nie'
            }).then((result) => {
            if (result.value) {
                $.ajax({
                method: "DELETE",
                url: "{{ config('app.url', 'Laravel') }}/projects/" + $(this).data("id"),
                data: { id: $(this).data("id")}
                })
                .done(function( msg ) {
                    window.location.reload();
                })
                .fail(function( msg ) {
                    Swal.fire('Error', '', 'error')
                });
            
            }
            })

            
        })
    });
@endsection
