<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCareerRequest;
use App\Http\Requests\UpdateCareerRequest;
use App\Http\Resources\Admin\CareerResource;
use App\Career;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CareersApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('career_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CareerResource(Career::all());
    }

    public function store(StoreCareerRequest $request)
    {
        $career = Career::create($request->all());

        return (new CareerResource($career))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Career $career)
    {
        abort_if(Gate::denies('career_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CareerResource($career);
    }

    public function update(UpdateCareerRequest $request, Career $career)
    {
        $career->update($request->all());

        return (new CareerResource($career))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Career $career)
    {
        abort_if(Gate::denies('career_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $career->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
