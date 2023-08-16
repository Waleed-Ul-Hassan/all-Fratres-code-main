<style>
    .easy-autocomplete.eac-round input{
        border-radius: 4px;
    }
    @media (max-width: 991px) {
        .easy-autocomplete.eac-round input{
            min-width: 100% !important;
        }
    }
</style>
<header class="jobdetails">
    <div class="container search-form-head">

        <form class="form-inline" method="get" action="{{url('search')}}" style="border-bottom:0px;">
            <div class="form-group">
                <label for="Keywords">Keywords</label>
                <input type="text" class="form-control  " name="q" id="Keywords" placeholder="e.g customer services" value="@isset($_GET['q']){{$_GET['q']}}@endisset">
            </div>
            <div class="form-group">
                <label for="example-ddg">Location</label>
                <input type="text" class="form-control  " id="example-ddg" placeholder="e.g postcode or town" name="location" value="@isset($_GET['location']){{$_GET['location']}}@endisset">
            </div>
            <div class="form-group ml-no-mob">
                {{--<label for="inputPassword6">&nbsp;</label>--}}
                <select class="form-control " name="distance" id="inlineFormCustomSelect">
                    <option value="">Choose Distance</option>
                    <option value="5" {{getActive("distance",5,"selected")}} >up to 5 mile </option>
                    <option value="10" {{getActive("distance",10,"selected")}}>up to 10 miles</option>
                    <option value="20" {{getActive("distance",20,"selected")}}> up to 20 miles</option>
                    <option value="30" {{getActive("distance",30,"selected")}}> up to 30 miles</option>
                    <option value="40" {{getActive("distance",40,"selected")}}>up to 40 miles</option>
                    <option value="50" {{getActive("distance",50,"selected")}}>up to 50 miles</option>
                </select>
            </div>
            <div class="form-group ml-no-mob">
                {{--<label for="inputPassword6">&nbsp;</label>--}}
                <button type="submit" class="btn btn-primary ml-no-mob">Find jobs<span><i class="fas fa-search"></i></span></button>
            </div>


        </form>





    </div>

</header>