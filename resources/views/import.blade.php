<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <title>Wren CSV files</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <div class="content container">
                <div class="title m-b-md">
                    <div class="card-body">
                        @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{session('status')}}
                        </div>
                        @endif
                        @if (isset($errors) && $errors->any())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $e)
                                {{$e}}
                                @endforeach
                            </div>
                        @endif
                        @if(session()->has('failures'))
                            <table class="table table-danger">
                                <tr>
                                    <th>Row</th><th>Attribute</th><th>Errors</th><th>Values</th>
                                </tr>
                                @foreach(session()->get('failures') as $fail)
                                <tr>
                                    <td>{{ $fail->row() }}</td><td>{{ $fail->attribute() }}</td>
                                    <td>
                                        <ul>
                                            @foreach($fail->errors() as $err)
                                                <li>{{$err}}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ $fail->values()[$fail->attribute()]}}</td>
                                </tr>
                                @endforeach

                            </table>
                        @endif
                        <div class="card">
                            <div class="card-header text-center bg-primary text-white">
                              Import and Export CSV files
                            </div>
                            <div class="card-body">
                                
                                <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="csv" class="form-control">
                                    <br>
                                    <div class="text-center">
                                    <button class="btn btn-success">Import Stock Data</button>
                                    <a class="btn btn-warning" href="{{ route('export') }}">Export Stock Data</a>
                                    </div>
                                </form>
                                <div class="float-sm-right">
                                <a class="btn btn-danger " href="{{ route('delete') }}">Delete All Stock Data</a>
                                </div>
                                <table class="table table-responsive table-striped pt-4">
                                    <tr>
                                        <th>#</th><th>Product Code</th><th>Product Name</th><th>Product Description</th>
                                        <th>Stock</th><th>Cost</th><th>Discounted</th><th>Date Added</th><th>Date Discounted</th>
                                        <th>Created At</th><th>Updated At</th>
                                    </tr>
                                    @foreach($stocks as $stock)
                                    <tr>
                                        <td>{{ $stock->productDataId}}</td><td>{{ $stock->productCode }}</td>
                                        <td>{{ $stock->productName }}</td><td>{{ $stock->productDescription }}</td>
                                        <td>{{ $stock->stock }}</td><td>{{ $stock->costInGbp }}</td>
                                        <td>{{ $stock->discontinued }}</td><td>{{ date('d-m-Y H:i', strtotime($stock->dtmAdded)) }}</td>
                                        <td>{{ date('d-m-Y H:i', strtotime($stock->dtmDiscontinued)) }}</td><td>{{ date('d-m-Y H:i', strtotime($stock->created_at)) }}</td>
                                        <td>{{ date('d-m-Y H:i', strtotime($stock->updated_at)) }}</td>
                                        
                                    </tr>
                                    @endforeach
    
                                </table>
                            </div>
                          </div>
                        
                    </div>
                </div>

               
            </div>
        </div>
    </body>
</html>
