<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Cake - CakeYa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans:ital,opsz,wght@0,17..18,400..700;1,17..18,400..700&family=Jost:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        *, button, input, select, textarea { font-family: 'Google Sans', 'Jost', 'Poppins', sans-serif; }
        .nav-link { color: white; }
    </style>
</head>
<body class="bg-light">

@include('partials.navbar')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0">Add a New Cake Product</h4>
                </div>
                <div class="card-body p-4">
                    
                    <form action="{{ url('/insert-product') }}" method="POST" enctype="multipart/form-data">
                        
                        @csrf 

                        <div class="mb-3">
                            <label class="form-label fw-bold">Cake Name</label>
                            <input type="text" name="name" class="form-control" placeholder="e.g., Bolu Stim Coklat" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Price</label>
                            <input type="text" name="price" class="form-control" placeholder="e.g., 60000" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Description</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Describe the delicious details..." required></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Image URL</label>
                            <input type="file" name="pic" class="form-control" accept="image/*" required>
                            <div class="form-text">Upload an image file (JPEG, PNG)</div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-danger btn-lg">Save Product to Database</button>
                            <a href="{{ route('product') }}" class="btn btn-outline-secondary">Cancel and Return</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
