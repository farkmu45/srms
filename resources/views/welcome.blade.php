<x-layouts.app>
  <div class="bg-white">
    <div class="relative isolate px-6 pt-14 lg:px-8">
      <div class="mx-auto max-w-2xl py-32">
        <div class="text-center">
          <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Student Result Management System</h1>
          <p class="mt-6 text-lg leading-8 text-gray-600">Empowering academic success with efficient management – Welcome
            to the Student Result Management System!</p>
          <div class="mt-10 flex flex-col items-center justify-center gap-y-6">
            <a class="rounded-md bg-amber-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-amber-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
              href="{{ route('filament.student.auth.login') }}">Sign in</a>
            <a class="text-sm font-semibold leading-6 text-gray-900" href="{{ route('submission') }}">Submission <span
                aria-hidden="true">→</span></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-layouts.app>
