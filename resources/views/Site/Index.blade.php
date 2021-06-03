@extends('layouts.app')

@section('content')
<div class="header bg-gradient-red pb-8 pt-5 pt-md-8"></div>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card bg-default shadow shadow-dark">
                    <!-- Card header -->
                    <div class="card-header bg-transparent border-0">
                        <h3 class="text-white mb-0">Rectors</h3>
                        <div class="pull-right">
                            <a href="{{ route('Site.create') }}" class="btn btn-success" role="button">Add Rectors</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-dark table-flush">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="sort" data-sort="photo">Photo
                                        <span class="sort" data-sort="name">&nbsp;&nbsp;&nbsp;&nbsp;Name</span>
                                    </th>
                                    <th scope="col" class="sort" data-sort="number">Lecture Number</th>
                                    <th scope="col" class="sort" data-sort="username">Username</th>
                                    <th scope="col" class="sort" data-sort="position">Position</th>
                                    <th scope="col" class="sort" data-sort="status">Status</th>
                                    <th scope="col" class="sort" data-sort="action">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @forelse ($site as $item)
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
                                                    <span class="name mb-0 text-sm">{{ $item->s_fullname }}</span>
                                                </div>
                                            </div>
                                        </th>
                                        <td class="number">{{ str_replace('s_', '', $item->s_num_stat) }} :
                                            @switch($item->s_num_stat)
                                                @case("s_nidn")
                                                    {{ $item->s_nidn }}
                                                    @break
                                                @case("s_nidk")
                                                    {{ $item->s_nidk }}
                                                    @break
                                                @case("s_nip")
                                                    {{ $item->s_nip }}
                                                    @break
                                                @default
                                                    No Data
                                            @endswitch
                                        </td>
                                        <td class="username">{{ $item->u_username }}</td>
                                        <td class="position">{{ $item->s_remark }}</td>
                                        <td>
                                            @if ($item->s_status == 1)
                                                <span class="badge badge-dot mr-4">
                                                    <i class="bg-success"></i>
                                                    <span class="status" title="{{ $item->u_username }} is Active {{ $item->s_remark }}">Active</span>
                                                </span>
                                            @else
                                                <span class="badge badge-dot mr-4">
                                                    <i class="bg-danger"></i>
                                                    <span class="status" title="{{ $item->u_username }} is Inactive {{ $item->s_remark }}">Inactive</span>
                                                </span>
                                            @endif
                                        </td>
                                        <td class="action">
                                            <a href="{{ route('Site.show', $item->s_u_id) }}" class="btn btn-sm btn-info btn-table" title="See All Data" role="button">Details</a>
                                            <a href="{{ route('Site.edit', $item->s_u_id) }}" class="btn btn-sm btn-primary btn-table" title="Edit Data" role="button">Edit</a>
                                            <form action="{{ route('Site.destroy', $item->s_u_id) }}" method="post" class="btn-delete-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger btn-table" title="Delete Data" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
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
    <script src="{{ asset('Scripts') }}/Site.js"></script>
@endpush