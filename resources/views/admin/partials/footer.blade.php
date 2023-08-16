
<footer class="main-footer">
    <strong>Copyright &copy; {{date("Y")}} <a href="{{url('/')}}">{{$settings->website_title}}</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>{{$settings->country}}</b>
    </div>
</footer>
<script>
    $("a.nav-link").each(function () {
        var this_url = $(this).attr('href');
        var opened_url = window.location.href;
        if(this_url == opened_url){
            $(this).closest('.has-treeview').addClass('menu-open');
            $(this).addClass('active');
        }
    })
</script>