<?php  $url = url()->current();

?>
<style>
    .margin{
        margin-right: 8px;
    }
</style>
<a href="{{$url.'?status='}}draft"
   class="btn margin btn-xs btn-@if(isset($_GET['status']) && $_GET['status'] == "draft"){{"primary"}}@else{{"secondary"}}@endif float-right">Draft
    Jobs</a>

<a href="{{$url.'?status='}}reject"
   class="btn margin btn-xs btn-@if(isset($_GET['status']) && $_GET['status'] == "reject"){{"primary"}}@else{{"secondary"}}@endif float-right">Rejected
    Jobs</a>
<a href="{{$url.'?status='}}pause"
   class="btn margin btn-xs btn-@if(isset($_GET['status']) && $_GET['status'] == "pause"){{"primary"}}@else{{"secondary"}}@endif float-right">Pause
    Jobs</a>
<a href="{{$url.'?status='}}active"
   class="btn margin btn-xs btn-@if(isset($_GET['status']) && $_GET['status'] == "active"){{"primary"}}@else{{"secondary"}}@endif float-right">Active
    Jobs</a>
<a href="{{$url.'?status='}}all"
   class="btn margin btn-xs btn-@if(isset($_GET['status']) && $_GET['status'] == "all"){{"primary"}}@else{{"secondary"}}@endif float-right">All
    Jobs</a>