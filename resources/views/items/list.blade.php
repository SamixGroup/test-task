@extends('layout.base')

@section('content')

    <table class="table container">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">View</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <th scope="row">{{$item->id}}</th>
                <td><a class="btn btn-info" href="{{route('data.show', ['id'=>$item->id])}}"> <i class="bi bi-eye"></i>
                    </a></td>
                <td>
                    <form method="post" action="{{route('data.delete',['id'=>$item->id])}}">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger"><i
                                class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
