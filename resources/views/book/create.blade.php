@extends('template')

@section('content')
    <div class="col-lg-6 mx-auto">
        <form method="post" enctype="multipart/form-data">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            <h1>Add new book</h1>
            <div class="form-group">
                <label for="title">Title</label>
                <input class="form-control" type="text" name="title" id="title">
            </div>
            <div class="form-group" id="cover">
              <label for="cover">Cover</label>
              <input type="file" class="form-control-file" name="cover" id="cover" onchange="readURL(this);">
            </div>
            <img hidden id="blah" src="#" alt="your image" height="350" width="250"/>
            <div class="form-group">
                <label for="writer">Writer</label>
                <input class="form-control" type="text" name="writer" id="writer">
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <input class="form-control" type="text" name="category" id="category">
            </div>
            <div class="form-group">
                <label for="synopsis">Synopsis</label>
                <textarea class="form-control" name="synopsis" id="synopsis" cols="30" rows="10"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script>

        function readURL(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
              $('#blah').attr('src', e.target.result);
            }
            const cover = document.getElementById("blah");
            cover.removeAttribute("hidden"); 

            reader.readAsDataURL(input.files[0]);
          }
        }

        $("#imgInp").change(function() {
          readURL(this);
        });
    </script>
@endsection