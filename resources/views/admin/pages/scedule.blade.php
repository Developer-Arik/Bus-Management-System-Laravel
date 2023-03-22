@extends('admin.master')
@section('body')
<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Starlight</a>
    <span class="breadcrumb-item active">Scedule</span>
</nav>
<div class="sl-pagebody">
    <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">
            <a href="{{ route('admin.scedule.add') }}" class="btn btn-primary mg-r-5 text-white">Add Scedule</a>
        </h6>
        <p class="mg-b-20 mg-sm-b-30"></p>
        <div class="table-responsive">
        <table class="table mg-b-0">
            <thead>
            <tr>
                <th>SL No</th>
                <th>Departure</th>
                <th>Destination</th>
                <th>Bus</th>
                <th>Departure time</th>
                <th>seat fare</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>

            @for ($i = 0; $i < $length; $i++)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $bus[$i]->departure->name }}</td>
                    <td>{{ $bus[$i]->destination->name }}</td>
                    <td>{{ $bus[$i]->bus->name }}</td>
                    <td>{{ Carbon\Carbon::parse($bus[$i]['departure_time'])->format('g:i A'); }}</td>
                    <td>{{ $bus[$i]['seat_fare'] }}</td>
                    <td>
                        <form action="{{ route('admin.scedule.delete',$bus[$i]['id']) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger mg-r-5">Delete Scedule</button>
                        </form>
                    </td>
                </tr>
            @endfor
            </tbody>
        </table>
        </div>
    </div>
</div>
@endsection
