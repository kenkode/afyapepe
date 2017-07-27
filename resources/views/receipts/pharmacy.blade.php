<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pharmacy | Receipt</title>

    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <link href="{{ asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{ asset('css/style.css')}}" rel="stylesheet">

</head>

<body class="white-bg">
                <div class="wrapper wrapper-content p-xl">
                    <div class="ibox-content p-xl">
                            <div class="row">
                                <div class="col-sm-6">
                                     <address>
                                        <strong>{{$receipt->fname}} {{$receipt->sname}}</strong><br>
                                        
                                        {{$receipt->phone}}<br>
                                        <abbr title="Phone">Phone:</abbr> {{$receipt->email}}
                                    </address>
                                </div>

                                <div class="col-sm-6 text-right">
                                    <h4>Receipt No.</h4>
                                    <h4 class="text-navy">{{$number}}</h4>
                                   
                                    <address>
                                        <strong>{{$receipt->pname}}</strong><br>
                                        {{$receipt->pcounty}}<br>
                                        {{$receipt->ptown}}<br>
                                        
                                    </address>
                                    <p>
                                        
                                        <span><strong>Date:</strong> {{$dys}}</span>
                                    </p>
                                </div>
                            </div>

                            <div class="table-responsive m-t">
                                <table class="table invoice-table">
                                    <thead>
                                    <tr>
                                        <th>Details</th>
                                        <th>Dose</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>

                                        <th>Total Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{$manufacturer->drugname}}</td>

                                        
                                        <td>{{$receipt->dose}}</td>
                                        <td>{{$receipt->quantity}}</td>
                                        <td>{{$receipt->price}}</td>
                                        <td>{{$receipt->total}}</td>
                                    </tr>
                                    
                                    

                                    </tbody>
                                </table>
                            </div><!-- /table-responsive -->

                            <table class="table invoice-total">
                                <tbody>
                                
                                <tr>
                                    <td><strong>TOTAL :</strong></td>
                                   <td>{{$receipt->total}}</td>
                                </tr>
                                </tbody>
                            </table>
                            
                        </div>

    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('js/inspinia.js')}}"></script>

    <script type="text/javascript">
        window.print();
    </script>

</body>

</html>