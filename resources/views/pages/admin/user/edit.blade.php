@extends('layouts.admin')
@section('title', 'User')
@section('content')
    <div
        class="section-content section-dashboard-home"
        data-aos="fade-up"
    >
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Admin Dashboard</h2>
                <p class="dashboard-subtitle">
                    Edit User
                </p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                - {{ $error }}
                            @endforeach
                        </div>
                        @endif
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('user.update', $item->id) }}" method="POST">
                                @method('PUT')
                                    @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Name User</label>
                                            <input type="text" name="name" class="form-control" value="{{ $item->name }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Email User</label>
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <input type="email" name="email" class="form-control" placeholder="AdamMico@gmail.com" value="{{ $item->email }}" required>
                                        </div>
                                    </div>
                                     <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Password</label>
                                            <input type="password" name="password" class="form-control">
                                            <span class="text-danger">Kosongkan Jika Tidak Ingin Mengganti Password</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Phone Number</label>
                                            <input type="text" name="phone_number" class="form-control" value="{{ $item->phone_number }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Roles</label>
                                           <select name="roles" id="" class="form-control" required>
                                               <option value="" holder>- Pilih Roles -</option>
                                               <option value="Admin" {{ $item->roles == "Admin" ? 'selected' : '' }}>Admin</option>
                                               <option value="User"  {{ $item->roles == "User" ? 'selected' : '' }}>User</option>
                                           </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-primary px-5">
                                            Save Now
                                        </button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection