<x-main-layout>

  {{-- header --}}
  <x-site.header />

  {{-- start info section --}}
  <x-site.info :$page />

  {{-- main section --}}
  <x-site.main :$page />
  <x-site.service :$services :$tariffs />

  {{-- about section --}}
  <x-site.about :$advantages :$page />

  {{-- bye bye section --}}
  <x-site.bye-bye />

  {{-- footer --}}
  <x-site.footer />

</x-main-layout>
