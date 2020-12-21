@extends('layouts.app')

@section('content')
<div class="container">
<div class="card py-3 text-center"> 
<form  action="{{ url('/upload-file_dropbox') }}" method="post">
@csrf
<div class="form-group">
<input type="file" id="fileinput" name="myfile">
</div>

<button class="btn btn-danger" type="submit">Upload File</button>

</form>


</div>
<br>
<div>
<button class="btn btn-danger" onclick="upload()">Upload File through JQuery</button>

</div>
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
<br>
<div class="container card py-3">

                <div class="row text-center">
                  <div class="col-6">
                  <a class="btn btn-primary btn-sm" href="https://www.dropbox.com/oauth2/authorize?client_id=3ov6oupaxezv61q&response_type=token&redirect_uri=http://localhost:8000/home" >Authorize with your Dropbox Account</a>
                  </div>
                  <div class="col-6">
                  <button class="btn btn-warning btn-sm" onclick="access()">Get Access Token for this user</button>
                  </div>
                </div>
               
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

// let user_id = getUrlParameter('uid');
// let access_token = getUrlParameter('access_token');
// let account_id = getUrlParameter('account_id');
// let token_type = getUrlParameter('token_type');

var link = document.location + '';

var data = link.split("#");
var info = data[1].split("&");

var user_id = info[0].split("=")[1];
var access_token = info[1].split("=")[1];
var token_type = info[3].split("=")[1];
var acc_id = info[5].split("=")[1];
var account_id = acc_id.replace("%", ":");
let _token   = $('meta[name="csrf-token"]').attr('content');

console.log(info);
$.ajax
  ({
    type: "POST",
    url: "{{ route('dropbox_account.store') }}",
    data: {user_id: user_id, access_token:access_token ,account_id:account_id,token_type:token_type, _token: _token },
    success: function (response){
        $("#info").html(response);
    }
});

}

function upload(){
// ... file selected from a file <input>

var access_token = 'sl.Anx6rsOqsPmglaff8hy3ZDCwYp5zhaHO2GCYeWxE2m4QVI0hcPl-et5Y8E0iZMZq7DTHi5hoGEZeQQrvIM1BfMggjWkofOm5qV05JzjhJGsRN04clfuZjDnG_DeyEx7QqzIlKMk';
$.ajax({
    url: 'https://content.dropboxapi.com/2/files/upload',
    type: 'post',
    data: "Nice Testing",
    processData: false,
    contentType: 'application/octet-stream',
    headers: {
        "Authorization": "Bearer 'sl.AnwABqbI4RyEuoTvhbLoHiWFOKIuyhFGklczGYRLB089eSq5zdrRwp03ou0yzvIyEFTWZ1XsjYRGWWxvfC2hbEPLuV8D7cXpQ_aVGPs5vozRlX7KEn5oTVjPYKnWxoSCS2nVms4iEqc'",
        "Dropbox-API-Arg": '{"path": "/test_upload.txt","mode": "add","autorename": true,"mute": false}',
        "Content-Type": 'application/octet-stream'
    },
    success: function (data) {
        console.log(data);
    },
    error: function (data) {
        console.error(data);
    }
})

}
</script>
@endsection

