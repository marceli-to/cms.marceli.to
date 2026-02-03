@props([
  'title' => null,
  'active' => false,
  'action' => null,
])

<li x-data="{ optimisticActive: @js($active) }">
  <button
    wire:click="{{ $action }}"
    @click="optimisticActive = !optimisticActive"
    type="button"
    class="font-semibold text-md md:text-lg lg:text-xl flex items-start gap-x-4 lg:gap-x-6 w-full text-left cursor-pointer group">
    <span
      x-show="optimisticActive"
      x-cloak
      class="w-auto mt-4 md:mt-8">
      <x-icons.arrow-right size="sm" class="h-auto w-14" />
    </span>
    <span>{{ $title }}</span>
  </button>
</li>
