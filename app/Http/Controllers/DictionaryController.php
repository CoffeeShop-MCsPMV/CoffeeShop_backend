<?php

namespace App\Http\Controllers;

use App\Models\Dictionary as ModelsDictionary;
use Illuminate\Http\Request;


class DictionaryController extends Controller
{
    public function index()
    {
        return ModelsDictionary::all();
    }

    public function store(Request $request)
    {
        $record = new ModelsDictionary();
        $record->fill($request->all());
        $record->save();
    }

    public function show($code)
    {
        return ModelsDictionary::find($code);
    }

    public function update(Request $request, $code)
    {
        $record = ModelsDictionary::find($code);
        $record->fill($request->all());
        $record->save();
    }

    public function destroy($code)
    {
        ModelsDictionary::find($code)->delete();
    }
}
