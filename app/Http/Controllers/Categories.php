<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categories_model;
use App\Categories_history_model;
use Dotenv\Loader\Value;

class Categories extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = new Categories_model();
        $result = $model->where('parent_id', 0)->orderBy('position', 'asc')->get();
        foreach ($result as $bin => $value) {
            $childs = $this->get_childs($value);
            $result[$bin]['childs'] = $childs;
        }
        return  json_encode($result);
    }

    private function get_childs($value)
    {

        if (isset($value->childs)) {
            foreach ($value->childs as $bin => $v) {
                $value->childs[$bin]['childs'] = $this->get_childs($v);
            }
        }

        return $value->childs;
    }


    public function create(Request $request)
    {

        $model = new Categories_model();

        $position = $model->where('parent_id', $request->get('parent_id'))->max('position');
        if ($position === null) {
            $model->position = 0;
        } else {
            $model->position = $position + 1;
        }
        $model->parent_id = $request->get('parent_id');
        $model->name_arm = $request->get('name_arm');
        $model->name_rus = $request->get('name_rus');
        $model->name_eng = $request->get('name_eng');
        $model->save();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function set_sort(Request $request)
    {
        $model = new Categories_model();
        if ($request->get('parent_id') != 0) {
            $positions = $request->get('positions');
            foreach ($positions as $key => $value) {
                $result = $model->where('id', $value)->get()->toArray();
                if ($result[0]['parent_id'] != $request->get('parent_id')) {
                    $history = new Categories_history_model();
                    $history->to_parent_id = $request->get('parent_id');
                    $history->category_id = $value;
                    $history->save();
                }
                $model->where('id', $value)->update(['parent_id' => $request->get('parent_id'), 'position' => $key]);
            }

            return;
        } else {
            return;
        }
    }

    public function set_main_sort(Request $request)
    {
        $model = new Categories_model();

        $positions = $request->get('positions');
        foreach ($positions as $key => $value) {
            $model->where('id', $value)->update(['position' => $key]);
        }
        return;
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
        $model = new Categories_model();
        $result = $model->where('id', $id)->get()->toArray();
        return json_encode($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $model = new Categories_model();
        $model->where('id', $request->get('id'))->update(['name_arm' => $request->get('name_arm'), 'name_rus' => $request->get('name_rus'), 'name_eng' => $request->get('name_eng')]);
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
