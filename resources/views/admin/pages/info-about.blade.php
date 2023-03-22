@extends('admin.master')
@section('body')
<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Starlight</a>
    <span class="breadcrumb-item active">Information About Page</span>
</nav>
<div class="sl-pagebody">
    <form method="POST" action="" class="card pd-20 pd-sm-40 form-layout form-layout-4">
        @csrf
        <h6 class="card-body-title">About Page</h6>
        <p class="mg-b-20 mg-sm-b-30"></p>
        <div class="row">
            <div class="col-12">
                <textarea id="summernote" name="page"></textarea>
                <div class="py-2">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@section('style')
<meta name="a_c" value="{{ $about }}">
@endsection
@section('script')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
        $('#summernote').summernote({
            placeholder: '',
            tabsize: 2,
            height: 340,
            toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link']],
            ['view', ['codeview', 'help']]
            ]
        });
        $('#summernote').summernote('code',$("meta[name=a_c]").attr('value'));
    </script>
@endsection
