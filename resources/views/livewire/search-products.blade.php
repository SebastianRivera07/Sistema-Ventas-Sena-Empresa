<div x-data="{ open: @entangle('show') }">

    <template x-if="open">
        <div>
            <div class="modal-backdrop fade show"></div>

            <div class="modal d-block" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">Buscar producto</h5>

                            <button type="button" class="btn-close" @click="open = false"></button>
                        </div>

                        <div class="modal-body">

                            <input type="text" class="form-control" wire:model.live="search" placeholder="Buscar...">

                            <ul class="list-group">
                                @foreach ($products as $p)
                                    <li class="list-group-item list-group-item-action"
                                        wire:click="selectProduct({{ $p->id }})">
                                        {{ $p->name }} — ${{ $p->price }}
                                    </li>
                                @endforeach
                            </ul>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </template>

</div>

