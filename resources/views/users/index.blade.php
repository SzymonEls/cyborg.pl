@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nazwa</th>
            <th scope="col">E-mail</th>
            <th scope="col">Akcje</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <button class="btn btn-danger btn-sm delete" data-id="{{ $user->id }}">X</button>
                    <a href="{{ route('users.edit', $user->id) }}">
                        <button class="btn btn-primary btn-sm">E</button>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
</div>
@endsection
@section('javascript')
    $( document ).ready(function() {
        $('.delete').click(function(){
            Swal.fire({
            title: 'Usunąć użytkownika?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Tak',
            cancelButtonText: 'Nie'
            }).then((result) => {
            if (result.value) {
                $.ajax({
                method: "DELETE",
                url: "{{ config('app.url', 'Laravel') }}/users/" + $(this).data("id"),
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