<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUniversityRequest;
use App\Http\Requests\UpdateUniversityRequest;
use App\Http\Resources\Admin\UniversityResource;
use App\University;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UniversitiesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('university_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UniversityResource(University::all());
    }

    public function store(StoreUniversityRequest $request)
    {
        $university = University::create($request->all());

        return (new UniversityResource($university))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(University $university)
    {
        abort_if(Gate::denies('university_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UniversityResource($university);
    }

    public function update(UpdateUniversityRequest $request, University $university)
    {
        $university->update($request->all());

        return (new UniversityResource($university))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(University $university)
    {
        abort_if(Gate::denies('university_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $university->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
