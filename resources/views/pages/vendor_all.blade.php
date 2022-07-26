@extends('layouts.app')
@section('title', 'All Vendor')
@section('breadcrumb')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Vendor List</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{url('/')}}" class="text-muted"><i class="fa fa-laptop"></i> Dashboard</a></li>
                            <li><span class="text-muted">Vendor List</span></li>
                            <li class="active">All Vendors</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('content')


@if ($message = Session::get('success'))
<div class="fixed-top">
    <div id='note' style='background-color: rgb(15 118 110)!important; color: #ffffff!important'>
        {{ $message }}
    </div>
</div>
@elseif ($message = Session::get('error'))
<div class="fixed-top">
    <div id='note'>
        {{ $message }}
    </div>
</div>
@endif
<div id="errors-list" class="fixed-top"></div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <button type="button" class="btn btn-success btn-md" id="addVendor"><i class="fa fa-plus"></i> Add Vendor</button>
            </div>
            <div class="card-body">
                <div class="table-responsive table-stats">
                    <table id="bootstrap-data-table" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>Province</th>
                                <th>Registered</th>
                                <th>Last Login</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($vendor as $dVendor)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $dVendor->name }}</td>
                                <td>{{ $dVendor->email }}</td>
                                <td>{{ $dVendor->phone }}</td>
                                <td>{{ $dVendor->address }}</td>
                                <td>{{ $dVendor->city }}</td>
                                <td>{{ $dVendor->province }}</td>
                                <td>{{ Carbon\Carbon::parse($dVendor->created_at)->translatedFormat('l, d F Y') }}</td>
                                <td>
                                    @if ($dVendor->last_login == null)
                                    <span class="badge badge-danger">Never</span>
                                    @else
                                    {{ Carbon\Carbon::parse($dVendor->last_login)->translatedFormat('l, d F Y') }}
                                    @endif
                                </td>
                                <td>
                                    @if ($dVendor->status_id == '1')
                                        <span class="badge badge-success">{{ $dVendor->status_id }}</span>
                                    @else
                                        <span class="badge badge-success">active</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('vendor.edit', $dVendor->id) }}" class="btn btn-warning">Edit</a>
                                    <a href="{{ route('vendor.show', $dVendor->id) }}" class="btn btn-primary">Show</a>
                                    <a href="{{ route('vendor.delete', $dVendor->id) }}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
        @include('includes.vendorModal')
@endsection
