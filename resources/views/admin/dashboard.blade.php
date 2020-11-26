@extends('admin_layout')
@section('title', 'Dashboard')
@section('admin_content')

<div class="row">
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="card p-20 bg-info">
            <div class="media">
                <div class="media-left media-middle">
                    <i class="icon-book-open fa-3x text-white"></i>
                </div>
                <div class="media-body text-right">
                    <h3 class="text-white">285</h3>
                    <span class="text-white">New Posts</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="card p-20 bg-danger">
            <div class="media">
                <div class="media-left media-middle">
                    <i class="icon-bubbles fa-3x text-white"></i>
                </div>
                <div class="media-body text-right">
                    <h3 class="text-white">263</h3>
                    <span class="text-white">New Comments</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="card p-20 bg-success">
            <div class="media">
                <div class="media-left media-middle">
                    <i class="icon-graph fa-3x text-white"></i>
                </div>
                <div class="media-body text-right">
                    <h3 class="text-white">87.56%</h3>
                    <span class="text-white">Web traffic</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="card p-20 bg-warning">
            <div class="media">
                <div class="media-left media-middle">
                    <i class="icon-eye fa-3x text-white"></i>
                </div>
                <div class="media-body text-right">
                    <h3 class="text-white">300</h3>
                    <span class="text-white">Total Visits</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection