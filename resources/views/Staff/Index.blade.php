@extends('layouts.app')

@section('content')
<div class="header bg-gradient-red pb-8 pt-5 pt-md-8"></div>
    <div class="container-fluid mt--7">
        <!-- Staff Category Table -->
        <div class="row">
            <div class="col">
                <div class="card bg-default shadow shadow-dark">
                    <!-- Card header -->
                    <div class="card-header bg-transparent border-0">
                        <h3 class="text-white mb-0">Staff Category</h3>
                        {{-- <div class="pull-right">
                            <a href="{{ route('') }}" class="btn btn-success" role="button">Add Category</a>
                        </div> --}}
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-dark table-flush" id="sc-table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="sort" data-sort="number">#
                                        <span class="sort" data-sort="name">&nbsp;&nbsp;&nbsp;&nbsp;Name</span>
                                    </th>
                                    <th scope="col" class="sort" data-sort="desc">Description</th>
                                    {{-- <th scope="col" class="sort" data-sort="action">Actions</th> --}}
                                </tr>
                            </thead>
                            <tbody class="list">
                                <tr>
                                    <td colspan="2">
                                        <div class="rotate-icon" id="icon-rotate" style="text-align: center;">
                                            <img src="{{ asset('argon') }}/img/brand/spinner.png" width="50px">
                                        </div>
                                        <h4 hidden style="text-align: center; color: white;" id="no-data">There is no data</h4>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Staff Table -->
        <div class="row mt-5">
            <div class="col">
                <div class="card bg-default shadow shadow-dark">
                    <!-- Card header -->
                    <div class="card-header bg-transparent border-0">
                        <h3 class="text-white mb-0">Staff List</h3>
                        <div class="pull-right">
                            <a href="{{ route('Staff.create') }}" class="btn btn-success" role="button">Add Staff</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-dark table-flush" id="stf-table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="sort" data-sort="photo">Photo
                                        <span class="sort" data-sort="name">&nbsp;&nbsp;&nbsp;&nbsp;Name</span>
                                    </th>
                                    <th scope="col" class="sort" data-sort="position">Position</th>
                                    <th scope="col" class="sort" data-sort="number">Number</th>
                                    <th scope="col" class="sort" data-sort="username">Username</th>
                                    <th scope="col" class="sort" data-sort="status">Status</th>
                                    <th scope="col" class="sort" data-sort="action">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @forelse ($staff as $item)
                                    <tr>
                                        <th scope="row">
                                            <div class="media align-items-center">
                                                <a href="#" class="avatar rounded-circle mr-3">
                                                    @if ($item->up_photo)
                                                        <img src="data:image/{{ pathinfo($item->up_filename, PATHINFO_EXTENSION) }};base64,{{ base64_encode($item->up_photo) }}" alt="img">
                                                    @else
                                                        <img src="{{ asset('ProfileImg') }}/DefaultPPimg.jpg" alt="img">
                                                    @endif
                                                </a>
                                                <div class="media-body">
                                                    <span class="name mb-0 text-sm">{{ $item->stf_fullname }}</span>
                                                </div>
                                            </div>
                                        </th>
                                        <td class="position">{{ $item->sc_name }}</td>
                                        <td class="number">{{ str_replace('stf_', '', $item->stf_num_stat) }} :
                                            @switch($item->stf_num_stat)
                                                @case("stf_nidn")
                                                    {{ $item->stf_nidn }}
                                                    @break
                                                @case("stf_nidk")
                                                    {{ $item->stf_nidk }}
                                                    @break
                                                @case("stf_nip")
                                                    {{ $item->stf_nip }}
                                                    @break
                                                @case("stf_nik")
                                                    {{ $item->stf_nik }}
                                                    @break
                                                @default
                                                    No Data
                                            @endswitch
                                        </td>
                                        <td class="username">{{ $item->u_username }}</td>
                                        <td>
                                            @if ($item->stf_status == 1)
                                                <span class="badge badge-dot mr-4">
                                                    <i class="bg-success"></i>
                                                    <span class="status" title="{{ $item->u_username }} is Active {{ $item->sc_name }}">Active</span>
                                                </span>
                                            @else
                                                <span class="badge badge-dot mr-4">
                                                    <i class="bg-danger"></i>
                                                    <span class="status" title="{{ $item->u_username }} is Inactive {{ $item->sc_name }}">Inactive</span>
                                                </span>
                                            @endif
                                        </td>
                                        <td class="action">
                                            <a href="{{ route('Staff.show', $item->stf_u_id) }}" class="btn btn-sm btn-info btn-table" title="See All Data" role="button">Details</a>
                                            <a href="{{ route('Staff.edit', $item->stf_u_id) }}" class="btn btn-sm btn-primary btn-table" title="Edit Data" role="button">Edit</a>
                                            <button type="button" class="btn btn-sm btn-danger btn-table btn-delete-inline" title="Delete Data" data_id="{{ $item->stf_u_id }}" onclick="DeleteStaff(this)">Delete</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            <h4 style="text-align: center; color: white;">There is no data</h4>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
    
@endsection

@push('js')
    <script src="{{ asset('Scripts') }}/Staff.js"></script>
@endpush