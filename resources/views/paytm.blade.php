<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet"> -->
    
</head>

<body>
<div class="conatiner">
    <div class="row">
        <div class="col-md-4 mx-auto"> <h3 class="text-center py-3">Users paytm</h3></div>
    </div>
</div>  
   
    <!-- @yield('payment_redirect') -->


 @foreach (['danger', 'warning', 'success', 'info'] as $key)
    @if(Session::has($key))
     <p class="alert alert-{{ $key }}">{{ Session::get($key) }}</p>
    @endif
@endforeach

<div class="contrainer">
<div class="row">
<div class="col-md-4 mx-auto">
<div class="card shadow">
<div class="card-body">
    <form action="{{ url('payment') }}" method="POST" enctype="multipart/form-data">
    
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> Something went wrong<br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <strong>Name</strong>
                <input class="form-control" type="text" name="name"  placeholder="Enter Name">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <strong>Mobile Number</strong>
                <input class="form-control" type="text" name="phonenumber"  placeholder="Enter Mobile Number">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <strong>Email Id</strong>
                <input class="form-control" type="text" name="email"  placeholder="Enter Email id">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <strong>Event Fees</strong>
                <input class="form-control" type="text" name="amount" placeholder="" value="50">
            </div>
        </div>
        <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    
    </form>
    </div>
</div></div></div>
    </div>


</body>
</html>