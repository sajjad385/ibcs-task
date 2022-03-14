    @extends('layouts.master')
    @section('content')
        <div class="container">
            <div class="mt-3">
                <div class="offset-3 col-6">
                    <div class="row mb-5">
                        <div class="col-8">
                            <p class="h3"> Attendances Import Form</p>
                        </div>
                        <div class="col-4">
                            <a class="btn btn-primary float-end m-1" href="{{ route('attendances.index') }}">Back</a>
                        </div>
                    </div>
                    <form action="{{ route('attendances.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="file">Import Excel File (xls, csv, xlsx)*</label>
                            <input type="file" name="file" class="form-control">
                            <br>
                            <button class="btn btn-success">Import Excel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
