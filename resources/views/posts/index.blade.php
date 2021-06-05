@include('layouts.app')
@php
use Carbon\Carbon;
$date=Carbon::Now();
@endphp
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>User Records </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success text-light" data-toggle="modal" id="mediumButton" data-target="#mediumModal"
                   data-attr="" title="Create a project"> <i class="fas fa-plus-circle"></i> Add
                </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered table-responsive-lg table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Avatar</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Experience</th>
            <th></th>

        </tr>
        </thead>
        <tbody>
        @forelse($posts as $post)
            <tr>
                <td><img class=" rounded-circle"
                         src="{{ asset('public/images')}}/{{$post->avatar}}"
                         alt="Image" width="80" height="80"> </td>
                <td>{{$post->name}}</td>
                <td>{{$post->email}}</td>
                @if($post->still_working = null)
                <td>{{Carbon::createFromDate($post->joining)->diff($post->leaving)->format('%y years, %m months and %d days')}}</td>
                @else
                    <td>{{Carbon::createFromDate($post->joining)->diff($post->still_working)->format('%y years, %m months and %d days')}}</td>
                @endif
                    <td><a href="{{url('delete/'.$post->id)}}" class="text-secondary" onclick="return confirm('Are you sure you want to delete?')" ><i class="fas fa-times text-gray-300"></i> Remove</a>
                </td>
            </tr>
            @empty
        <h3>No Posts</h3>
            @endforelse

        </tbody>
    </table>

    <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if (session()->has('success'))
                    <h1>{{ session('success') }}</h1>
                @endif
                <div class="modal-body" id="mediumBody">
                    <form action="{{route('userManagement.store')}}" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <!-- the result to be displayed apply here -->
                       <label >Email:</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter Email" required>
                        <label>Full Name:</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter Full Name" required>
                        <label>Joing Date:</label>
                        <input type="date" id="join" name="joining" class="form-control" placeholder="Enter Join Date" required>
                        <label>Leaving Date:</label>
                        <input type="date" id="leave" name="leaving" class="form-control" placeholder="Enter Leave Date" >
                        <input type="checkbox" id="leave" name="still_working" value="{{$date}}"><span>Still Working</span><br/>
                        <label>Image:</label>
                        <input type="file" id="image" name="avatar" class="form-control" placeholder="Upload Image" required>
                    </div>
                   <center> <input type="submit" class="btn btn-primary" value="Save"></center>
                    </form>
                </div>
            </div>
        </div>
    </div>



