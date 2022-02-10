<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App;
use Excel;
use File;
use Zip;
use ZipArchive;
class ExcelController extends Controller
{
    public function home(){
        return view('home');
    }
        public function excel(Request $request){
            $file = $request->excel;

            // Random name for the excel file
            $fileName = rand().".xlsx";

            // Random name for the folder that contains all the pdf files
            $pdfTempFolder = rand();

            // Put the excel file in storage/app/uploads/excel
            $filePath = $request->file('excel')->storeAs('uploads/excel', $fileName);

            // import the excel file and convert it to an array
            $names = Excel::toArray(new UsersImport, storage_path('app/uploads/excel/'.$fileName));

            // count the total names in the array
            $count = count($names[0][0]);

            // Store the pdf files with each name
            for ($i=0; $i < $count; $i++) {
                $snappy = App::make('snappy.pdf.wrapper');
                $snappy->loadHTML(view('certificate', compact('names', 'i')));
                Storage::put('uploads/pdfs/'.$pdfTempFolder.'/'.$names[0][0][$i]. '.' . 'pdf', $snappy->output());
            }

            // Download the zip file
            $zip = new ZipArchive;
            $zipName = rand().'.zip';
            if($zip->open(storage_path('app/zipFiles/'.$zipName), ZipArchive::CREATE) === TRUE){
                $files = \File::files(storage_path('app/uploads/pdfs/'.$pdfTempFolder));
                foreach ($files as $key => $value) {
                    # code...
                    $relative = basename($value);
                    $zip->addFile($value,$relative);
                }
                $zip->close();
            }
            return response()->download(storage_path('app/zipFiles/'.$zipName));
     }

}

