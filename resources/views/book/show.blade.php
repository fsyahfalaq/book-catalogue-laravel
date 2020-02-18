@extends('template')

@section('content')

    <div class="col-lg-9">

        <div class="card mt-4">
          <img class="card-img-top img-fluid" src='/images/{{ $book->cover }}' alt="">
          <div class="card-body">
            <h3 class="card-title">Title: {{ $book->title }}</h3>
            <span>By {{ $book->writer }}</span>
            <h3>Synopsis</h3>
            <p class="card-text">
              {{ $book->synopsis }}
            </p>
            <div style="display:inline-block">
              <form action="/book/{{ $book->id }}" method="post">
                @method('DELETE')
                @csrf
                <a href="/book/{{ $book->id }}/edit" class="btn btn-outline-secondary">Edit</a>
                <button type="submit" class="btn btn-outline-danger">Delete</button>
              </form>
            </div>
          </div>
        </div>
        <!-- /.card -->

        <div class="card card-outline-secondary my-4">
          <div class="card-header">
            Book Reviews
          </div>
          <div class="card-body">
            @foreach($reviews as $review)
            <p>{{ $review->review }}</p>
            <small class="text-muted">Posted by {{ $review->name }}</small>
            <hr>
            @endforeach
            <button id="button-review" class="btn btn-success" onclick="showReviewForm();">Leave a Review</button>
            <form id="form-review" action="/book/review/{{ $book->id }}" method="post" hidden>
              @csrf
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control">
              </div>
                <div class="form-group">
                <label for="review">Review</label>
                <textarea name="review" id="review" cols="30" rows="10" class="form-control"></textarea>
              </div>
              <div class="form-group">
                <button class="btn btn-success" type="submit">Submit Review</button>
              </div>
            </form>
          </div>
        </div>
        <!-- /.card -->

      </div>
      <!-- /.col-lg-9 -->
      <script>
        function showReviewForm() {
          const buttonReview = document.getElementById("button-review");
          const formReview = document.getElementById("form-review");

          buttonReview.hidden = true;
          formReview.removeAttribute("hidden");
        }
      </script>

@endsection