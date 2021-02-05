<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Listagem serviços
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                  <div class="flex">
                    <div>
                      <p class="text-sm">{{ session('message') }}</p>
                    </div>
                  </div>
                </div>
            @endif
            <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Criar novo produto</button>
            @if($isOpen)
                @include('livewire.servicos.create')
            @endif
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">N#</th>
                        <th class="px-4 py-2">Nome</th>
                        <th class="px-4 py-2">Valor</th>
                        <th class="px-4 py-2">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($servicos as $servico)
                    <tr>
                        <td class="border px-4 py-2 text-center">{{ $servico->id }}</td>
                        <td class="border px-4 py-2">{{ $servico->name }}</td>
                        <td class="border px-4 py-2 text-center">R$ {{ $servico->value }}</td>
                        <td class="border px-4 py-2 flex justify-center">
                        <button wire:click="edit({{ $servico->id }})" class="mx-1 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</button>
                            <button wire:click="delete({{ $servico->id }})" class="mx-1 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Excluir</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
