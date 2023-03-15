@php
$company_data = App\Models\CompanySettings::first();
@endphp

<footer class="footer">
          <div class="footer-body">
              <ul class="left-panel list-inline mb-0 p-0">
              © @isset($company_data) {{$company_data->footer}} @else Design & Develop by Artisans @endisset 
                 
                
              </ul>
              <div class="right-panel">
              <span class="badge bg-primary">Software Version {{ env('SOFTWARE_VERSION') }}</span>
              </div>
          </div>