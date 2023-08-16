@foreach($cities as $citiess)
    <li class="ui-state-default" data-id="{{$citiess->id}}" data-index="{{$loop->index+1}}"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>{{$citiess->name}}
        <input type="text" class="float-right ib" value="{{$loop->index+1}}"> <small class="text-red float-right mr-3"> ({{$citiess->total_jobs}} jobs)</small></li>
@endforeach