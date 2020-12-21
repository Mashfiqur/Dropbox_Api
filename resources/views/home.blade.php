@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
               
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>

               
            </div>

            
        </div>
    </div>
</div>
<div class="container card py-3">
                <a class="btn btn-primary" href="https://www.dropbox.com/oauth2/authorize?client_id=3ov6oupaxezv61q&response_type=code&redirect_uri=http://localhost:8000/home" >Authorize with your Dropbox Account</a>
</div>

<div class="container card">
<!-- <form action="{{ url('/user_account')}}" method="POST">
@csrf -->
<button class="btn btn-warning" onclick="access()"><i class="glyphicon glyphicon-remove"></i>Get Access Token for this user</button>

<!-- </form> -->

</div>

<br>
<div class="container card py-5" id="info"></div>
@endsection

@section('js')
<script>

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};

function access(){

var c = getUrlParameter('code');
function make_base_auth(user, password) {
  var tok = user + ':' + password;
  var hash = btoa(tok);
  return "Basic " + hash;
}
$.ajax
  ({
    type: "POST",
    url: "https://api.dropbox.com/oauth2/token",
    dataType: 'json',
    async: false,
    data: {code: c, grant_type:'authorization_code',redirect_uri:'http://localhost:8000/home'},
    beforeSend: function (xhr){ 
        xhr.setRequestHeader('Authorization', make_base_auth('3ov6oupaxezv61q','pr0fuao3nn4fe2a')); 
    },
    success: function (){
        $("#info").html(response);
    }
});


// $.post('https://api.dropbox.com/oauth2/token', {code: c, grant_type:'authorization_code',redirect_uri:'http://localhost:8000/home'}).done(function(response){
//       alert("success");
//       $("#info").html(response);
// });
}

</script>
@endsection

