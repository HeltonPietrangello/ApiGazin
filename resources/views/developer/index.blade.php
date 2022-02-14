<x-app-layout>
    <div id="app">
        <x-container class="py-8">

            {{-- Formulário de cadastro de Desenvolvedor --}}
            <x-form-section class="mb-12">
                <x-slot name="title">
                    Cradastro de Desenvolvedor
                </x-slot>

                <x-slot name="description">
                    Preencha o formulário para cadastrar um Desenvolvedor.
                </x-slot>

                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-4">
                        {{-- Mensagem de erro --}}
                        <div v-if="createForm.errors.length > 0"
                            class="mb-4 bg-red-100 border border-red-700 text-red-700 px-4 py-3 rounded">
                            <strong class="font-bold">OOPS!</strong>
                            <span>Algo deu errado!</span>
                            <ul>
                                <li v-for="error in createForm.errors">@{{ error }}</li>
                            </ul>
                        </div>

                        <x-label>Nome</x-label>
                        <input type="text" v-model="createForm.name"
                            class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mb-3"
                            id="name" name="name">

                        <x-label>Sexo</x-label>
                        <input type="text" v-model="createForm.sex"
                            class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mb-3"
                            id="sex" name="sex">

                        <x-label>Nivel</x-label>
                        <input type="text" v-model="createForm.level_id"
                            class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mb-3"
                            id="level_id" name="level_id">

                        <x-label>Nascimento</x-label>
                        <input type="date" v-model="createForm.birth"
                            class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mb-3"
                            id="birth" name="birth">

                    </div>
                </div>
                <x-slot name="actions">
                    <x-button v-on:click="store" v-bind:disabled="createForm.disabled">Criar</x-button>
                </x-slot>
            </x-form-section>

            {{-- Mostrar Desenvolvedores --}}
            <x-form-section v-if="developers.length > 0">
                <x-slot name="title">
                    Lista de Desenvolvedor
                </x-slot>
                <x-slot name="description">
                    Aqui se encontra a lista de Níveis cadastrados.
                </x-slot>
                <div>
                    <table class="text-gray-600 min-w-full">
                        <thead class="border-b border-gray-300 bg-gray-100">
                            <tr class="text-left">
                                <th class="py-2">Nome</th>
                                <th class="py-2">Sexo</th>
                                <th class="py-2">Nível</th>
                                <th class="py-2">Nascimento</th>
                                <th class="py-2"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-300">
                            <tr v-for="developer in developers">
                                <td class="py-2">@{{ developer.name }}</td>
                                <td class="py-2">@{{ developer.sex }}</td>
                                <td class="py-2">@{{ developer.level_id }}</td>
                                <td class="py-2">@{{ developer.birth }}</td>
                                <td class="flex divide-x divide-gray-300 py-2 float-right">
                                    <a v-on:click="edit(developer)"
                                        class="pr-2 hover:text-blue-600 font-semibold cursor-pointer">Editar</a>
                                    <a class="pl-2 hover:text-red-600 font-semibold cursor-pointer"
                                        v-on:click="destroy(developer)">Eliminar</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </x-form-section>
        </x-container>


        {{-- Modal --}}
        <x-dialog-modal modal="editForm.open">
            <x-slot name="title">Editar Nível</x-slot>
            <x-slot name="content">
                <div class="space-y-6">

                    <div v-if="editForm.errors.length > 0"
                        class="bg-red-100 border border-red-700 text-red-700 px-4 py-3 rounded">
                        <strong class="font-bold">OOPS!</strong>
                        <span>Algo deu errado!</span>
                        <ul>
                            <li v-for="error in editForm.errors">@{{ error }}</li>
                        </ul>
                    </div>

                    <div>

                        <x-label>Nome</x-label>
                        <input type="text" v-model="editForm.name"
                            class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mb-3"
                            id="name" name="name">

                        <x-label>Sexo</x-label>
                        <input type="text" v-model="editForm.sex"
                            class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mb-3"
                            id="sex" name="sex">

                        <x-label>Nivel</x-label>
                        <input type="text" v-model="editForm.level_id"
                            class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mb-3"
                            id="level_id" name="level_id">

                        <x-label>Nascimento</x-label>
                        <input type="date" v-model="editForm.birth"
                            class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mb-3"
                            id="birth" name="birth">

                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <button type="button" v-on:click="update()" v-bind:disabled="editForm.disabled"
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50">Atualizar</button>

                <button v-on:click="editForm.open = false" type="button"
                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancelar</button>
            </x-slot>
        </x-dialog-modal>
    </div>


    @push('js')
        <script>
            new Vue({
                el: "#app",
                data: {
                    developers: [],
                    createForm: {
                        errors: [],
                        disabled: false,
                        errors: [],
                        name: null,
                        sex: null,
                        level_id: null,
                        birth: null
                    },
                    editForm: {
                        open: false,
                        errors: [],
                        disabled: false,
                        errors: [],
                        id: null,
                        name: null,
                        sex: null,
                        level_id: null
                    }
                },
                mounted() {
                    this.getDevelopers();
                },
                methods: {

                    getDevelopers() {
                        axios.get('/v1/developers')
                            .then(response => {
                                this.developers = response.data.data;
                            });
                    },

                    store() {
                        this.createForm.disabled = true;

                        axios.post('/v1/developers', this.createForm)
                            .then(response => {
                                this.createForm.name = null;
                                this.createForm.sex = null;
                                this.createForm.level_id = null;
                                this.createForm.birth = null;
                                this.createForm.errors = [];
                                Swal.fire(
                                    'Desenvolvedor criado com sucesso!'
                                )

                                this.getDevelopers();

                                this.createForm.disabled = false;

                            }).catch(error => {

                                this.createForm.errors = _.flatten(_.toArray(error.response.data.errors));

                                this.createForm.disabled = false;
                            })
                    },

                    edit(developer) {
                        this.editForm.open = true;
                        this.editForm.errors = [];
                        this.editForm.id = developer.id;
                        this.editForm.name = developer.name;
                        this.editForm.sex = developer.sex;
                        this.editForm.level_id = developer.level_id;
                        this.editForm.birth = developer.birth;
                    },

                    update() {
                        this.editForm.disabled = true;

                        axios.put('/v1/developers/' + this.editForm.id, this.editForm)
                            .then(response => {
                                this.editForm.open = false;
                                this.editForm.disabled = false;
                                this.editForm.name = null;
                                this.editForm.sex = null;
                                this.editForm.level_id = null;
                                this.editForm.birth = null;
                                this.editForm.errors = [];
                                Swal.fire(
                                    'Nível atualizado com sucesso!'
                                )

                                this.getDevelopers();

                            }).catch(error => {

                                this.editForm.errors = _.flatten(_.toArray(error.response.data.errors));

                                this.editForm.disabled = false;
                            })
                    },

                }
            });
        </script>
    @endpush

</x-app-layout>
