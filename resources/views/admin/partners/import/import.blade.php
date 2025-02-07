@extends('admin.layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Profile </h3>
            </div>
            <div class="row">
                <div class="col-12">
                    <form autocomplete="off" action="{{ route('admin.partners.import.post') }}" method="POST"
                        class="forms-sample" enctype="multipart/form-data">
                        @csrf
                        <div class="card mt-4">
                            <div class="card-body">
                                <h4 class="card-title">Upload Partners CSV File</h4>

                                <div class="form-group text-center">
                                    <label for="file">CSV File</label>
                                    <input type="file" class="form-control" id="file" name="file">
                                </div>

                                <button type="submit" class="btn btn-gradient-primary me-2">Import</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
