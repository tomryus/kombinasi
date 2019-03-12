@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tabel Profile</div>

                <div class="card-body">
                    <table class="table table-bordered table-stripped" >
                        <?php
                        $no=1;
                        ?>
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>email</th>
                                <th>nama</th>
                                <th>pekerjaan</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($yangdikirim as $item)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->nama}}</td>
                                <td>{{$item->pekerjaan}}</td>
                                <td><a href="{{route('profile.index')}}" class="btn btn-info" >edit</a></td>
                            </tr>
                        </tbody>
                        <?php
                        $no++;
                        ?>
                        @endforeach
                        <tfoot>
                            <tr>
                                <td colSpan="56">
                                    {{$yangdikirim->appends(Request::all())->links()}}
                                </td>
                            </tr>
                        </tfoot>
                        
                    </table>
        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
