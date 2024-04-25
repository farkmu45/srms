<div class="mx-auto max-w-screen-lg lg:px-0" style="margin-top: 5rem; margin-bottom: 5rem">
  <h1 class="text-3xl font-bold">Submission</h1>
  <form class="mt-6  flex flex-col" wire:submit="create">
    {{ $this->form }}

    <button type="submit" style="margin-top: 20px" class="ml-auto px-3 py-2 bg-primary-500 rounded-md text-white font-medium">
      Submit
    </button>
  </form>

  <x-filament-actions::modals />
</div>
