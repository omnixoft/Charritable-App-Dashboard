<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyDonationtypeRequest;
use App\Http\Requests\StoreDonationtypeRequest;
use App\Http\Requests\UpdateDonationtypeRequest;
use App\Models\Donationtype;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DonationtypesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('donationtype_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Donationtype::with(['team'])->select(sprintf('%s.*', (new Donationtype())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'donationtype_show';
                $editGate = 'donationtype_edit';
                $deleteGate = 'donationtype_delete';
                $crudRoutePart = 'donationtypes';

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
            $table->editColumn('type', function ($row) {
                return $row->type ? $row->type : '';
            });
            $table->editColumn('type_ar', function ($row) {
                return $row->type_ar ? $row->type_ar : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.donationtypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('donationtype_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.donationtypes.create');
    }

    public function store(StoreDonationtypeRequest $request)
    {
        $donationtype = Donationtype::create($request->all());

        return redirect()->route('admin.donationtypes.index');
    }

    public function edit(Donationtype $donationtype)
    {
        abort_if(Gate::denies('donationtype_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $donationtype->load('team');

        return view('admin.donationtypes.edit', compact('donationtype'));
    }

    public function update(UpdateDonationtypeRequest $request, Donationtype $donationtype)
    {
        $donationtype->update($request->all());

        return redirect()->route('admin.donationtypes.index');
    }

    public function show(Donationtype $donationtype)
    {
        abort_if(Gate::denies('donationtype_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $donationtype->load('team');

        return view('admin.donationtypes.show', compact('donationtype'));
    }

    public function destroy(Donationtype $donationtype)
    {
        abort_if(Gate::denies('donationtype_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $donationtype->delete();

        return back();
    }

    public function massDestroy(MassDestroyDonationtypeRequest $request)
    {
        Donationtype::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
