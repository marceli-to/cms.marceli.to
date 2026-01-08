<body
  x-data="{ menu: false }"
  class="
    antialiased 
    font-sans
    font-normal
    leading-[1.25]
    min-h-screen
    flex 
    flex-col">
    <x-layout.partials.debug />
  {{ $slot }}
</body>