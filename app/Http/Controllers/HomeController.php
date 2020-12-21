<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\Dropbox;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function store_account_details(Request $request){

//  dd($request->access_token);
       $user_id = Auth::user()->id;
      $drop_account = new Dropbox();
      $drop_account->user_id = $user_id;
      $drop_account->dropbox_uid = $request->user_id;
      $drop_account->access_token = $request->access_token;
      $drop_account->drop_acc_id = $request->account_id;
      $drop_account->token_type = $request->token_type;
      $drop_account->save();
     
      return response()->json($drop_account);


    }

    public function upload(Request $request){
       ('file.jpg');
        // dd($request->all());
        $path = public_path('img/test.docx');
        // dd($path);
$fp = fopen($path, 'rb');
$size = filesize($path);

$cheaders = array('Authorization: Bearer sl.AnwqF2tn2dNMdZYvufiq_NLdXahWsqUTBUEqncGOeviEz6OvjsMIfwPqffCDHFXkjISy6qcq06Bor_lWrOeyMfZ7IN0qPXdCf36zQRWuF3Vf_uwzrihgNemK9tj4VKxxAafCp04HNBk',
                  'Content-Type: application/octet-stream',
                  'Dropbox-API-Arg: {"path":"/mashfiq/'.$path.'", "mode":"add"}');

$ch = curl_init('https://content.dropboxapi.com/2/files/upload');
curl_setopt($ch, CURLOPT_HTTPHEADER, $cheaders);
curl_setopt($ch, CURLOPT_PUT, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_INFILE, $fp);
curl_setopt($ch, CURLOPT_INFILESIZE, $size);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);

echo $response;
curl_close($ch);
fclose($fp);
    }
}
