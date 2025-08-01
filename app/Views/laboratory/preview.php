<main class="preview">
    <div class="content h-[86vh] flex flex-column justify-between">
        <div class="render relative w-100 h-100 px-4 mt-4 flex w-[100%] justify-content-center align-items-center">
            <div id="render" class="w-100 h-[55vh] overflow-y-scroll overflow-x-hidden " style="transform: scale(1)"></div>
        </div>
        <div class="actions shadow-md bg-gray-200 p-4">
            <div class="flex w-full">
                <div class="w-50 pr-8">
                    <div>
                        <ul class="text-sm list-unstyled flex justify-content-around pt-2 ps-2">
                            <li>
                                <p><span class="font-700 font-monospace">Renderização:</span> <i data-duration='time'>0.2s</i></p>
                            </li>
                        </ul>
                    </div>
                    <div class="my-4">
                        <select name="test" id="" class="w-full border-2 border-light h-[2.8rem] px-2 rounded-sm">
                            <option value="">Selecione o teste</option>
                        </select>
                    </div>
                    <div class="my-1 ms-2">
                        <button class="btn bg-blue-400 text-white px-4 py-2 rounded-sm mr-1" data-component='action'>Executar Testes</button>
                        <button class="btn bg-yellow-500 px-4 py-2 rounded-sm mr-1" data-component='restore'>Restaurar</button>
                        <button class="btn bg-green-400 text-white px-6 py-2 rounded-sm mr-1" data-single='true' data-component='action'>Teste Único</button>
                    </div>
                </div>
                <div class="w-50">
                    <div>
                        <div class="bg-laboratory h-[24vh] rounded-2 mt-1 overflow-y-scroll w-full ps-2" data-log>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>