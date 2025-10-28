@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <div class="row g-4">
        <!-- Card 1 -->
        <div class="col-md-4">
            <div class="card card-purple text-white shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">$500.00</h5>
                    <p class="card-text">Total Earning</p>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col-md-4">
            <div class="card card-blue text-white shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title">$961</h5>
                        <div>
                            <button class="btn btn-sm btn-light me-1">Month</button>
                            <button class="btn btn-sm btn-outline-light">Year</button>
                        </div>
                    </div>
                    <p class="card-text">Total Order</p>
                    <div class="chart-line mt-3"></div>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-md-4">
            <div class="card card-cyan text-white shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">$203k</h5>
                    <p class="card-text">Total Income</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Growth Chart -->
    <div class="row mt-4">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h6>Total Growth</h6>
                        <select class="form-select form-select-sm w-auto">
                            <option>This Month</option>
                            <option>Last Month</option>
                        </select>
                    </div>
                    <h4 class="fw-bold mt-2">$2,324.00</h4>
                    <canvas id="growthChart" height="150"></canvas>
                </div>
            </div>
        </div>

        <!-- Popular Stocks -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6>Popular Stocks</h6>
                    <div class="bg-light-purple p-3 rounded mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Bajaj Finery</span>
                            <h5>$1839.00</h5>
                        </div>
                        <small class="text-success">10% Profit</small>
                    </div>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Bajaj Finery
                            <span class="text-success">+10%</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            TTML
                            <span class="text-danger">-10%</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Reliance
                            <span class="text-success">+8%</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
