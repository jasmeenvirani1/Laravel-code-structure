@extends('admin.partial.app')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row" style="margin-top: 0%;margin-bottom: -2%;">
      <div class="col-sm-2" style="margin-right: 0%;">
        <h1>Profile</h1>
      </div>
      <div class="col-sm-8 mt-3" style="margin-bottom: 3%;">
      </div>
      <div class="col-sm-2">
        <ol class="breadcrumb float-sm-right" style="margin-top: 3%;">
          <li class="breadcrumb-item"><a href="https://localhost/service_management/admin/Dashboard">Home</a></li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle" src="{{asset('dist/img/user2-160x160.jpg')}}" alt="User profile picture">
            </div>
            <h3 class="profile-username text-center">{{ ucfirst($user_detail->name)}}</h3>
            <p class="text-muted text-center"></p>
            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Name</b> <a class="float-right">{{$user_detail->name}}</a>
              </li>
              <li class="list-group-item">
                <b>Mobile</b> <a class="float-right">{{$user_detail->mobile}}</a>
              </li>
              <li class="list-group-item">
                <b>Role</b> <a class="float-right">{{GetName('get_user_role',$user_detail->role_id)}}</a>
              </li>
            </ul>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- About Me Box -->

        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">

              <li class="nav-item"><a class="nav-link" href="#changepassword" data-toggle="tab">Update Profile</a></li>
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <!-- /.tab-pane -->
              <div class="active tab-pane" id="changepassword">
                <form class="form-horizontal" method="post" action="@if(isset($user_detail)){{ route('view.profile',array('id'=>$user_detail->id)) }} @endif">
                  @csrf
                  <div class="form-group row ">
                    <label for="exampleInputEmail1" class="col-sm-2 col-form-label">User Name</label>
                    <div class="col-sm-4">
                      <input name="name" type="text" id="name" value="{{{ old('name', isset($user_detail) ? $user_detail->name : null) }}}" class="form-control @error('name') is-invalid @enderror" placeholder="Enter User Name" readonly />
                      @error('name')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                    </div>
                    <label for="exampleInputEmail1" class="col-sm-2 col-form-label">Mobile</label>
                    <div class="col-sm-4">
                      <input name="mobile" type="tel" id="mobile" value="{{{ old('mobile', isset($user_detail) ? $user_detail->mobile : null) }}}" class="form-control @error('mobile') is-invalid @enderror" placeholder="Enter Mobile" />
                      @error('mobile')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                    </div>
                  </div>
                  <div class="form-group row ">
                    <label for="exampleInputEmail1" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-4">
                      <input name="email" type="email" id="email" value="{{{ old('email', isset($user_detail) ? $user_detail->email : null) }}}" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Email" />
                      @error('email')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                    </div>

                    <label for="password" class="col-sm-2 col-form-label">New Password</label>
                    <div class="col-sm-4">
                      <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" id="new_password" placeholder="New Password">
                      @if ($errors->has('new_password')) <div class="invalid-feedback">{{ $errors->first('new_password') }}</div>@endif
                    </div>
                  </div>
                  <div class="form-group row">

                    <div class="offset-sm-2 col-sm-10  mt-3">
                      <button type="submit " class="btn btn-danger">Update</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
    </div>

    <!-- /.row -->
    @if (session('UserSession.role_id') === 2)
    @if(isset($Users_list))
    <div class="card-header">
      <h3 class="card-title">User List</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>User Name</th>
            <th>E-Mail</th>
            <th>Mobile</th>
            <th>Role</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($Users_list as $list)
          <tr>
            <td>{{$list->name}}</td>
            <td>{{$list->email}}</td>
            <td>{{$list->mobile}}</td>
            <td>{{ GetName('get_user_role',$list->role_id)}}</td>
            <td id="$list->id">
              <a id="MainContent_LinkButton5" href="{{ route('view.profile',array('id'=>$list->id)) }}"><i class="fas fa-edit"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

    </div>
    @endif
    @endif
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection