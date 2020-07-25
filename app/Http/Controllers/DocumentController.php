<?php

namespace App\Http\Controllers;

use App\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{

    public function read_many(Request $request){
        $arrCities = Document::get();
        return view('Documents.read_documents', ["arr" => $arrCities->toArray()]);
    }

    public function read_one(Request $request, $id){
        $arrCities = Document::where('id', $id)->get()->toJson();
        return $arrCities;
    }

    public function new_one(){
        return view('Documents.document');
    }

    public function create_one(Request $request)
    {
        $detail=$request->summernoteInput;
        $dom = new \domdocument();
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getelementsbytagname('img');

        //loop over img elements, decode their base64 src and save them to public folder,
        //and then replace base64 src with stored image URL.
        foreach($images as $k => $img){
            $data = $img->getattribute('src');

            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);

            $data = base64_decode($data);
            $image_name= time().$k.'.png';
            $path = public_path() .'/upload/'. $image_name;

            file_put_contents($path, $data);

            $img->removeattribute('src');
            $img->setattribute('src', 'upload/' . $image_name);
        }

        $detail = $dom->savehtml();
        $document = new Document;
        $document->content = $detail;
        $document->save();
        return view('Documents.document_display',compact('document'));
    }


}
