<tbody>
    @forelse($clientes as $cliente)
        <tr data-id="{{ $cliente->id }}" tabindex="0">
            <td>{{ $cliente->nome }}</td>
            <td>{{ $cliente->email }}</td>
            <td>{{ $cliente->telefone }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="3" class="no-clients">Sem clientes registrados</td>
        </tr>
    @endforelse
</tbody>
