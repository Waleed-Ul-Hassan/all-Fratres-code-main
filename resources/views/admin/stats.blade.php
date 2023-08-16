@extends('admin.layout.main')

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">


                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <tr>
                                <th>Name</th>
                                <th>Seekers (<span class="seekers"></span>) </th>
                                <th>Recruiters (<span class="recruiters"></span>)</th>
                                <th>Jobs (<span class="jobs"></span>)</th>
                                <th>Orders (<span class="orders"></span>)</th>
                                <th>Alerts (<span class="alerts"></span>)</th>
                                <th>Blogs (<span class="blogs"></span>)</th>
                                <th>CVs Uploaded (<span class="cvs_uploaded"></span>)</th>

                            </tr>
                            {{--<tbody class="tdata"></tbody>--}}
                            {{--<tfoot>--}}
                            {{--<tr>--}}
                                {{--<th>Name</th>--}}
                                {{--<th >0</th>--}}
                                {{--<th class="recruiters">0</th>--}}
                                {{--<th class="jobs">0</th>--}}
                                {{--<th class="orders">0</th>--}}


                            {{--</tr>--}}
                            {{--</tfoot>--}}
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>

        const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;

        const comparer = (idx, asc) => (a, b) => ((v1, v2) =>
                v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
        )(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

        // do the work...
        document.querySelectorAll('th').forEach(th => th.addEventListener('click', (() => {
            const table = th.closest('table');
            Array.from(table.querySelectorAll('tr:nth-child(n+2)'))
                .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
                .forEach(tr => table.appendChild(tr) );
        })));



        $(document).ready(function() {

            var dataSet = [];
            // jQuery.fn.dataTable.Api.register( 'sum()', function ( ) {
            //     return this.flatten().reduce( function ( a, b ) {
            //         if ( typeof a === 'string' ) {
            //             a = a.replace(/[^\d.-]/g, '') * 1;
            //         }
            //         if ( typeof b === 'string' ) {
            //             b = b.replace(/[^\d.-]/g, '') * 1;
            //         }
            //
            //         return a + b;
            //     }, 0 );
            // } );



            var flags = '<?php echo json_encode($flags) ?>';
            flags = JSON.parse(flags);
            // flags = flags.replace("&quot;","");
            // console.log(flags);
            var ts = [];
            var tr = [];
            var tj = [];
            var to = [];
            var ja = [];
            var bl = [];
            var cv = [];
            for(i=0;i<=flags.length;i++){

                $.ajax({
                    url: "https://"+flags[i].url+"/api/getStats?key=0900",
                    type: 'GET',
                    dataType: 'html', // added data type
                    cors: false ,
                    contentType:'application/json',
                    headers: {
                        'Access-Control-Allow-Origin': '*',
                    },
                    success: function(res) {
                        var records = JSON.parse(res);
                        // dataSet.push(records);
                    // <br> <a href="'+records.domain+'" target="_blank">'+records.domain+'</a>
                        $("#example").append('<tr><td>'+records.website_title+' <br> <a href="'+records.domain+'" target="_blank">'+records.domain+'</a></td>' +
                            '<td>'+records.seekers+'</td><td>'+records.recruiters+'</td><td>'+records.jobs+'</td><td>'+records.orders+'</td><td>'+records.alerts+'</td><td>'+records.blogs+'</td><td>'+records.cvs_uploaded+'</td></tr>');

                        ts.push(records.seekers);
                        tr.push(records.recruiters);
                        tj.push(records.jobs);
                        to.push(records.orders);
                        ja.push(records.alerts);
                        bl.push(records.blogs);
                        cv.push(records.cvs_uploaded);
                    },
                    complete: function (data) {

                        $(".seekers").html( ts.reduce(function(a, b) { return a + b; }, 0) );
                        $(".recruiters").html( tr.reduce(function(a, b) { return a + b; }, 0) );
                        $(".jobs").html( tj.reduce(function(a, b) { return a + b; }, 0) );
                        $(".orders").html( to.reduce(function(a, b) { return a + b; }, 0) );
                        $(".alerts").html( ja.reduce(function(a, b) { return a + b; }, 0) );
                        $(".blogs").html( bl.reduce(function(a, b) { return a + b; }, 0) );
                        $(".cvs_uploaded").html( cv.reduce(function(a, b) { return a + b; }, 0) );


                    }
                });

            }

            //
            // var table =  $('#example').DataTable({
            //     "paging":   false,
            //     data: dataSet,
            // });



        } );



        // that.column(3, {"filter": "applied"}).data().sum();

    </script>
@endsection