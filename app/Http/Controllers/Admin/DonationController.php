<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyDonationRequest;
use App\Http\Requests\StoreDonationRequest;
use App\Http\Requests\UpdateDonationRequest;
use App\Models\Donation;
use App\Models\Donationtype;
use App\Models\SocialSolidarity;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DonationController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('donation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Donation::with(['user', 'donation_type', 'company', 'social_solidarity', 'team'])->select(sprintf('%s.*', (new Donation())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'donation_show';
                $editGate = 'donation_edit';
                $deleteGate = 'donation_delete';
                $crudRoutePart = 'donations';

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
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : '';
            });
            $table->addColumn('donation_type_type', function ($row) {
                return $row->donation_type ? $row->donation_type->type : '';
            });

            $table->editColumn('number', function ($row) {
                return $row->number ? $row->number : '';
            });
            $table->addColumn('company_name', function ($row) {
                return $row->company ? $row->company->name : '';
            });

            $table->addColumn('social_solidarity_title', function ($row) {
                return $row->social_solidarity ? $row->social_solidarity->title : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'donation_type', 'company', 'social_solidarity']);

            return $table->make(true);
        }

        return view('admin.donations.index');
    }

    public function create()
    {
        abort_if(Gate::denies('donation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $donation_types = Donationtype::pluck('type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $companies = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $social_solidarities = SocialSolidarity::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.donations.create', compact('companies', 'donation_types', 'social_solidarities', 'users'));
    }

    public function store(StoreDonationRequest $request)
    {
        $donation = Donation::create($request->all());

        return redirect()->route('admin.donations.index');
    }

    public function edit(Donation $donation)
    {
        abort_if(Gate::denies('donation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $donation_types = Donationtype::pluck('type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $companies = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $social_solidarities = SocialSolidarity::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $donation->load('user', 'donation_type', 'company', 'social_solidarity', 'team');

        return view('admin.donations.edit', compact('companies', 'donation', 'donation_types', 'social_solidarities', 'users'));
    }

    public function update(UpdateDonationRequest $request, Donation $donation)
    {
        $donation->update($request->all());

        return redirect()->route('admin.donations.index');
    }

    public function show(Donation $donation)
    {
        abort_if(Gate::denies('donation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $donation->load('user', 'donation_type', 'company', 'social_solidarity', 'team');

        return view('admin.donations.show', compact('donation'));
    }

    public function destroy(Donation $donation)
    {
        abort_if(Gate::denies('donation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $donation->delete();

        return back();
    }

    public function massDestroy(MassDestroyDonationRequest $request)
    {
        Donation::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
