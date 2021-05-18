@extends('layouts.app')

@section('content')
<div class="header bg-gradient-red pb-8 pt-5 pt-md-8"></div>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card bg-default shadow shadow-dark">
                    <!-- Card header -->
                    <div class="card-header bg-transparent border-0">
                        <h3 class="text-white mb-0">Edit Rectors</h3>
                    </div>
                    {{-- Error Handling --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Error!</strong> An Error has occured with your input
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="form-horizontal" action="{{ route('Site.update', $data[0]->s_u_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="box-body">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    @if ($data[0]->up_photo)
                                        <img id="profile-img" src="data:image/{{ pathinfo($data[0]->up_filename, PATHINFO_EXTENSION) }};base64,{{ $data[0]->up_photo }}" width="100" height="100" alt="img">
                                    @else
                                        <img id="profile-img" src="{{ asset('ProfileImg') }}/DefaultPPimg.jpg" width="100" height="100">
                                    @endif
                                    <div>
                                        <label for="image" class="control-label text-white">Photo Profile</label>
                                        <input type="file" class="form-control-file text-white" id="image" name="image" placeholder="image" value="{{ $data[0]->up_filename }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="u_username" class="control-label text-white">Username</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control form-inputs" placeholder="Ex: John_123" id="u_username" name="u_username" value="{{ $data[0]->u_username }}">
                                </div>
                            </div>
                        </div>
                        <div class="box-header">
                            <h3 class="box-title text-white">Details</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="s_fullname" class="control-label text-white">Fullname</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control form-inputs" placeholder="Ex: John Doe" id="s_fullname" name="s_fullname" value="{{ $data[0]->s_fullname }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="s_remark" class="control-label text-white">Position</label>
                                <div class="col-sm-12">
                                    <select class="form-control form-inputs" name="s_remark" id="s_remark" onchange="setNumberPlaceholder()">
                                        <option value="Rector" @if ($data[0]->s_remark == "Rector") {{ 'selected' }} @endif>Rector</option>
                                        <option value="Co-Rector" @if ($data[0]->s_remark == "Co-Rector") {{ 'selected' }} @endif>Co-Rector</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="s_num_stat" class="control-label text-white">Registered Number</label>
                                <div class="col-sm-12">
                                    <select class="col-sm-2 form-multi-control form-inputs" name="s_num_stat" id="s_num_stat" onchange="setNumberType(this)">
                                        <option value="s_nidn" @if ($data[0]->s_num_stat == "s_nidn") {{ 'selected' }} @endif>NIDN</option>
                                        <option value="s_nidk" @if ($data[0]->s_num_stat == "s_nidk") {{ 'selected' }} @endif>NIDK</option>
                                        <option value="s_nip" @if ($data[0]->s_num_stat == "s_nip") {{ 'selected' }} @endif>NIP</option>
                                    </select>
                                    <input type="tel" class="col-sm-10 form-multi-control form-inputs float-right lecture-num" placeholder="{{ $data[0]->s_remark.' '.str_replace('s_', '', $data[0]->s_num_stat) }} number" name="{{ $data[0]->s_num_stat }}" id="{{ $data[0]->s_num_stat }}"
                                    @switch($data[0]->s_num_stat)
                                        @case("s_nidn")
                                            value="{{ $data[0]->s_nidn }}"
                                            @break
                                        @case("s_nidk")
                                            value="{{ $data[0]->s_nidk }}"
                                            @break
                                        @case("s_nip")
                                            value="{{ $data[0]->s_nip }}"
                                            @break
                                        @default
                                            value="No Data"
                                    @endswitch>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="s_education" class="control-label text-white">Education</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control form-inputs" placeholder="Ex: Harvard University 2012-2016" name="s_education" id="s_education">{{ $data[0]->s_education }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="s_experience" class="control-label text-white">Experiences</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control form-inputs" placeholder="Ex: 1 Year Lecturer in Harvard" name="s_experience" id="s_experience">{{ $data[0]->s_experience }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="s_address" class="control-label text-white">Address</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control form-inputs" placeholder="Ex: Silicon Valley Street No 76th" id="s_address" name="s_address" value="{{ $data[0]->s_address }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="s_province" class="control-label text-white">Province</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control form-inputs" placeholder="Ex: Brooklyn" id="s_province" name="s_province" value="{{ $data[0]->s_province }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="s_city" class="control-label text-white">City</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control form-inputs" placeholder="Ex: New York City" id="s_city" name="s_city" value="{{ $data[0]->s_city }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="s_birthplace" class="control-label text-white">Birthplace</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control form-inputs" placeholder="Ex: Huston" id="s_birthplace" name="s_birthplace" value="{{ $data[0]->s_birthplace }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="s_birthdate" class="control-label text-white">Birthdate</label>
                                <div class="col-sm-12">
                                    <input type="date" class="form-control form-inputs" placeholder="Birthdate" id="s_birthdate" name="s_birthdate" value="{{ $data[0]->s_birthdate }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="s_gender" class="control-label text-white">Gender</label>
                                <div class="col-sm-12">
                                    <select class="form-control form-inputs" name="s_gender" id="s_gender">
                                        <option value="Laki-laki" @if ($data[0]->s_gender == "Laki-laki") {{ 'selected' }} @endif>Men</option>
                                        <option value="Perempuan" @if ($data[0]->s_gender == "Perempuan") {{ 'selected' }} @endif>Woman</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="s_religion" class="control-label text-white">Religion</label>
                                <div class="col-sm-12">
                                    <select class="form-control form-inputs" name="s_religion" id="s_religion">
                                        <option value="Islam" @if ($data[0]->s_religion == "Islam") {{ 'selected' }} @endif>Islam</option>
                                        <option value="Kristen" @if ($data[0]->s_religion == "Kristen") {{ 'selected' }} @endif>Kristen</option>
                                        <option value="Hindu" @if ($data[0]->s_religion == "Hindu") {{ 'selected' }} @endif>Hindu</option>
                                        <option value="Buddha" @if ($data[0]->s_religion == "Buddha") {{ 'selected' }} @endif>Buddha</option>
                                        <option value="Konghucu" @if ($data[0]->s_religion == "Konghucu") {{ 'selected' }} @endif>Konghucu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="s_email" class="control-label text-white">Email Address</label>
                                <div class="col-sm-12">
                                    <input type="email" class="form-control form-inputs" placeholder="Ex: john@gmail.com" id="s_email" name="s_email" value="{{ $data[0]->s_email }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="s_contact" class="control-label text-white">Contact</label>
                                <div class="col-sm-12">
                                    <input type="tel" class="form-control form-inputs" placeholder="Ex: +628902192xxxx" id="s_contact" name="s_contact" value="{{ $data[0]->s_contact }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="s_state" class="control-label text-white">Country of Origin</label>
                                <div class="col-sm-12">
                                    <input type="tel" class="form-control form-inputs" placeholder="Ex: Indonesia" id="s_state" name="s_state" value="{{ $data[0]->s_state }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="s_status" class="control-label text-white">Rector Status</label>
                                <div class="col-sm-12">
                                    <select class="form-control form-inputs" name="s_status" id="s_status">
                                        <option value="1" @if ($data[0]->s_status == 1) {{ 'selected' }} @endif>Active</option>
                                        <option value="0" @if ($data[0]->s_status == 0) {{ 'selected' }} @endif>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <a href="{{ route('Site.index') }}" class="btn btn-white" role="button">Cancel</a>
                            <button type="submit" class="btn btn-success float-right">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>

@endsection

@push('js')
    <script src="{{ asset('Scripts') }}/Site.js"></script>
@endpush