<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>Select2 Ajax Example</title>

 <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> -->
 <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" /> -->

<link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{asset('select/select2.min.css') }}" />

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4">

                <form>
                    <div class="form-group">
                        <label for="tag_list">Tags:</label>
                        <select id="tag_list" name="tag_list[]" class="form-control" multiple></select>
                    </div>
                    <div class="form-group">
                        <label for="d_list2">Tags:</label>
                        <select id="d_list2" name="disease[]" class="form-control" multiple></select>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script> -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script> -->
     <script src="{{ asset('js/jquery-3.1.1.min.js') }}" type="text/javascript"></script>
     <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
      <script src="{{ asset('select/select2.min.js') }}" type="text/javascript"></script>
    <script>
        $('#tag_list').select2({
            placeholder: "Choose tags...",
            minimumInputLength: 2,
            ajax: {
                url: '/tags/find',
                dataType: 'json',
                data: function (params) {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });

        $('#d_list2').select2({
            placeholder: "Choose tags...",
            minimumInputLength: 2,
            ajax: {
                url: '/disis/find',
                dataType: 'json',
                data: function (params) {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
    </script>
</body>
</html>
