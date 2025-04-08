<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inovasi;
use App\Models\DBPerhubungan;
use App\Models\Pengaturan;
use App\Models\Menu;
use Illuminate\Pagination\Paginator;

class InovasiController extends Controller
{
    protected $inovasi;
    protected $route = 'home.pages.inovasi.';
    public function __construct(){
        $this->route = "home.inovasi.";
        $this->view = "home.pages.inovasi.";
        $this->inovasi = new inovasi();
        Paginator::useBootstrap();
    }
   
    public function index(Request $request)
    {
        $table_pengaturan = Pengaturan::first();
        $table_menu = Menu::all();
    
        $search = $request->search;
    
        // Default: kosongkan
        $table = collect();
        $rfid = collect();
    
        if (!empty($search)) {
            $data = \App\Models\DBPerhubungan::where('nouji', $search)->first();
    
            if ($data && $data->vcode) {
                return redirect()->away("https://ujiberkala-dstj.kemenhub.go.id/qr/v1/rfid/" . $data->vcode);
            } else {
                return redirect()->route('home.inovasi.index')->with('error', 'Data tidak ditemukan');
            }
        }
    
        return view($this->view . "index", [
            'table_pengaturan' => \App\Models\Pengaturan::first(),
            'table_menu' => \App\Models\Menu::all(),
        ]);
    }        
    
    public function show($id){
        $table_pengaturan = Pengaturan::first();
        $table_menu = Menu::all();

        $result = $this->inovasi;
        $result = $result->where('id',$id);
        $result = $result->first();

        $except_result = $this->inovasi;
        $except_result = $except_result->where('id','!=',$id);
        $except_result = $except_result->orderBy("date","DESC");      //sort descending by time created data
        $except_result = $except_result->paginate(3);   //limit paginate only 10 data appears per load

        if(!$result){
            alert()->error('Gagal',"Data tidak ditemukan");
            return redirect()->route($this->route."index");
        }

        $data = [
            'result' => $result,
            'except_result' => $except_result,
            'table_pengaturan' => $table_pengaturan,
            'table_menu' => $table_menu,
        ];

        return view($this->view."show",$data);
    }
}
