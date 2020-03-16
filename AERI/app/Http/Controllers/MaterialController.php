<?php

namespace App\Http\Controllers;

use App\Materials;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Materials $model)
    {
        return view('materials', ['materials' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $material = new Materials;
        $key = keyGen($material);


        return view('material.create', ['key' => $key]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $material = new Materials;

        $request->validate([
            //'material_worksheet_format' => 'required | file | mimes:xls,xlsx,xltx',
            //'material_report_format' => 'required | file | mimes:xls,xlsx,xlxt',
        ]);
        
        $material->material_id = keyGen($material);
        $material->material_name = $request->material_name;
        $material->material_description = $request->material_description;
        
        /** 
        forge relevent filenames
        $material_name = $request->material_name;
        $material_id = $request->material_id;
        $worksheet_extension = $request->file("material_worksheet_format")->getClientOriginalExtension();
        $report_extension = $request->file("material_worksheet_format")->getClientOriginalExtension();
        
        $worksheet_filename = "worksheet_".$material_name."_".$material_id.".".$worksheet_extension;
        $report_filename = "report_".$material_name."_".$material_id.".".$report_extension;
        
        // directories in public folders to upload reports
        $worksheet_directory = "Material_Worksheet_Formats";
        $report_directory = "Material_Report_Formats";
        
        $report_file = $request->file('material_worksheet_format')->storeAs($worksheet_directory, $worksheet_filename );
        $request->file('material_report_format')->storeAs($report_directory, $report_filename );

        $worksheet_storage = storage_path("app\\".$worksheet_directory."\\".$worksheet_filename);
        $report_storage = storage_path("app\\".$report_directory."\\".$report_filename);

        //store path in models
        $material->material_worksheet = $worksheet_storage;
        $material->material_report = $report_storage;
        */

        $material->save();
        return redirect()->route('material.index')->withStatus(__('Material Added successfully.'));
    }

    public function ajax($id)
    {
        $material = Materials::all()->where('material_id',$id)->first();
        
        return $material;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
