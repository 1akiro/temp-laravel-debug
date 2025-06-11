
    <div class="mt-8">
  <div class="container mx-auto px-4">
    <div class="flex flex-col-reverse lg:flex-row items-center bg-gray-50 rounded-xl p-6 lg:p-12 shadow-md">

      <div class="lg:w-1/2 w-full text-center lg:text-left">
        <h2 class="text-4xl font-extrabold text-dark leading-tight">
          <span class="text-green-700">360&deg;</span> {{ __('general.vr') }}
        </h2>
        <p class="mt-4 text-gray-700 text-base lg:text-lg">
            {{ __('text.long_desc')}}
        </p>
        <div class="flex flex-col sm:flex-row lg:justify-start justify-center gap-4 mt-6">
          <a href="#"
             class="bg-green-700 hover:bg-green-600 text-white font-bold py-2 px-6 rounded-lg shadow-md">
            {{ __('call.view_catalog') }}
          </a>
          <a href="#"
             class="bg-orange-500 hover:bg-orange-400 text-white font-bold py-2 px-6 rounded-lg shadow-md">
            {{ __('call.contact_us') }}
          </a>
        </div>
      </div>

      <div class="lg:w-1/2 w-full mb-6 lg:mb-0 flex justify-center">
        <img src="{{ asset('images/panorama.jpg') }}"
             alt="Virtuālā tūre"
             class="rounded-2xl shadow-lg w-full h-auto max-w-xl object-cover">
      </div>

    </div>
  </div>
</div>

