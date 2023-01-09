@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Dashboard<span id="msg" class="text-info"></span>
                    @if(session("success_msg"))
                        <span class="text-success">{{session("success_msg")}}</span>
                    @endif
                    @if(session("error_msg"))
                        <span class="text-danger">{{session("error_msg")}}</span>
                    @endif
                </div>
                <div class="card-body">
                    <a class="btn btn-primary2 mb-2" data-bs-toggle="modal" data-bs-target="#addExampleModal">
                        Add Employee
                    </a>
                    <a class="btn btn-primary2 mb-2" data-bs-toggle="modal" data-bs-target="#imageUploadModal">
                        Upload Image
                    </a>
                    <a href="/read-file" class="btn btn-primary2 mb-2">
                        Check XML Data
                    </a>
                    <a href="/read-file" class="btn btn-primary2 mb-2" data-bs-toggle="modal" data-bs-target="#employeeModal">
                        All Employees
                    </a>
                    <div>
                        <form>
                            @csrf
                            <input type="number" name="id" class="form-control" placeholder="enter employee id" id="employeeId">
                            <button class="btn btn-primary2 mt-2 get-detail" type="button">Get Details</button>
                        </form>
                        <div id="showData" class="d-none">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td id="name"></td>
                                        <td id="email"></td>
                                        <td id="phone"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card card-body mt-3">
                @if($images->count()>0)
                    @foreach($images as $image)
                    <div class="mt-2">
                        <img src="{{asset('assets/images/').'/'.$image->name}}" height="30px" width="30px">
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addExampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Register Employee</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form autocomplete="off" id="registerForm">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text"  name="firstname" value="{{ old('firstname') }}" class="form-control border-top-0 border-start-0 border-end-0 @error('firstname') is-invalid @enderror" id="firstname" placeholder="firstname@example.com" required>
                            <label for="firstname">First Name</label> 
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text"  name="lastname" value="{{ old('lastname') }}" class="form-control border-top-0 border-start-0 border-end-0 @error('lastname') is-invalid @enderror" id="lastname" placeholder="lastname@example.com" required>
                            <label for="lastname">Last Name</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating mb-2">
                            <input type="email"  name="email" value="{{ old('email') }}" class="form-control border-top-0 border-start-0 border-end-0 @error('email') is-invalid @enderror" id="email" placeholder="email@example.com" required>
                            <label for="email">Email</label>
                            
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating mb-2">
                            <input type="number"  name="phone" value="{{ old('phone') }}" class="form-control border-top-0 border-start-0 border-end-0 @error('phone') is-invalid @enderror" id="phone" placeholder="phone@example.com" required>
                            <label for="phone">Phone</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating mb-2">
                            <input type="password"  name="password" value="{{ old('password') }}" class="form-control border-top-0 border-start-0 border-end-0 @error('password') is-invalid @enderror" id="password" placeholder="pasword@example.com" required>
                            <label for="password">Password</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating mb-2">
                            <input type="password"  name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control border-top-0 border-start-0 border-end-0 @error('password_confirmation') is-invalid @enderror" id="confirmpassword" placeholder="conpassword@example.com" required>
                            <label for="confirmpassword">Confirm Password</label>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <label class="float-end btn" style="margin-top:-32px">
                        <svg viewBox="0 0 640 512" class="svg-20 fill-primary" id="show-password"><path d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L525.6 386.7c39.6-40.6 66.4-86.1 79.9-118.4c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C465.5 68.8 400.8 32 320 32c-68.2 0-125 26.3-169.3 60.8L38.8 5.1zM223.1 149.5C248.6 126.2 282.7 112 320 112c79.5 0 144 64.5 144 144c0 24.9-6.3 48.3-17.4 68.7L408 294.5c5.2-11.8 8-24.8 8-38.5c0-53-43-96-96-96c-2.8 0-5.6 .1-8.4 .4c5.3 9.3 8.4 20.1 8.4 31.6c0 10.2-2.4 19.8-6.6 28.3l-90.3-70.8zm223.1 298L373 389.9c-16.4 6.5-34.3 10.1-53 10.1c-79.5 0-144-64.5-144-144c0-6.9 .5-13.6 1.4-20.2L83.1 161.5C60.3 191.2 44 220.8 34.5 243.7c-3.3 7.9-3.3 16.7 0 24.6c14.9 35.7 46.2 87.7 93 131.1C174.5 443.2 239.2 480 320 480c47.8 0 89.9-12.9 126.2-32.5z"/></svg>
                        <svg viewBox="0 0 576 512" class="svg-20 fill-primary d-none" id="hide-password"><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM432 256c0 79.5-64.5 144-144 144s-144-64.5-144-144s64.5-144 144-144s144 64.5 144 144zM288 192c0 35.3-28.7 64-64 64c-11.5 0-22.3-3-31.6-8.4c-.2 2.8-.4 5.5-.4 8.4c0 53 43 96 96 96s96-43 96-96s-43-96-96-96c-2.8 0-5.6 .1-8.4 .4c5.3 9.3 8.4 20.1 8.4 31.6z"/></svg>
                        </label>
                    </div>
                </div>

    
                <button class="btn btn-lg btn-primary2 submit-btn" type="button">Submit</button>
    
                <hr class="my-4">
                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="imageUploadModal" tabindex="-1" aria-labelledby="imageUploadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                Upload Image
            </div>
            <div class="modal-body">
                <form action="{{route('upload-image')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="image" class="form-controll">
                    <button class="btn btn-primary2">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="employeeModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                Employees
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>name</th>
                            <th>email</th>
                            <th>phone</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($employees->count()>0)
                            @foreach ($employees as $employee)
                                <tr>
                                    <td>{{$employee->id}}</td>
                                    <td>{{$employee->firstname.' '.$employee->lastname}}</td>
                                    <td>{{$employee->email}}</td>
                                    <td>{{$employee->phone}}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(".get-detail").click(function(e){
        e.preventDefault();
        let employeeId=document.getElementById('employeeId').value; 
        $.ajax({
            url: "http://localhost:8000/api/get-employee-data/"+employeeId,
            type: "get",
            headers: { Authorization: 'Bearer '+localStorage.getItem("access_token") },
            success: function(data) {
                console.log(data);
                if(data.status==200){
                    $('#showData').removeClass('d-none');
                    $('#name').text(data.data.firstname+' '+data.data.lastname);
                    $('#email').text(data.data.email);
                    $('#phone').text(data.data.phone);
                    $('#msg').text('');
                }else{
                    $('#showData').addClass('d-none');
                    $('#msg').text('data not found');
                }
            }
        });
    })
    
</script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".submit-btn").click(function(e){
        
        e.preventDefault();

        var formData=$('#registerForm').serialize();
        console.log(formData);
        
        $.ajax({
           type:'POST',
           url:"{{ route('auth.register') }}",
           data:$('#registerForm').serialize(),
           success:function(res){
                console.log(res);
                if($.isEmptyObject(res.error)){
                    alert(res.msg);
                    location.reload();
                }else{
                    printErrorMsg(res.error);
                }
           }
        });

    });

    function printErrorMsg (msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');
        $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
        });
    }
</script>
@endsection
