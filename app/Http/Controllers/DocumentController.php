<?php

namespace App\Http\Controllers;

use App\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{

    public function read_many(Request $request){
        $arrCities = Document::where('arch', null)->get();
        return view('Documents.read_documents', ["arr" => $arrCities->toArray()]);
    }

    public function read_one(Request $request, $id){
        $arrCities = Document::where('id', $id)->get()->toJson();
        return $arrCities;
    }

    public function edit_one(Request $request, $id){
        $arrCities = Document::where('id', $id)->get();
        return view('Documents.edit_documents', ["arr" => $arrCities->toArray()]);
    }

    public function show_one(Request $request, $id){
        $arrCities = Document::where('id', $id)->get();
        return view('Documents.document_display', ["document" => $arrCities->toArray()]);
    }

    public function view_one(Request $request, $id){
        $arrCities = Document::where('id', $id)->get();
        return view('Documents.document_view', ["document" => $arrCities->toArray()]);
    }

    public function new_one(){
        return view('Documents.document');
    }


    public function update_one(Request $request){

        $id = $request->id;
        $title=$request->title;
        $detail = $this->do_image_things($request);
        $document = Document::find($id);
        $document->content = $detail;
        $document->title = $title;
        $document->save();
        //return view('Documents.document_display',compact('document'));
        return redirect()->route('documentEdit', ['id' => $id]);
    }


    public function create_one(Request $request){
        $title=$request->title;
        //loop over img elements, decode their base64 src and save them to public folder,
        //and then replace base64 src with stored image URL.
        $detail = $this->do_image_things($request);

        $document = new Document;
        $document->content = $detail;
        $document->title = $title;
        $document->save();
        //return view('Documents.document_display',compact('document'));
        return redirect()->route('documentViewall');
    }

    public function del_one(Request $request, $id){

        $document = Document::find($id);
        $document->arch = 1;
        $document->save();
        return redirect()->route('documentViewall');
    }


    private function do_image_things($request){

        $detail=$request->summernoteInput;
        $dom = new \domdocument();
        $dom->loadHtml('<?xml encoding="UTF-8">' . $detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $detail = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
        $detail .= $dom->saveHTML( $dom->documentElement );
        $images = $dom->getelementsbytagname('img');

        foreach($images as $k => $img){
            //var_dump([$k, $img]);
            if(null !== ($img->getattribute('src'))){
                $data = $img->getattribute('src');
                //var_dump($data);
                if(strpos($data, ";") and strpos($data, ",") ){                
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);

                    $data = base64_decode($data);
                    $image_name= time().$k.'.png';
                    $path = public_path() .'/upload/'. $image_name;

                    file_put_contents($path, $data);

                    $img->removeattribute('src');
                    $img->setattribute('src', '/upload/' . $image_name);
                }
            }
        }

        $detail = $dom->savehtml();
        return $detail;
    }

}
