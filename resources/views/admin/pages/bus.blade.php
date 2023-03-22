@extends('admin.master')
@section('body')
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Starlight</a>
        <span class="breadcrumb-item active">Bus</span>
    </nav>
    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">
                <a href="{{ route('admin.bus.add') }}" class="btn btn-primary mg-r-5 text-white">Add Bus</a>
            </h6>
            <p class="mg-b-20 mg-sm-b-30"></p>
            <div class="table-responsive">
            <table class="table mg-b-0">
                <thead>
                <tr>
                    <th>Coach No</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @for ($i = 0; $i < $length; $i++)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $bus[$i]['name'] }}</td>
                        <td>
                            <a href="{{ route('admin.bus.view',$bus[$i]['id']) }}" class="btn btn-info mg-r-5">View Seat</a>
                            <form action="{{ route('admin.bus.delete',$bus[$i]['id']) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger mg-r-5">Delete Bus</button>
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
