<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\Settings;
use Illuminate\Http\Request;
use File;
use Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Settings::all()->first();
        return view('setting.general_settings', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettingRequest $request)
    {
        $name = null;
        try {
            if ($request->hasFile('site_logo')) {

                $filedir = config('constants.SITE_LOGO_PATH');

                if (!File::exists($filedir)) {
                    Storage::makeDirectory($filedir, 0777);
                }

                $name = basename($request->file('site_logo')->store($filedir));

            }

            Settings::create([
                'site_logo' => $name,
                'mobile' => $request['mobile'],
                'email' => $request['email'],
                'address' => $request['address'],
                'gst' => $request['gst'],
                'name' => $request['name'],

            ]);

            toastr()->success('Setting added sucessfully!');
            return redirect()->back();
        } catch (\Exception $exception) {
            return $exception->getMessage();
            toastr()->error('Something went to wrong...!');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(SettingRequest $request, $id)
    {
        try {
            $setting = Settings::find($id);
            if ($request->hasFile('site_logo')) {

                $filedir = config('constants.SITE_LOGO_PATH');

                if (!File::exists($filedir)) {
                    Storage::makeDirectory($filedir, 0777);
                }
                //remove image from folder
                Storage::delete($filedir . DIRECTORY_SEPARATOR . $setting->site_logo);

                $name = basename($request->file('site_logo')->store($filedir));
                $setting->site_logo = $name;
            }

            $setting->mobile = $request['mobile'];
            $setting->email = $request['email'];
            $setting->address = $request['address'];
            $setting->gst = $request['gst'];
            $setting->name = $request['name'];
            $setting->save();

            toastr()->success('Setting updated sucessfully!');
            return redirect()->back();
        } catch (\Exception $exception) {
            toastr()->error('Something went to wrong...!');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
