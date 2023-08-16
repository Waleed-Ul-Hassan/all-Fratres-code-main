@extends('admin.stats.layout')

@section('page-contents')
	<table id="table_div" class="display" cellspacing="0" width="100%"></table>
@stop

@section('inline-javascript')
    @include('admin.stats._datatables', $datatables_data)
@stop
