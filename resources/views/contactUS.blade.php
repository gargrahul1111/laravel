<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <div class="row">
                            <div class="col-md-10">
                                <strong>Contact us </strong>
                            </div>

                        </div>
                        
                    </div>
                    <div class="panel-body">
                       <div class="row">
                        <div class="col-md-12">
                           @if(Session::has('success'))
                           <div class="alert alert-success">
                             {{ Session::get('success') }}
                         </div>
                         @endif
                     </div>
                 </div>
                 
                 <form method="post" action="{{route('contactus.store')}}">
                    <div class="form-group  {{ $errors->has('name') ? 'has-error' : '' }}">
                        <input type="hidden" value="{{csrf_token()}}" name="_token" />
                        <label for="title">name:</label>
                        <input type="text" class="form-control" name="name"/>
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>

                    <div class="form-group  {{ $errors->has('email') ? 'has-error' : '' }}">              
                        <label for="title">Email:</label>
                        <input type="text" class="form-control" name="email"/>
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    </div>

                    <div class="form-group  {{ $errors->has('message') ? 'has-error' : '' }}">
                        <label for="message">Message:</label>
                        <textarea cols="5" rows="5" class="form-control" name="message"></textarea>
                        <span class="text-danger">{{ $errors->first('message') }}</span>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

                
            </div>
        </div>

    </div>
</div>
</div>
</body>
</html>




