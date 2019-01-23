@extends('admin.app')

@section('content')
<div class="container-fluid pl-0 pr-0">
    <div class="headline-contents border-bottom-0 headline-contents-height">
        <h2 class="d-inline-block headline-content"><span><a href="/admin/dashboard"> Dashboard  </a><i class="fa fa-angle-right ml-2 mr-2" aria-hidden="true"></i></span> Users</h2>
    </div>
    <div class="table-responsive-sm">
        <table class="table dataTable">
            <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created at</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $key => $user)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td><img src="{{ Avatar::create($user->fullname)->toBase64() }}" style="width: 32px; height: 32px; margin-right: 7px;">
                        {{$user->fullname}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->created_at->diffForHumans()}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
</div>


@endsection
