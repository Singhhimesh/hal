<div class="admin-table-action-block">
  
  @can('pages.edit')
  <a href="{{route('custom_page.edit', $id)}}" class="btn btn-round btn-outline-primary" title="{{ __('Edit') }}"
><i class="fa fa-edit"></i></a>
  @endcan
  @can('pages.delete')
  <button type="button" class="btn btn-round btn-outline-danger" data-toggle="modal" data-target="#deleteModal{{$id}}" title="{{ __('Delete') }}"
><i class="fa fa-trash"></i> </button>
  @endcan
<!-- Modal -->
<div id="deleteModal{{$id}}" class="delete-modal modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
      <!-- Modal content-->
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close"
                  data-dismiss="modal" title="{{ __('Close') }}"
>&times;</button>
              <div class="delete-icon"></div>
          </div>
          <div class="modal-body text-center">
              <h4 class="modal-heading">{{__('Are You Sure ?')}}</h4>
              <p>{{__('Do you really want to delete selected item names here? This
                  process
                  cannot be undone.')}}</p>
          </div>
          <div class="modal-footer">
            <form method="POST" action="{{route("custom-page.destroy", $id)}}">
              @csrf
              <input type="hidden" name="modulename" value="{{ $title }}">
              <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                  <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
            </form>
          </div>
      </div>
  </div>
</div>
<!-- Model ended -->