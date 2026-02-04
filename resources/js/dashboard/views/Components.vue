<script setup>
const colors = [
  { name: 'black', hex: '#000000', bg: 'bg-black' },
  { name: 'white', hex: '#ffffff', bg: 'bg-white', border: true },
  { name: 'snow', hex: '#f5f5f5', bg: 'bg-snow', border: true },
  { name: 'gray', hex: '#828282', bg: 'bg-gray' },
  { name: 'silver', hex: '#c8c8c8', bg: 'bg-silver' },
  { name: 'navy', hex: '#00455c', bg: 'bg-navy' },
  { name: 'slate', hex: '#5a778e', bg: 'bg-slate' },
  { name: 'red', hex: '#dc0000', bg: 'bg-red' },
  { name: 'lime', hex: '#7d9b00', bg: 'bg-lime' },
  { name: 'olive', hex: '#555700', bg: 'bg-olive' },
  { name: 'wine', hex: '#75000a', bg: 'bg-wine' },
  { name: 'bronze', hex: '#8c6900', bg: 'bg-bronze' },
]

const fontSizes = [
  { name: 'text-sm', px: '12px', class: 'text-sm' },
  { name: 'text-md', px: '16px', class: 'text-md' },
  { name: 'text-lg', px: '24px', class: 'text-lg' },
]

const fontWeights = [
  { name: 'font-normal', weight: '400', class: 'font-normal' },
  { name: 'font-medium', weight: '500', class: 'font-medium', pending: true },
  { name: 'font-semibold', weight: '600', class: 'font-semibold' },
]
</script>

<template>
  <div class="min-h-screen bg-gray-50 p-8">
    <div class="max-w-6xl mx-auto">
      <h1 class="text-3xl font-bold text-gray-900 mb-8">Component Library</h1>

      <!-- Colors -->
      <section class="mb-12">
        <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b">Colors</h2>
        <div class="grid grid-cols-12 sm:grid-cols-6 gap-6">
          <div v-for="color in colors" :key="color.name" class="flex flex-col _items-center">
            <div
              class="w-16 h-16 rounded"
              :class="[color.bg, color.border ? 'border border-silver' : '']"
            ></div>
            <span class="mt-2 text-sm font-medium text-black">{{ color.name }}</span>
            <span class="text-xs text-gray">{{ color.hex }}</span>
          </div>
        </div>
      </section>

      <!-- Typography -->
      <section class="mb-12">
        <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b">Typography</h2>

        <!-- Font Sizes -->
        <h3 class="text-sm font-semibold text-gray mb-3">Sizes</h3>
        <div class="space-y-4 mb-8">
          <div v-for="size in fontSizes" :key="size.name" class="flex items-baseline gap-6">
            <span class="w-20 text-sm text-gray">{{ size.name }}</span>
            <span class="w-12 text-sm text-gray">{{ size.px }}</span>
            <span :class="size.class" class="text-black">The quick brown fox jumps over the lazy dog</span>
          </div>
        </div>

        <!-- Font Weights -->
        <h3 class="text-sm font-semibold text-gray mb-3">Weights</h3>
        <div class="space-y-4">
          <div v-for="weight in fontWeights" :key="weight.name" class="flex items-baseline gap-6">
            <span class="w-28 text-sm text-gray">{{ weight.name }}</span>
            <span class="w-12 text-sm text-gray">{{ weight.weight }}</span>
            <span :class="weight.class" class="text-md text-black">
              The quick brown fox jumps over the lazy dog
              <span v-if="weight.pending" class="text-sm text-gray font-normal ml-2">(pending)</span>
            </span>
          </div>
        </div>
      </section>

      <!-- Buttons -->
      <section class="mb-12">
        <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b">Buttons</h2>
        <div class="flex flex-wrap gap-4">
          <!-- Add button variants here -->
          <p class="text-gray-500">Button variants will be defined here</p>
        </div>
      </section>

      <!-- Form Fields -->
      <section class="mb-12">
        <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b">Form Fields</h2>
        <div class="grid grid-cols-2 gap-6">
          <!-- Add form field examples here -->
          <p class="text-gray-500 col-span-2">Form fields will be defined here</p>
        </div>
      </section>

      <!-- Icons -->
      <section class="mb-12">
        <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b">Icons</h2>
        <div class="grid grid-cols-8 gap-4">
          <!-- Add icons here -->
          <p class="text-gray-500 col-span-8">Icon set will be defined here</p>
        </div>
      </section>

      <!-- UI Elements -->
      <section class="mb-12">
        <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b">UI Elements</h2>
        <div class="space-y-6">
          <!-- Add dialogs, toasts, tables, etc. -->
          <p class="text-gray-500">UI elements (dialogs, toasts, tables) will be defined here</p>
        </div>
      </section>

      <!-- Layout -->
      <section class="mb-12">
        <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b">Layout</h2>
        <div class="space-y-6">
          <!-- Add layout components preview -->
          <p class="text-gray-500">Layout components (nav, header, container) will be defined here</p>
        </div>
      </section>
    </div>
  </div>
</template>
