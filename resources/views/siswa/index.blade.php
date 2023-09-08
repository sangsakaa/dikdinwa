<x-app-layout>
  <x-slot name="header">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
      <h2 class="text-xl font-semibold leading-tight">

        @section('title', ' | Data Siswa' )
      </h2>
      <form action="/data-siswa" method="post">
        @method('delete')
        @csrf
        <x-button variant="red" class="justify-center max-w-xs gap-2">
          <x-icons.github class="w-6 h-6" aria-hidden="true" />
          <span>Reset Data Siswa</span>
        </x-button>
      </form>

    </div>
  </x-slot>
  <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
    <div class=" bg-white  justify-between ">
      <span>Dalam Progress Pengembangan</span>

    </div>
  </div>
</x-app-layout>