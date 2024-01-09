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
                <div class="row justify-content-between w-100">
                  <div class="col-md-5">
                    <h4>{{__('Laporan Stok barang terjual')}}</h4>
                  </div>
                  <div class="col-md-5">
                    <h4 class="text-right">{{__('Stock Semua Barang saat ini: ')}} {{ $products->sum("quantity") }}</h4>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <a href="{{ route('admin.reports.pdf-stock') }}" class="btn btn-primary">Generate to pdf</a>

                <div class="row">
                  <div class="table-responsive">
                      <table class="table table-bordered table-hover">
                          <thead>
                              <tr>
                                  <th class="text-center">No</th>
                                  <th>Nama Product</th>
                                  <th>Harga</th>
                                  <th>Stok awal</th>
                                  <th>Stok saat ini</th>
                                  <th>Stok terjual</th>
                              </tr>
                          </thead>
                          <tbody>
                            <?php $no = 1; ?>
                            @foreach ($products as $product)
                                <tr>
                                    <td class="text-center">{{ $no++ }}</td>
                                  <td>{{ $product->name }}</td>
                                  <td>@rupiah($product->price)</td>
                                  <td>{{$product->quantity + $product->total_sold}}</td>
                                  <td>{{$product->quantity}}</td>
                                  <td>{{$product->total_sold}}</td>
                                </tr>
                            @endforeach

                          </tbody>
                          <tfoot>
                            <tr class="border">
                              <td class="font-weight-bold" colspan="3">Total Stock</td>
                              <td class="font-weight-bold">{{ $products->sum('quantity') + $products->sum('total_sold') }}</td>
                              <td class="font-weight-bold">{{ $products->sum('quantity') }}</td>
                              <td class="font-weight-bold">{{ $products->sum('total_sold') }}</td>
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

