
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<section id="bestsellers" class="py-5 bg-white">
    <div class="container">
        <h2 class="mb-4 text-center">Bestsellers</h2>
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                    <img src="{{ Storage::url($product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body text-center">
                            <h5 class="card-title">{{ \Illuminate\Support\Str::limit($product->name, 25) }}</h5>
                            <p class="card-text">${{ number_format($product->price, 2) }}</p>
                            <a href="#" class="btn text-white" style="background-color: #4caf50;">
                                <i class="bi bi-eye me-1"></i> View Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


