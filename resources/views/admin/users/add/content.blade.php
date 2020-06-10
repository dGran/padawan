<div class="antialiased font-sans flex px-4 md:px-8 pb-2">

    <div class="bg-white shadow-md rounded-lg p-6 mb-4 flex flex-col my-4 flex-1 md:flex-initial">
        <form method="POST" role="form" action="{{ route('admin.users.save') }}" lang="{{ app()->getLocale() }}">
            @csrf
            <div class="-mx-3 md:flex mb-6">
                <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="name">
                        Nombre
                    </label>
                    <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="name" name="name" type="text" placeholder="Nombre" autofocus value="{{ old('name') }}">
                    {{-- <p class="text-red text-xs italic">Please fill out this field.</p> --}}
                </div>
                <div class="md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="email">
                        EMail
                    </label>
                    <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" id="email" name="email" type="email" placeholder="Dirección email" value="{{ old('email') }}">
                </div>
            </div>
            <div class="-mx-3 md:flex mb-6">
                <div class="md:w-full px-3">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="password">
                        Password
                    </label>
                    <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3" id="password" name="password" type="password" placeholder="******************">
                    {{-- <p class="text-grey-dark text-xs italic">Make it as long and as crazy as you'd like</p> --}}
                </div>
            </div>
            <div class="-mx-3 md:flex mb-2">
                <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="whatsapp">
                        Whatsapp
                    </label>
                    <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" id="whatsapp" name="whatsapp" type="text" placeholder="Número Whatsapp">
                </div>
                <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="twitter">
                        Twitter
                    </label>
                    <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" id="twitter" name="twitter" type="text" placeholder="Twitter">
                </div>
            </div>

            <div class="mt-8 mb-4">
                <button type="submit" class="bg-green-500 text-white active:bg-pink-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg hover:bg-green-600 outline-none focus:outline-none" style="transition: all .15s ease">
                    Guardar cambios
                </button>
            </div>
        </form>
    </div>


</div>