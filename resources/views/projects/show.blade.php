@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row border-bottom">
        <div class="col-6">
            <h4>{{ $project->name }}</h4>
        </div>
        <div class="col-6">
            <button class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#export" >Wyeksportuj projekt</button>
            <button class="btn btn-primary btn-sm float-right zobacz" style="margin-right: 3px;" data-id="">Udostępnij</button>
        </div>
    </div>
    <br />

    <div class="row">
        <div class="col" style="margin-top: 40px;">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">Zdarzenia</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($events as $event)
                    <tr>
                        <td>{{ $event->name }}</td>
                        <td>
                            <button class="btn btn-danger btn-sm delete" data-id="{{ $event->id }}">X</button>
                            <button class="btn btn-success btn-sm zobacz" data-id="{{ $event->id }}">Z</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="text-center">
                <a class="" href="#">
                    <button type="button" data-toggle="modal" data-target="#add_event" class="btn btn-primary">+</button>
                </a>
            </div>
            {{ $events->links() }}
        </div>


        <div class="col-8">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Akcje</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Dodatkowe warunki</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Edytuj</a>
                </li>
            </ul>

            <table class="table table-hover" id="actiones">
                <thead>
                <tr>
                    <th scope="col">Nazwa</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><div class="alert alert-primary" role="alert">Wybierz zdarzenie, aby wyświetlić akcje!</div></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <div class="text-center">
                <a class="" href="#">
                    <button type="button" data-toggle="modal" data-target="#add_action" class="btn btn-primary">+</button>
                </a>
            </div>
        </div>
        
    </div>

    <div class="modal fade" id="add_event" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nowe zdarzenie</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="form_add_event" action="{{ route('events.store', $project->id) }}">
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Nazwa:</label>
                    <input name="name" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Rodzaj:</label>
                    <select name="type_id" class="form-control">
                        <option value="1">Wysłanie widomości</option>
                        <option value="2">Dołączenie do kanału głosowego</option>
                        <option value="3">Opuszczenie kanału głosowego</option>
                        <option value="4">Dołączenie do serwera</option>
                    </select>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Zapisz</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
            </div>
            </form>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add_action" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nowa akcja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_add_action" method="post" action="asjhdlakjsdf">
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Nazwa:</label>
                    <input name="name" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Rodzaj:</label>
                    <select name="type_id" class="form-control">
                        <option value="1">Wyslij wiadomość o treści:</option>
                        <option value="2">Utwórz zmienną</option>
                        <option value="3">Zbanuj użytkownika</option>
                        <option value="4">Wyrzuć uzytkownika</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="col-form-label">Dodatkowe pole1:</label>
                    <input name="dodatkowe1" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label class="col-form-label">Dodatkowe pole2:</label>
                    <input name="dodatkowe2" type="text" class="form-control">
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Zapisz</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
            </div>
            </form>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="export" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eksportowanie projektu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label text-md-right">Skopiuj kod</label>

                    <div class="col-md-6">
                    <button class="btn btn-success btn-sm float-right" onclick="ZaznaczCale()">Zaznacz wszystko</button>

                        <textarea id="description" maxlength="1500" class="form-control" name="description" rows="15">
const Discord = require('discord.js');
const client = new Discord.Client();

client.on('ready', () => {
  console.log(`Logged in as ${client.user.tag}!`);
});

client.on('message', msg => {
  if (msg.content === 'ping') {
    msg.reply('Pong!');
  }
});

client.login('token');
                        </textarea>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')

    function ZaznaczCale() {
        const input = document.getElementById('description');
        input.focus();
        input.select();
    }

    $( document ).ready(function() {
        $('.delete').click(function(){
            Swal.fire({
            title: 'Usunąć zdarzenie?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Tak',
            cancelButtonText: 'Nie'
            }).then((result) => {
            if (result.value) {
                $.ajax({
                method: "DELETE",
                url: "{{ config('app.url', 'Laravel') }}/events/" + $(this).data("id"),
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
            

            
        });

        

        $('.zobacz').click(function(){
            document.getElementById("form_add_action").action = "{{ config('app.url', 'Laravel') }}/actiones/"+$(this).data("id");
	        $.ajax({
            url: "{{ config('app.url', 'Laravel') }}/actiones/"+$(this).data("id"),
            type: 'get',
            dataType: 'json',
            success: function(response){

            var len = 0;
            $('#actiones tbody').empty();
            if(response['data'] != null){
                len = response['data'].length;
            }

            if(len > 0){
                for(var i=0; i<len; i++){
                    var name = response['data'][i].name;
                    var event = response['data'][i].event_id;

                    var tr_str = "<tr>" +
                    "<td>" + name + "</td>" +
                    '<td><button class="btn btn-primary btn-sm edytuj2" data-id="' + event + '">E</button></td>' +
                    "</tr>";

                    $("#actiones tbody").append(tr_str);
                }
            }else{
                var tr_str = "<tr>" +
                    "<td>To zdarzenie nie ma przypisanych akcji.</td>" +
                "</tr>";

                $("#actiones tbody").append(tr_str);
            }

            }
            });
            window.history.pushState('page2', 'Title', '{{ config('app.url', 'Laravel') }}/projects/{{ $project->id }}/e/' + $(this).data("id"));   
        });

        @if (isset($event_e))
            document.getElementById("form_add_action").action = "{{ config('app.url', 'Laravel') }}/actiones/" + {{ $event_e->id }};
	        $.ajax({
            url: "{{ config('app.url', 'Laravel') }}/actiones/"+{{ $event_e->id }},
            type: 'get',
            dataType: 'json',
            success: function(response){

            var len = 0;
            $('#actiones tbody').empty();
            if(response['data'] != null){
                len = response['data'].length;
            }

            if(len > 0){
                for(var i=0; i<len; i++){
                    var name = response['data'][i].name;
                    var event = response['data'][i].event_id;

                    var tr_str = "<tr>" +
                    "<td>" + name + "</td>" +
                    '<td><button class="btn btn-primary btn-sm edytuj2" data-id="' + event + '">E</button></td>' +
                    "</tr>";

                    $("#actiones tbody").append(tr_str);
                }
            }else{
                var tr_str = "<tr>" +
                    "<td>To zdarzenie nie ma przypisanych akcji.</td>" +
                "</tr>";

                $("#actiones tbody").append(tr_str);
            }

            }
            });
        @endif
    });
@endsection