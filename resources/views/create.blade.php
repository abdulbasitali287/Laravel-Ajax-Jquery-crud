<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AJAX Image</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  </head>
  <body>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="ModalLabel"></h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="image_form" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Name</label>
                      <input type="text" class="form-control" id="name" name="name">
                      <div id="name_error" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                        <div id="image_error" class="form-text mb-4"></div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
            </div>
          </div>
        </div>
      </div>
      {{-- midal end --}}

      {{-- edit modal --}}
      <!-- Modal -->
    <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="ModalLabel">EDIT RECORD</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul style="list-style: none" id="error_list">
                </ul>
                <form id="image_edit_form" enctype="multipart/form-data">
                    @csrf
                    <input type="text" class="form-control" id="edit_id">
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Name</label>
                      <input type="text" class="form-control" id="edit_name" name="edit_name">
                      <div id="name_error" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Image</label>
                        <input type="file" class="form-control" id="edit_image" name="edit_image">
                        <div id="show_image"></div>
                        <div id="image_error" class="form-text mb-4"></div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
            </div>
          </div>
        </div>
      </div>
      {{-- midal end --}}

      <!-- Modal -->
    <div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="ModalLabel">DELETE RECORD</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul style="list-style: none" id="error_list">
                </ul>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">img_id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Image</th>
                      </tr>
                    </thead>
                    <tbody id="deleteRecord">

                    </tbody>
                    <input type="text" id="confirmDelete">
                  </table>
            </div>
          </div>
        </div>
      </div>
      {{-- midal end --}}

      <div class="container" id="alert-messages">
        <h2 class="fw-bold text-center display-4 pt-4">AJAX-Jquery CRUD</h2>
      </div>
      {{-- main content start --}}
      <div class="container mt-5">
        <div class="row">
            <div class="col">

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
                    <tbody id="fetchRecord">

                    </tbody>
                  </table>
            </div>
        </div>
      </div>
      {{-- main content end --}}








    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            fetchData();
            function fetchData(){
                $.ajax({
                    url : "{{ url('index') }}",
                    // type : "GET",
                    // dataType : "JSON",
                    success : function(data){
                        // console.log(data);
                        $.each(data.student,function(key,value){
                            $("#fetchRecord").append('<tr>\
                        <td>'+value.img_id+'</td>\
                        <td>'+value.name+'</td>\
                        <td><img src='+value.image+' width="100" height="100"></td>\
                        <td>\
                            <button class="btn btn-sm btn-success edit-btn" id="editBtn" value="'+value.img_id+'">Edit</button>\
                            <button class="btn btn-sm btn-danger" id="deleteBtn" value="'+value.img_id+'">Delete</button>\
                        </td>\
                      </tr>')
                        });
                    }
                })
            };

            $(document).on("click","#editBtn",function(){
                var id = $(this).val();
                $("#EditModal").modal("show");
                $.ajax({
                    url : "edit/"+id,
                    dataType : "JSON",
                    success : function(data){
                        if (data.status == 400) {
                            $("#error_list").empty();
                            $("#error_list").removeClass("alert alert-danger");
                            $("#edit_id").val(data.students.img_id);
                            $("#edit_name").val(data.students.name);
                            $("#show_image").empty();
                            $("#show_image").append("<img src="+data.students.image+" width='100' height='100' ></img>");
                        }
                    }
                });
            });

            $("#image_edit_form").on("submit",function(event){
                event.preventDefault();
                var id = $("#edit_id").val();
                $.ajax({
                    url : "update/"+id,
                    // method : "POST", // method and type both working same
                    type : "POST",
                    data : new FormData(this),
                    dataType : "JSON",
                    contentType : false,
                    processData : false,
                    cache : false,
                    success : function(data){
                        $("#error_list").html("");
                        $("#image_edit_form")[0].reset();
                        $("#EditModal").modal("hide");
                        $("#alert-messages").append("<div class='alert alert-success alert-dismissible fade show' role='alert'><strong>Success!</strong>"+data.message+"<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>");
                        fetchData();
                    },
                    error : function(data){
                        $("#error_list").html("");
                        $("#error_list").append("<li></li>");
                        $("#error_list").addClass("alert alert-danger");
                        $.each(data.responseJSON.errors,function(key,item){
                            $("#error_list").append("<li>"+item+"</li>");
                            });
                    }
                });
            });

            // $(document).on("click","#deleteBtn",function(event){
            //     event.preventDefault();
            //     var id = $(this).val();
            //     $("#DeleteModal").modal("show");
            //     $.ajax({
            //         url : "delete/show/"+id,
            //         dataType : "JSON",
            //         success : function(data){
            //             if (data.status == 400) {
            //                 $("#deleteRecord").html("");
            //                 $("#confirmDelete").val(data.students.img_id);
            //                 $("#deleteRecord").append("<tr>\
            //                     <th>"+data.students.img_id+"</th>\
            //                     <td>"+data.students.name+"</td>\
            //                     <td><img src="+data.students.image+" width='100' height='100'></td>\
            //                     </tr>");
            //             }
            //         }
            //     });
            // });

            $(document).on("click","#deleteBtn",function(event){
                event.preventDefault();
                var id = $("#deleteBtn").val();
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                $.ajax({
                    url : "/delete/"+id,
                    type : "DELETE",
                    // dataType : "JSON",
                    success : function(data){
                        if (data.status == 400) {
                            $("#alert-messages").append("<div class='alert alert-success alert-dismissible fade show' role='alert'><strong>Success!</strong>"+data.message+"<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>");
                            fetchData();
                        }
                    }
                });
            });

            $("#form_button").click(function(){
                $("#ModalLabel").text("ADD RECORD");
            });

            $("#image_form").on("submit",function(event){
                event.preventDefault();
                $.ajax({
                    url : "{{ url('store') }}",
                    // method : "POST", // method and type both working same
                    type : "POST",
                    data : new FormData(this),
                    dataType : "JSON",
                    contentType : false,
                    processData : false,
                    cache : false,
                    success : function(data){
                        $("#image_form")[0].reset();
                        $("#exampleModal").modal('hide');
                        $("#alert-messages").append("<div class='alert alert-success alert-dismissible fade show' role='alert'><strong>Success!</strong>"+data.message+"<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>");
                        fetchData();
                    },
                    error : function(data) {
                        // console.log(data.responseJSON.errors);
                        $("#name_error").text(data.responseJSON.errors.name);
                        $("#image_error").text(data.responseJSON.errors.image);
                    }
                });
            });
        });
    </script>
</body>
</html>
