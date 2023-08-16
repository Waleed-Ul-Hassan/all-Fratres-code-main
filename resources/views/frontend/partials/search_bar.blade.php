<header class="jobdetails">
    <div class="container">
        <form class="form-inline row" action="{{url('search')}}">
            <label for="inlineFormInputName2">Keywords</label>
            <input type="text" class="form-control  col-md-3" id="inlineFormInputName1" placeholder="e.g customer services">

            <label for="inlineFormInputGroupUsername2">Location</label>
            <input type="text" class="form-control  col-md-3" id="inlineFormInputName2" placeholder="e.g postcode or town">


            <select class="custom-select col-md-2" id="inlineFormCustomSelect">

                <option value="1">up to 1 mile </option>
                <option value="2">up to 2 miles</option>
                <option value="3"> up to 3 miles</option>
                <option value="4"> up to 4 miles</option>
                <option value="5">up to 5 miles</option>
                <option value="6">up to 6 miles</option>

            </select>


            <button type="submit" class="btn btn-primary">Find jobs<span><i class="fas fa-search"></i></span></button>
        </form>

    </div>
    @php
    use App\WebStat;
    $stats = WebStat::first();
    @endphp
    @if($stats)
    <div class="jobdetail-header-top">
        <div class="container">
            <div class="jobdetail-company">
                <div class="jobdetail-company-details">
                    <p>{{$stats->total_jobs}} jobs from <a href="#">{{$stats->total_recruiters}}</a> companies</p>
                </div>
            </div>
        </div>
    </div>
    @endif
</header>