<?php

namespace App\Http\Controllers;

use Validator;

use App\Models\WidgetOptIn;
use Illuminate\Http\Request;

class WidgetOptInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'unique:widget_opt_ins'],
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'opt_in' => ['required', 'boolean'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $widgetOptIn = WidgetOptIn::create([
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'opt_in' => $request->opt_in,
        ]);

        return response()->json(["widget_opt_in" => $widgetOptIn], 201);
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
        $validator = Validator::make([ 'id' => $id ], [
            'id' => ['required', 'exists:widget_opt_ins'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $validator = Validator::make($request->all(), [
            'opt_in' => ['required', 'boolean'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $widgetOptIn = WidgetOptIn::where('id', $id)
            ->update([
                'opt_in' => $request->opt_in,
            ]);

        return response()->json(["widget_opt_in" => $widgetOptIn]);
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
