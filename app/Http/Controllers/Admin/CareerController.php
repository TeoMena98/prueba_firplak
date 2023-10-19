<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCareerRequest;
use App\Http\Requests\StoreCareerRequest;
use App\Http\Requests\UpdateCareerRequest;
use App\Career;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CareerController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('career_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $careers = Career::all();

        return view('admin.careers.index', compact('careers'));
    }

    public function create()
    {
        abort_if(Gate::denies('career_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.careers.create');
    }

    public function store(StoreCareerRequest $request)
    {
        $career = Career::create($request->all());

        return redirect()->route('admin.careers.index');
    }

    public function edit(Career $career)
    {
        abort_if(Gate::denies('career_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.careers.edit', compact('career'));
    }

    public function update(UpdateCareerRequest $request, Career $career)
    {
        $career->update($request->all());

        return redirect()->route('admin.careers.index');
    }

    public function show(Career $career)
    {
        abort_if(Gate::denies('career_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.careers.show', compact('career'));
    }

    public function destroy(Career $career)
    {
        abort_if(Gate::denies('career_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $career->delete();

        return back();
    }

    public function massDestroy(MassDestroyCareerRequest $request)
    {
        Career::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
