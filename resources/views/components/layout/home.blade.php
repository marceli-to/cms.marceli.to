@props([
  'title' => null,
])
<x-layout.partials.head :title="$title" />
<x-layout.partials.body>
  <x-layout.partials.header>
    [Header]
  </x-layout.partials.header>
  <x-layout.partials.main>
    {{ $slot }}
  </x-layout.partials.main>
</x-layout.partials.body>
<x-layout.partials.footer />
