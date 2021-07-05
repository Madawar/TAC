<?php

namespace App\Http\Controllers;

use App\Models\Carrier;
use Illuminate\Http\Request;
use Image;

class CarrierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $carriers = Carrier::paginate();
        return view('carrier.view_carriers')->with(compact('carriers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $carrier = null;

        return view('carrier.create_carrier')->with(compact('carrier'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'carrier_email' => 'email',
            'carrier_code' => 'required|max:4',
            'logo' => 'file',
            'carrier_name' => 'required|min:3',
        ]);
        $data['logo'] = $this->saveImage($request, 'logo', $data['carrier_code']);
        $carrier = Carrier::create($data);
        return redirect()->route('carrier.show_carrier', ['id' => $carrier->id]);
    }

    public function saveImage($request, $ffname, $filename_rename)
    {
        $filenamewithextension = $request->file($ffname)->getClientOriginalName();

        //get filename without extension
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

        //get file extension
        $extension = $request->file($ffname)->getClientOriginalExtension();

        //filename to store
        $filenametostore = $filename_rename . '_' . time() . '.' . $extension;

        $named_file = $filenametostore;

        //Upload File
        $request->file($ffname)->storeAs('public/images', $filenametostore);
        $request->file($ffname)->storeAs('public/images', $filenametostore);

        //Resize image here
        $thumbnailpath = public_path('storage/images/thumbnail/' . $filenametostore);
        $request->file($ffname)->storeAs('public/images/thumbnail/', $filenametostore);
        $img = Image::make($thumbnailpath)->resize(24, 24, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($thumbnailpath);
        return $named_file;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carrier  $carrier
     * @return \Illuminate\Http\Response
     */
    public function show(Carrier $carrier)
    {
        return view('carrier.view_carrier')->with(compact('carrier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carrier  $carrier
     * @return \Illuminate\Http\Response
     */
    public function edit(Carrier $carrier)
    {

        return view('carrier.create_carrier')->with(compact('carrier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carrier  $carrier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Carrier $carrier)
    {
        $data = $request->validate([
            'carrier_email' => 'email',
            'carrier_code' => 'required|max:4',
            'logo' => 'file',
            'carrier_name' => 'required|min:2',
        ]);
        $data['logo'] = $this->saveImage($request, 'logo', $data['carrier_code']);
        $this->saveImage($request, 'logo', $data['carrier_code']);
        Carrier::find($carrier->id)->update($data);
        return redirect()->route('carrier.show', ['id' => $carrier->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carrier  $carrier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carrier $carrier)
    {
        return $carrier->delete();
    }
}
