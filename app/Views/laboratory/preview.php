<main class="preview">
    <div class="content">
        <div class="render">
            <div class="position-relative h-83 mt-4 d-flex w-100 justify-content-center align-items-center">
                <div id="render" style="transform: scale(1)"></div>
            </div>
        </div>
        <div class="actions shadow-md bg-gray-200">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div>
                        <ul class="text-sm list-unstyled flex justify-content-around pt-2 ps-2">
                            <li>
                                <p><span class="font-700 font-monospace">Renderização:</span> <i>0.2s</i></p>
                            </li>
                        </ul>
                    </div>
                    <div class="mb-4">
                        <select name="test" id="" class="form-control">
                            <option value="">Selecione o teste</option>
                        </select>
                    </div>
                    <div class="my-1 ms-2">
                        <button class="btn btn-primary" data-component='action'>Executar Testes</button>
                        <button class="btn btn-warning" data-component='restore'>Restaurar</button>
                        <button class="btn btn-success" data-component='action'>Teste Único</button>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div>
                        <div class="bg-laboratory h-37 mt-1 overflow-y-scroll w-full ps-2" data-log>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>