<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ListModel;
use Illuminate\Support\Carbon;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ListModel::orderBy('created_at', 'DESC')->get();
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
        $list = new ListModel();
        $list->name = $request->list['name'];
        $list->completed = 0;
        $list->save();

        return $list;

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
        $list = ListModel::find($id);

        if ($list) {
            $list->completed = $request->list['completed'] ? 1 : 0;
            $list->completed_at = $request->list['completed'] ? Carbon::now() : null;
            $list->save();

            return $list;
        }

        return 'Not Found';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $list = ListModel::find($id);

        if ($list) {
            $list->delete();
            return 'List deleted!';
        }

        return 'Not Found!';
    }
}
