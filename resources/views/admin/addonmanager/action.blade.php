@if($url != NULL)
<a href="{{url($url)}}" data-toggle="tooltip" data-original-title="{{__('Manage Settings')}}" class="btn btn-round btn-outline-primary" title="{{__('Settings')}}"><i class="feather icon-settings"></i></a>
@endif
<button type="button" data-toggle="modal" data-target="#delete{{ $name }}" class="btn btn-round btn-outline-danger"  title="{{__('Delete')}}">
  <i class="fa fa-trash"></i>
</button>

    <div id="delete{{ $name }}" class="delete-modal modal fade" role="dialog">
      <div class="modal-dialog modal-sm">
          <!-- Modal content-->
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close"
                      data-dismiss="modal"  title="{{__('Close')}}">&times;</button>
                  <div class="delete-icon"></div>
              </div>
              <div class="modal-body text-center">
                  <h4 class="modal-heading">{{__('Are You Sure ?')}}</h4>
                  <p>{{__('Do you really want to delete selected item names here? This
                      process
                      cannot be undone.')}}</p>
              </div>
              <div class="modal-footer">
                <form method="post" action="{{ route('addon.delete') }}" class="pull-right">
                  @csrf
                  <input type="hidden" name="modulename" value="{{ $name }}">
                  <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                      <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
                </form>
              </div>
          </div>
      </div>
  </div>