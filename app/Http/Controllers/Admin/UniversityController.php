<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUniversityRequest;
use App\Http\Requests\StoreUniversityRequest;
use App\Http\Requests\UpdateUniversityRequest;
use App\University;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UniversityController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('university_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $universities = University::all();

        return view('admin.universities.index', compact('universities'));
    }

    public function create()
    {
        abort_if(Gate::denies('university_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.universities.create');
    }

    public function store(StoreUniversityRequest $request)
    {
        $university = University::create($request->all());

        return redirect()->route('admin.universities.index');
    }

    public function edit(University $university)
    {
        abort_if(Gate::denies('university_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.universities.edit', compact('university'));
    }

    public function update(UpdateUniversityRequest $request, University $university)
    {
        $university->update($request->all());

        return redirect()->route('admin.universities.index');
    }

    public function show(University $university)
    {
        abort_if(Gate::denies('university_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.universities.show', compact('University'));
    }

    public function destroy(University $university)
    {
        abort_if(Gate::denies('university_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $university->delete();

        return back();
    }

    public function massDestroy(MassDestroyUniversityRequest $request)
    {
        University::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
