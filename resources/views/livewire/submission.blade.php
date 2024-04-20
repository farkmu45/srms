<div class="mx-auto max-w-screen-lg px-4 pt-14 lg:px-0">
  <form wire:submit="create">
    {{ $this->form }}

    <button type="submit">
      Submit
    </button>
  </form>

  <x-filament-actions::modals />
</div>
