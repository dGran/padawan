<div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-start" id="filters">
    <div class="relative w-auto my-6 mx-auto max-w-3xl">
        <!--content-->
        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">

            <!--header-->
            <div class="flex items-start justify-between p-4 border-b border-solid border-gray-300 rounded-t">
                <h3 class="text-2xl font-semibold">
                    Filtros
                </h3>
                <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" type="button" onclick="showHideFilters()">
                    <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">×</span>
                </button>
            </div>

            <!--body-->
            <div class="relative p-6 flex-auto">

                <div class="text-bold pb-2">
                    <label for="perPage">Registros por página</label>
                </div>
                <div class="relative">
                    <select name="perPage" id="perPage" class="appearance-none h-full rounded border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option {{ $perPage == 3 ? 'selected' : '' }}>3</option>
                        <option {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                        <option {{ $perPage == 8 ? 'selected' : '' }}>8</option>
                        <option {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                        <option {{ $perPage == 12 ? 'selected' : '' }}>12</option>
                        <option {{ $perPage == 15 ? 'selected' : '' }}>15</option>
                        <option {{ $perPage == 20 ? 'selected' : '' }}>20</option>
                        <option {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                        <option {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                        <option {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>

                <div class="text-bold pb-2 pt-4">
                    <label for="order">Orden</label>
                </div>
                <div class="relative">
                    <select name="order" id="order" class="appearance-none h-full rounded border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option {{ $order == 'id' ? 'selected' : '' }} value="id">
                            ID (0..9)
                        </option>
                        <option {{ $order == 'id_desc' ? 'selected' : '' }} value="id_desc">
                            ID (9..0)
                        </option>
                        <option {{ $order == 'name' ? 'selected' : '' }} value="name">
                            Nombre (A..Z)
                        </option>
                        <option {{ $order == 'name_desc' ? 'selected' : '' }} value="name_desc">
                            Nombre (Z..A)
                        </option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>

            </div>

            <!--footer-->
            <div class="flex items-center justify-end p-6 border-t border-solid border-gray-300 rounded-b">
                <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1" type="button" style="transition: all .15s ease" onclick="showHideFilters()">
                    Cerrar
                </button>
                <button type="submit" class="bg-green-500 text-white active:bg-green-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1" style="transition: all .15s ease">
                    Aplicar filtros
                </button>
            </div>

        </div>
    </div>
</div>
<div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="filters-backdrop"></div>