@section('title', __('Laporan'))
@extends('admin.layouts.app')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <h1>{{__('Laporan')}}</h1>
        <div class="section-header-breadcrumb">
        </div>
        </div>

        <div class="section-body">
          @include('admin.reports.partials.menu')
          <div class="card">
              <div class="card-header">

                  <h4>{{__('Laporan Keuangan')}}</h4>
              </div>
              <div class="card-body">
                <a href="{{ route('admin.reports.pdf') }}" class="btn btn-primary">Generate to pdf</a>
                <div class="row">
                  <div class="table-responsive">
                      <table class="table table-bordered table-hover">
                          <thead>
                              <tr>
                                  <th class="text-center">No</th>
                                  <th>Invoice</th>
                                  <th>Pemesan</th>
                                  <th>Metode Pembayaran</th>
                                  <th>Total</th>
                              </tr>
                          </thead>
                          <tbody>
                            <?php $no = 1; ?>
                            @foreach ($orders as $order)
                                <tr>
                                  <td class="text-center">{{ $no++ }}</td>
                                  <td>{{ $order->invoice }}</td>
                                  <td>{{ $order->order_name }}</td>
                                  <td>{{$order->payment_method ?: '-'}}</td>
                                  <td>@rupiah($order->total)</td>
                                </tr>
                            @endforeach

                          </tbody>
                          <tfoot>
                            <tr class="border">
                              <td class="font-weight-bold" colspan="4">Total Pendapatan</td>
                              <td class="font-weight-bold text-success">@rupiah($orders->sum("total") )</td>
                            </tr>
                          </tfoot>
                      </table>

       
                  </div>
              </div>
              </div>
          </div>
        </div>
    </section>
</div>
@endsection

