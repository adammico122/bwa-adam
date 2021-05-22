@extends('layouts.admin')
@section('title', 'Product')
@section('content')
    <div
        class="section-content section-dashboard-home"
        data-aos="fade-up"
    >
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Admin Dashboard</h2>
                <p class="dashboard-subtitle">
                    Edit Product
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
                                <form id="myForm" action="{{ route('product.update', $item->id) }}" method="POST">
                                @method('PUT')
                                    @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Name Product</label>
                                            <input type="text" name="name" class="form-control" placeholder="Input Name Product" value="{{ $item->name }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Pemilik Product</label>
                                            <select name="users_id" class="form-control">
                                                <option value="{{ $item->id }}" selected>{{ $item->user->name }}</option>
                                                @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Category Product</label>
                                            <select name="categories_id" class="form-control">
                                                <option value="{{ $item->categories_id }}" selected>{{ $item->category->name }}</option>
                                                @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                    <label for="">Price</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                                            <input type="text" name="price" class="price form-control" placeholder="Input Price" value="{{ $item->price }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Description Product</label>
                                            <textarea name="description" id="editor">{!! $item->description !!}</textarea>
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

@push('addon-script')
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        CKEDITOR.replace('editor');
    </script>
    <script>
       $(document).ready(function(){
        // Format mata uang.
        $('.price').mask('000.000.000', {reverse: true});
        });
            $("#myForm").submit(function() {
                $(".price").unmask();
            });
    </script>
@endpush