@extends('partials.master')

@section('content')






<section class="py-5" style="background-color: #f0fdf4;">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold text-success">Our Services</h2>
        <div class="row g-4">
            {{-- Service 1 --}}
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="mb-4">
                            <i class="bi bi-tree-fill display-4 text-success"></i>
                        </div>
                        <h5 class="card-title fw-semibold">Tree Planting</h5>
                        <p class="card-text text-muted">Professional tree planting with care and expertise to help grow your green space.</p>
                    </div>
                </div>
            </div>

            {{-- Service 2 --}}
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="mb-4">
                            <i class="bi bi-brush display-4 text-success"></i>
                        </div>
                        <h5 class="card-title fw-semibold">Garden Design</h5>
                        <p class="card-text text-muted">Creative and functional garden layouts tailored to your lifestyle and space.</p>
                    </div>
                </div>
            </div>

            {{-- Service 3 --}}
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="mb-4">
                            <i class="bi bi-droplet-fill display-4 text-success"></i>
                        </div>
                        <h5 class="card-title fw-semibold">Irrigation Systems</h5>
                        <p class="card-text text-muted">Smart watering systems to keep your plants healthy and your garden thriving.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



@endsection





