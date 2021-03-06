<?php

namespace App\Http\Controllers;

use App\Models\Outfit;
use Illuminate\Http\Request;
use App\Models\Master;
use Validator;
use PDF;

class OutfitController extends Controller
{

    const RESULTS_IN_PAGE = 9;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        
        $masters = Master::orderBy('surname')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
        if ($request->sort) {
            if ('size' == $request->sort && 'asc' == $request->sortDir) {
               $outfits = Outfit::orderBy('size')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
            }
            if ('size' == $request->sort && 'desc' == $request->sortDir) {
               $outfits = Outfit::orderBy('size', 'desc')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
            }
            if ('color' == $request->sort && 'asc' == $request->sortDir) {
               $outfits = Outfit::orderBy('color')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
            }
            if ('color' == $request->sort && 'desc' == $request->sortDir) {
               $outfits = Outfit::orderBy('color', 'desc')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
            }
            if ('type' == $request->sort && 'asc' == $request->sortDir) {
               $outfits = Outfit::orderBy('type')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
            }
            if ('type' == $request->sort && 'desc' == $request->sortDir) {
               $outfits = Outfit::orderBy('type', 'desc')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
            }
            else {
              $outfits = Outfit::all();
            }
        }
        else if($request->filter && 'master' == $request->filter) {
            $outfits = Outfit::Where('master_id', $request->master_id)->paginate(self::RESULTS_IN_PAGE)->withQueryString();
        }
        else if($request->search && 'all' == $request->search) {
            $outfits = Outfit::Where('color', 'like', '%'.$request->s.'%')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
        }
            else {
                $outfits = Outfit::orderBy('created_at', 'desc')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
            }
        
        
        return view('outfit.index', ['outfits' => $outfits,
        'sortDir' => $request->sortDir,
        'masters' => $masters,
        'master_id' => $request->master_id ?? '0'
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $masters = Master::all();
        return view('outfit.create', ['masters' => $masters]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),
       [
           'outfit_type' => ['required', 'min:3', 'max:50'],
           'outfit_color' => ['required', 'min:3', 'max:20'],
           'outfit_size' => ['required', 'integer', 'min:5' ,'max:21'],
           'outfit_about' => ['required'],
           'master_id' => ['required', 'integer','min:1'],
           'outfit_photo' => ['sometimes', 'image']

       ]

       );
       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }

        $outfit = new Outfit;

       $file = $request->file('outfit_photo');

       if ($file) {
            $ext = $file->getClientOriginalExtension();
            $name = rand(1000000, 9999999).'_'.rand(1000000, 9999999);
            $name = $name.'.'.$ext;
            $destinationPath = public_path().'/img/';
            $file->move($destinationPath, $name);
            $outfit->photo = asset('/img/'.$name);

       }



        $outfit->type = $request->outfit_type;
        $outfit->color = $request->outfit_color;
        $outfit->size = $request->outfit_size;
        $outfit->about = $request->outfit_about;
        $outfit->master_id = $request->master_id;

        $outfit->save();
        return redirect()
        ->route('outfit.index')
        ->with('success_message', 'New outfit.');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Outfit  $outfit
     * @return \Illuminate\Http\Response
     */
    public function show(Outfit $outfit)
    {
        return view('outfit.show', ['outfit' => $outfit]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Outfit  $outfit
     * @return \Illuminate\Http\Response
     */
    public function edit(Outfit $outfit)
    {
        $masters = Master::all();
       return view('outfit.edit', ['outfit' => $outfit, 'masters' => $masters]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Outfit  $outfit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Outfit $outfit)
    {

        $validator = Validator::make($request->all(),
       [
           'outfit_type' => ['required', 'min:3', 'max:50'],
           'outfit_color' => ['required', 'min:3', 'max:20'],
           'outfit_size' => ['required', 'integer', 'min:5' ,'max:21'],
           'outfit_about' => ['required'],
           'master_id' => ['required', 'integer','min:1'],
           'outfit_photo' => ['sometimes', 'image']

       ]

       );
       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }


$file = $request->file('outfit_photo');
       if ($file) {
           $ext = $file->getClientOriginalExtension();
           $name = rand(1000000, 9999999).'_'.rand(1000000, 9999999);
           $name = $name.'.'.$ext;
           $destinationPath = public_path().'/img/';
           $file->move($destinationPath, $name);

            $oldPhoto = $outfit->photo ?? '###';
            $outfit->photo = asset('/img/'.$name);

            $oldName = explode('/', $oldPhoto);
            $oldName = array_pop($oldName);

             if (file_exists($destinationPath.$oldName)){
                 unlink($destinationPath.$oldName);
            }
       }

        if ($request->outfit_photo_delete) { 
            $destinationPath = public_path().'/img/';
            $oldPhoto = $outfit->photo ?? '###';
            $outfit->photo = null;

            $oldName = explode('/', $oldPhoto);
            $oldName = array_pop($oldName);
             if (file_exists($destinationPath.$oldName)){
                 unlink($destinationPath.$oldName);
            }
             
         }

        $outfit->type = $request->outfit_type;
        $outfit->color = $request->outfit_color;
        $outfit->size = $request->outfit_size;
        $outfit->about = $request->outfit_about;
        $outfit->master_id = $request->master_id;
        $outfit->save();
        return redirect()->route('outfit.index')->with('success_message', 'Outfit was updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Outfit  $outfit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outfit $outfit)
    {

        $destinationPath = public_path().'/img/';
        $oldPhoto = $outfit->photo ?? '###';
        $outfit->photo = null;

        $oldName = explode('/', $oldPhoto);
        $oldName = array_pop($oldName);
            if (file_exists($destinationPath.$oldName)){
                unlink($destinationPath.$oldName);
        }
        $outfit->delete();
        return redirect()->route('outfit.index')->with('success_message', 'Outfit was deleted.');

    }

    public function pdf(Outfit $outfit) {
            $pdf = PDF::loadView('outfit.pdf', [ 'outfit' =>$outfit]);
            return $pdf->download($outfit->type.'-'.$outfit->color.'.pdf');
    }
}
