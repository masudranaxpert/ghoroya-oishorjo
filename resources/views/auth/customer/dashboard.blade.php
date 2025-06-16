@extends('layouts.app')

@section('title', 'Customer Dashboard - Ghoroya Oishorjo')

@push('styles')
<style>
    .dashboard-card {
        transition: transform 0.2s;
        cursor: pointer;
    }
    
    .dashboard-card:hover {
        transform: translateY(-2px);
    }
    
    .quick-action-icon {
        font-size: 2rem;
        opacity: 0.7;
    }
</style>
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1">
                    <i class="fas fa-tachometer-alt me-2 text-primary"></i>My Dashboard
                </h2>
                <p class="text-muted mb-0">Welcome back, {{ $customer->name }}!</p>
            </div>
            <div class="text-muted">
                <i class="fas fa-calendar me-1"></i>{{ date('F j, Y') }}
            </div>
        </div>
    </div>
</div>

<!-- Quick Stats -->
<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="card dashboard-card h-100">
            <div class="card-body text-center">
                <div class="quick-action-icon text-primary mb-2">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <h5 class="card-title">Total Orders</h5>
                <h3 class="text-primary mb-0">{{ $orders->count() }}</h3>
                <small class="text-muted">Orders placed</small>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-3">
        <div class="card dashboard-card h-100">
            <div class="card-body text-center">
                <div class="quick-action-icon text-success mb-2">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h5 class="card-title">Active Orders</h5>
                <h3 class="text-success mb-0">0</h3>
                <small class="text-muted">Processing orders</small>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 mb-3">
        <div class="card dashboard-card h-100">
            <div class="card-body text-center">
                <div class="quick-action-icon text-warning mb-2">
                    <i class="fas fa-heart"></i>
                </div>
                <h5 class="card-title">Wishlist</h5>
                <h3 class="text-warning mb-0">0</h3>
                <small class="text-muted">Saved items</small>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="row">
    <div class="col-md-8">
        <!-- Quick Actions -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-bolt me-2"></i>Quick Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="d-grid">
                            <a href="{{ route('customer.profile') }}" class="btn btn-outline-primary btn-lg">
                                <i class="fas fa-user me-2"></i>My Profile
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="d-grid">
                            <a href="#" class="btn btn-outline-primary btn-lg">
                                <i class="fas fa-shopping-bag me-2"></i>My Orders
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="d-grid">
                            <a href="#" class="btn btn-outline-primary btn-lg">
                                <i class="fas fa-heart me-2"></i>Wishlist
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="d-grid">
                            <a href="#" class="btn btn-outline-primary btn-lg">
                                <i class="fas fa-store me-2"></i>Browse Products
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-history me-2"></i>Recent Orders
                </h5>
            </div>
            <div class="card-body">
                @if($orders->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td>#{{ $order->order_number }}</td>
                                    <td>{{ $order->created_at->format('M j, Y') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $order->status == 'delivered' ? 'success' : ($order->status == 'cancelled' ? 'danger' : 'warning') }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>${{ number_format($order->total_amount, 2) }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center text-muted py-4">
                        <i class="fas fa-shopping-bag mb-3" style="font-size: 3rem; opacity: 0.3;"></i>
                        <h6>No Orders Yet</h6>
                        <p class="mb-0">Start shopping to see your orders here!</p>
                        <a href="#" class="btn btn-primary mt-2">
                            <i class="fas fa-store me-1"></i>Browse Products
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <!-- Profile Card -->
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-user me-2"></i>My Profile
                </h5>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                        <i class="fas fa-user text-white" style="font-size: 2rem;"></i>
                    </div>
                </div>
                <h6 class="text-center mb-1">{{ $customer->name }}</h6>
                <p class="text-center text-muted mb-3">{{ $customer->email }}</p>
                
                @if($customer->phone)
                    <div class="mb-2">
                        <small class="text-muted">
                            <i class="fas fa-phone me-1"></i>{{ $customer->phone }}
                        </small>
                    </div>
                @endif
                
                @if($customer->address)
                    <div class="mb-2">
                        <small class="text-muted">
                            <i class="fas fa-map-marker-alt me-1"></i>{{ Str::limit($customer->address, 30) }}
                        </small>
                    </div>
                @endif
                
                <div class="mb-2">
                    <small class="text-muted">
                        <i class="fas fa-calendar me-1"></i>
                        Member since {{ $customer->created_at->format('M Y') }}
                    </small>
                </div>
                
                <div class="mb-3">
                    <small class="text-success">
                        <i class="fas fa-check-circle me-1"></i>
                        Status: {{ ucfirst($customer->status) }}
                    </small>
                </div>
                
                <div class="d-grid">
                    <a href="{{ route('customer.profile') }}" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-edit me-1"></i>Edit Profile
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Account Summary -->
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="fas fa-chart-line me-2"></i>Account Summary
                </h6>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-muted">Total Spent:</span>
                    <strong class="text-primary">$0.00</strong>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-muted">Orders Completed:</span>
                    <strong class="text-success">0</strong>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted">Wishlist Items:</span>
                    <strong class="text-warning">0</strong>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 