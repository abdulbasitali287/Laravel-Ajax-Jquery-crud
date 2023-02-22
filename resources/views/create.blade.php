<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AJAX Image</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
                <div id="message_box"></div>
              <h1 class="modal-title fs-5" id="ModalLabel"></h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="image_form" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Name</label>
                      <input type="text" class="form-control" id="name" name="name">
                      @error('name')
                          {{ $message }}
                      @enderror
                      <div id="name_error" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                        @error('image')
                          {{ $message }}
                      @enderror
                        <div id="image_error" class="form-text"></div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
            </div>
          </div>
        </div>
      </div>
      {{-- midal end --}}

    {{-- navbar start --}}
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Navbar</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
            </ul>
            <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>
    {{-- navbar end --}}

      {{-- main content start --}}
      <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">

                <button type="button" id="form_button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Add
                  </button>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">SNo.</th>
                        <th scope="col">Name</th>
                        <th scope="col">Image</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                      </tr>
                    </tbody>
                  </table>
            </div>
        </div>
      </div>
      {{-- main content end --}}







    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){

            $("#form_button").click(function(){
                $("#ModalLabel").text("ADD RECORD");
            });

            $("#image_form").on("submit",function(event){
                event.preventDefault();
                $.ajax({
                    url : "{{ url('store') }}",
                    method : "POST",
                    data : new FormData(this),
                    dataType : "JSON",
                    contentType : false,
                    processData : false,
                    cache : false,
                    success : function(data){
                        $("#message_box").text(data.message);
                    },
                    error : function(data) {
                        // console.log(data);
                        // console.log(error);
                        // $("#message_box").text(response.error);
                        $("#name_error").text(data.errors);
                        // $("#name_error").text(response.name);
                        // $("#image_error").text(response.error.image[0]);
                    }
                });
            });
        });
    </script>
</body>
</html>
