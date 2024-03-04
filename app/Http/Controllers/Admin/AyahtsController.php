<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAyahtRequest;
use App\Http\Requests\StoreAyahtRequest;
use App\Http\Requests\UpdateAyahtRequest;
use App\Models\Ayaht;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AyahtsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('ayaht_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = Ayaht::with(['team'])->select(sprintf('%s.*', (new Ayaht())->table));
            $table = Datatables::of($query);
            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) {
                $viewGate = 'ayaht_show';
                $editGate = 'ayaht_edit';
                $deleteGate = 'ayaht_delete';
                $crudRoutePart = 'ayahts';
                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('title_ar', function ($row) {
                return $row->title_ar ? $row->title_ar : '';
            });
            $table->editColumn('ayaht', function ($row) {
                return $row->ayaht ? $row->ayaht : '';
            });
            $table->editColumn('translation', function ($row) {
                return $row->translation ? $row->translation : '';
            });
            $table->editColumn('refrence', function ($row) {
                return $row->refrence ? $row->refrence : '';
            });
            $table->editColumn('refrence_ar', function ($row) {
                return $row->refrence_ar ? $row->refrence_ar : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.ayahts.index');
    }

    public function create()
    {
        abort_if(Gate::denies('ayaht_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ayahts.create');
    }

    public function store(StoreAyahtRequest $request)
    {
        $ayaht = Ayaht::create($request->all());

        return redirect()->route('admin.ayahts.index');
    }

    public function edit(Ayaht $ayaht)
    {
        abort_if(Gate::denies('ayaht_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ayaht->load('team');

        return view('admin.ayahts.edit', compact('ayaht'));
    }

    public function update(UpdateAyahtRequest $request, Ayaht $ayaht)
    {
        $ayaht->update($request->all());

        return redirect()->route('admin.ayahts.index');
    }

    public function show(Ayaht $ayaht)
    {
        abort_if(Gate::denies('ayaht_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ayaht->load('team');

        return view('admin.ayahts.show', compact('ayaht'));
    }

    public function destroy(Ayaht $ayaht)
    {
        abort_if(Gate::denies('ayaht_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $ayaht->delete();

        return back();
    }
    public function massDestroy(MassDestroyAyahtRequest $request)
    {
        Ayaht::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
