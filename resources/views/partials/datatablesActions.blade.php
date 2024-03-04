<div class='d-flex align-items-center col-actions'>

@if(!empty($willayat_edit))
@can($willayat_edit)
    <?php echo $edit_btn; ?>
@endcan
@else

    <div class="dropdown">
       <a class="btn btn-sm btn-icon" data-toggle="dropdown"><i class='fa fa-ellipsis-v'></i></a> 
        <div class="dropdown-menu dropdown-menu-right">

@can($viewGate)
    <a class="dropdown-item" href="{{ route('admin.' . $crudRoutePart . '.show', $row->id) }}">
       <i class="fa fa-eye"></i> <span class="ml-1">{{ trans('global.view') }}</span>
    </a>
@endcan
@can($editGate)
    <a class="dropdown-item" href="{{ route('admin.' . $crudRoutePart . '.edit', $row->id) }}">
      <i class="fa fa-pen"></i>  <span class="ml-1">{{ trans('global.edit') }}</span>
    </a>
@endcan
@can($deleteGate)
        <form action="{{ route('admin.' . $crudRoutePart . '.destroy', $row->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: block;">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit" class="dropdown-item btn-block w-100" > <i class="fa fa-trash"></i> <span class="ml-1">{{ trans('global.delete') }}</span></button>
        </form>
@endcan
  </div>
    </div>
@endif

</div>