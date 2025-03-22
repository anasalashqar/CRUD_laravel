<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Contact Us - Green Roots</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff;
            color: #000;
        }

        .contact-header {
            background-color: #4caf50;
            color: white;
            padding: 60px 0;
            text-align: center;
        }

        .form-section {
            padding: 40px 20px;
        }

        .btn-green {
            background-color: #4caf50;
            color: white;
            border: none;
        }

        .btn-green:hover {
            background-color: #449d48;
        }
    </style>
</head>

<body>
    <div class="contact-header">
        <h1>Contact Us</h1>
        <p>We’d love to hear from you 🌿</p>
    </div>

    <div class="container form-section">
        <form action="#" method="POST" class="row g-3 d-flex">
            @csrf
            <div class="col-md-6">
                <label for="name" class="form-label">Your Name</label>
                <input type="text" name="name" class="form-control" placeholder="John Treehugger" required>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Your Email</label>
                <input type="email" name="email" class="form-control" placeholder="you@trees.com" required>
            </div>
            <div class="col-12">
                <label for="message" class="form-label">Your Message</label>
                <textarea name="message" class="form-control" rows="5" placeholder="Tell us how we can help!" required></textarea>
            </div>
            <div class="col-12 text-center">
                <button class="btn btn-green px-4 py-2">Send Message</button>
            </div>

        </form>
    </div>
</body>

</html>