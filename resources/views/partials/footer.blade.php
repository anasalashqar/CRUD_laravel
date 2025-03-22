  <!-- Bootstrap Icons CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

  <footer class="text-white text-center text-md-start py-4" style="background-color: #4caf50;">
      <div class="container">
          <div class="row align-items-center">
              <!-- Left side: Branding -->
              <div class="col-md-6 mb-3 mb-md-0">
                  <h5 class="fw-bold">Green Roots 🌿</h5>
                  <p class="mb-0">Bringing nature closer to you.</p>
              </div>

              <!-- Right side: Social or Quick Links -->
              <div class="col-md-6 text-md-end">

                  <a href="{{ url('/services') }}" class="text-white me-3 text-decoration-none">
                      <i class="bi bi-gear-fill me-1"></i> Services
                  </a>


                  <a href="#" class="text-white me-3 text-decoration-none">
                      <i class="bi bi-envelope-fill me-1"></i> Contact
                  </a>

                  <a href="#" class="text-white text-decoration-none">
                      <i class="bi bi-info-circle-fill me-1"></i> About
                  </a>
              </div>

              <hr class="border-white opacity-25 my-3">

              <div class="text-center">
                  <small>&copy; {{ date('Y') }} Green Roots. All rights reserved.</small>
              </div>
          </div>
  </footer>