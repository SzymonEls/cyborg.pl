@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Lista zadań DD-MM-RRRR</div>

                <div class="card-body">


                        @foreach($projects as $project)
                                {{ $project->id }}
                                {{ $project->name }}

                        @endforeach

                    {{ $projects->links() }}


                <form>
                <div>
                        <input type="checkbox" id="scales" name="scales">
                        <label for="scales">a</label>
                    </div>

               

                <div>
                    <br />
                    <button type="submit">Submit</button>
                </div>
                </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
