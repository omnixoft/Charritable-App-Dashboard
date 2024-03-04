<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyWilayatRequest;
use App\Http\Requests\StoreWilayatRequest;
use App\Http\Requests\UpdateWilayatRequest;
use App\Models\Governorate;
use App\Models\Wilayat;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class WilayatsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('wilayat_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Wilayat::with(['governorate', 'team'])->select(sprintf('%s.*', (new Wilayat())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'wilayat_show';
                $editGate = 'wilayat_edit';
                $deleteGate = 'wilayat_delete';
                $willayat_edit = '';
                $edit_btn = '<button type="button" onclick="getcharges(' . $row->id . ')" class="btn btn-xs btn-info" data-toggle="modal" data-target="#editForm">Edit</button>';
                $crudRoutePart = 'wilayats';
                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'willayat_edit',
                    'edit_btn',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('name_ar', function ($row) {
                return $row->name_ar ? $row->name_ar : '';
            });
            // $table->addColumn('charges', function ($row) {
            //     return $row->charges != '' ? getOmr($row->charges) : '';
            // });
            $table->addColumn('governorate_name', function ($row) {
                return $row->governorate ? $row->governorate->name : '';
            });
            $table->addColumn('governorate_ar', function ($row) {
                return $row->governorate ? $row->governorate->name_ar : '';
            });

            $table->rawColumns(['actions', 'charges', 'placeholder', 'governorate', 'governorate_ar']);

            return $table->make(true);
        }

        return view('admin.wilayats.index');
    }

    public function willayat_records($will_id)
    {

        $record = DB::table('wilayats')
            ->where('id', $will_id)
            ->get();

        return response()->json(['willayat_record' => $record]);
    }
    public function update_record(Request $request)
    {
        $charges = $request->ship_charges;
        $record_id = $request->record_id;
        $res = DB::update('update wilayats set charges = ? where id = ?', [$charges, $record_id]);

        return response()->json(['result' => '1'], Response::HTTP_CREATED);
    }

    public function create()
    {
        abort_if(Gate::denies('wilayat_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $governorates = Governorate::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.wilayats.create', compact('governorates'));
    }

    public function store(StoreWilayatRequest $request)
    {
        $wilayat = Wilayat::create($request->all());

        return redirect()->route('admin.wilayats.index');
    }

    public function edit(Wilayat $wilayat)
    {
        abort_if(Gate::denies('wilayat_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $governorates = Governorate::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $wilayat->load('governorate', 'team');

        return view('admin.wilayats.edit', compact('governorates', 'wilayat'));
    }

    public function update(UpdateWilayatRequest $request, Wilayat $wilayat)
    {
        $wilayat->update($request->all());

        return redirect()->route('admin.wilayats.index');
    }

    public function show(Wilayat $wilayat)
    {
        abort_if(Gate::denies('wilayat_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wilayat->load('governorate', 'team');

        return view('admin.wilayats.show', compact('wilayat'));
    }

    public function destroy(Wilayat $wilayat)
    {
        abort_if(Gate::denies('wilayat_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wilayat->delete();

        return back();
    }

    public function massDestroy(MassDestroyWilayatRequest $request)
    {
        Wilayat::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}