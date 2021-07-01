@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       <router-view></router-view>
       <vue-progress-bar></vue-progress-bar>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @endsection