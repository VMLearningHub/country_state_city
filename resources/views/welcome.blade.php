<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

    <title>Document</title>
</head>
<body>
    <div id="login">
        <h3 class="text-center text-white pt-5">Login form</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-info">Country State City</h3>
                            <div class="form-group">
                                <label for="city" class="text-info">Select city:</label><br>
                                <select name="city" id="city" class="form-control">
                                    
                                </select>
                            </div>
                           
                           
                           
                            <button type="submit" class="btn btn-secondary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    // In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    //$('#city').select2();
    $("#city").select2({
                placeholder: "Select City",
                minimumInputLength: 2,
                templateResult: formatState,
                ajax: {
                    url: "{{ route('citywithstatecountry') }}",
                    dataType: 'json',
                    type: "POST",

                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: function(term) {
                        return {
                            term: term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.name + ', ' + item.district.name + ', ' + item.district.state.name + ', ' + item.district.state.country.name,
                                    id: item.id,
                                    contryflage: item.district.state.country.flage
                                }
                            })
                        };
                    }
                }
            });

            function formatState(state) {
                if (!state.id) {
                    return state.text;
                }
                var baseUrl = "{{ URL::asset('/assets/images/flags') }}";
                var $state = $(
                    '<span><img src="' + baseUrl + '/' + state.contryflage.toLowerCase() +
                    '.png"  class="img-flag" /> ' + state.text + '</span>'
                );
                return $state;
            }
});
</script>
</html>