<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Comissão
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-2 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                  <div class="flex">
                    <div>
                      <p class="text-sm">{{ session('message') }}</p>
                    </div>
                  </div>
                </div>
            @endif
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">N#</th>
                        <th class="px-4 py-2">Nome venda</th>
                        <th class="px-4 py-2">Comissão</th>
                        <th class="px-4 py-2">Valor total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comissoes as $comissao)
                    <tr>
                        <td class="border px-4 py-2 text-center">{{ $comissao->id }}</td>
                        <td class="border px-4 py-2">{{ $comissao->name }}</td>
                        <td class="border px-4 py-2 text-center">R$ {{ $comissao->comissao }}</td>
                        <td class="border px-4 py-2 text-center">R$ {{ $comissao->value }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
