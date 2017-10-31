<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrcodeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        return view('qrcodeImportExport');
    }
    public function importExport()
    {
        return view('qrcodeImportExport');
    }
    public function downloadExcel($type)
    {
        $data = Item::get()->toArray();
        return Excel::create('itsolutionstuff_example', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }
    public function importExcel(Request $request)
    {
        if( $request->import_file){
            $path = $request->import_file->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();
            $html = "";
            if(!empty($data) && $data->count()){
                // foreach ($data as $key => $value) {
                //     $insert[] = ['title' => $value->title, 'description' => $value->description];
                // }
                foreach ($data as $key => $value) {
                    $img = base64_encode(QrCode::format("png")->merge(url("/logo.png"), .15, true)->size(100)->generate($value->title));
                    $html = $html.'<div class="item">';
                    $html = $html.'        <p><img src="data:image/png;base64,'.$img .'"></p>';  
                    $html = $html.'    <p class="text">'.$value->description.'</p>';
                    $html = $html.'</div>';
                }
            }
        }
        // Tạo và download file PDF]
        $this->PDF = app('PDF');
        $this->PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $this->PDF::loadHTML($html)->setPaper('a4', 'landscape')->setWarnings(false)->save('public/pdf/myfile.pdf');
        echo url('public/pdf/myfile.pdf');
        return view('qrcodeExportExcel', ['data' => $data]);
    }
}
