<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camera Store</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" crossorigin="anonymous"></script>
    <style>
        .card:hover {
            transform: scale(1.05);
            transition: 0.3s ease-in-out;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            @foreach($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <h6 class="card-subtitle mb-2 text-muted">${{ $product->price }}</h6>
                        <button class="btn btn-success" style="background-color: #4caf50; color: white;"><i class="fa-solid fa-cart-shopping"></i></button>
                        <button class="btn btn-danger" style="background-color: #4caf50 ; color: white;"><i class="fa-solid fa-heart"></i></button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
