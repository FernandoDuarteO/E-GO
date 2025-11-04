@extends('layouts.app')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="dashboard-container">
        <!-- Header -->
        <div class="dashboard-header">
            <h1>Dashboard</h1>
        </div>

        <!-- Metrics Grid -->
        <div class="metrics-grid">
            <div class="metric-card">
                <div class="metric-title">TODAY'S MONEY</div>
                <div class="metric-value">$53,000</div>
                <div class="metric-change positive">+55% since yesterday</div>
            </div>

            <div class="metric-card">
                <div class="metric-title">TODAY'S USERS</div>
                <div class="metric-value">2,300</div>
                <div class="metric-change positive">+3% since last week</div>
            </div>

            <div class="metric-card">
                <div class="metric-title">NEW CLIENTS</div>
                <div class="metric-value">+3,462</div>
                <div class="metric-change negative">-2% since last quarter</div>
            </div>

            <div class="metric-card">
                <div class="metric-title">SALES</div>
                <div class="metric-value">$103,430</div>
                <div class="metric-change positive">+5% than last month</div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="charts-section">
            <div class="sales-chart">
                <div class="chart-header">
                    <div class="chart-title">Sales Overview</div>
                    <div class="chart-subtitle">4% more in 2021</div>
                </div>
                <div class="chart-bars-container">
                    <div class="chart-bars">
                        <div class="bar-wrapper">
                            <div class="bar" style="height: 60%"></div>
                            <span>Apr</span>
                        </div>
                        <div class="bar-wrapper">
                            <div class="bar" style="height: 80%"></div>
                            <span>May</span>
                        </div>
                        <div class="bar-wrapper">
                            <div class="bar" style="height: 70%"></div>
                            <span>Jun</span>
                        </div>
                        <div class="bar-wrapper">
                            <div class="bar" style="height: 90%"></div>
                            <span>Jul</span>
                        </div>
                        <div class="bar-wrapper">
                            <div class="bar" style="height: 50%"></div>
                            <span>Aug</span>
                        </div>
                        <div class="bar-wrapper">
                            <div class="bar" style="height: 75%"></div>
                            <span>Sep</span>
                        </div>
                        <div class="bar-wrapper">
                            <div class="bar" style="height: 85%"></div>
                            <span>Oct</span>
                        </div>
                        <div class="bar-wrapper">
                            <div class="bar" style="height: 65%"></div>
                            <span>Nov</span>
                        </div>
                        <div class="bar-wrapper">
                            <div class="bar" style="height: 95%"></div>
                            <span>Dec</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="quote-section">
                <div class="quote-card">
                    <div class="quote-text">Faster way to create web pages</div>
                    <div class="quote-subtext">That's my skill. I'm not really specifically talented at anything except for the ability to learn.</div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection

