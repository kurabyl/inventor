<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $details = Detail::all();
        return view('home',[
            'details'=>$details
        ]);
    }

    public function store(Request $request)
    {
        $detail = new Detail;
        $detail->type = $request->type;
        $detail->brand = $request->brand;
        $detail->name = $request->name;
        $detail->serial_number = $request->serial_number;
        $detail->character = $request->character;
        $detail->user_name = $request->user_name;
        $detail->hash = Hash::make(microtime().md5($request->serial_number));
        $detail->save();
        return redirect()->back()->with('success','Успешно добавлено');
    }

    public function scanQrCode(Request $request)
    {
        if ($request->hash == '') exit;
        $detail = Detail::getByHash($request->hash);

        return json_encode([
            'status' => 200,
            'message' => 'Гость найден',
            'link' => ''
        ], JSON_UNESCAPED_UNICODE);
    }
}
