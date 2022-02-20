<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Levels
        </h2>
    </x-slot>

    <div id="app">

        <x-container class="py-8">

            {{-- Cadastrar Level --}}
            <x-form-section class="mb-12">
                <x-slot name="title">
                    Cradastrar Nível 1
                </x-slot>

                <x-slot name="description">
                    Preencha o formulário para cadastrar um Nível.
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

                        <x-label>
                            Nível
                        </x-label>

                        <input type="text" v-model="createForm.level" id="level" name="level"
                            class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1"
                            id="name" name="name">
                    </div>

                </div>

                <x-slot name="actions">
                    <x-button v-on:click="store" v-bind:disabled="createForm.disabled">Criar</x-button>
                </x-slot>
            </x-form-section>

            {{-- Mostrar Level --}}
            <x-form-section v-if="levels.length > 0">
                <x-slot name="title">
                    Lista de Níveis
                </x-slot>

                <x-slot name="description">
                    Aqui se encontra a lista de Níveis cadastrados.
                </x-slot>

                <div class="flex">

                    <input type="text" v-model="busca" id="busca" name="busca" placeholder="Digite sua busca"
                        class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">

                    <x-button v-on:click="getLevels">Buscar</x-button>

                    <x-buttonRed v-on:click="limparBusca">Limpar</x-button>

                </div>

                <div style="margin-top: 30px; margin-bottom: 20px;" v-on:click="ordenar()" id="oi">Clique aqui para ordenar</div>

                <div>
                    <table class="text-gray-600 min-w-full mt-8">
                        <thead class="border-b border-gray-300 bg-gray-100">
                            <tr class="text-left">
                                <th class="py-2">Nível</th>
                                <th class="py-2 w-full">Desenvolvedores Associados</th>
                                <th class="py-2">Ação</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-300">
                            <tr v-for="(level, index) in levels">
                                <td class="py-2" width="20%">
                                    @{{ level.level }}
                                </td>




                                

                                <td class="py-2">
                                    @{{ quantity[index]?.developers.length }}
                                </td>






                                <td class="flex divide-x divide-gray-300 py-2">
                                    <a v-on:click="edit(level)"
                                        class="pr-2 hover:text-blue-600 font-semibold cursor-pointer">Editar</a>
                                    <a class="pl-2 hover:text-red-600 font-semibold cursor-pointer"
                                        v-on:click="destroy(level)">Eliminar</a>
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
                        <x-label>Nível</x-label>

                        <input type="text" v-model="editForm.level" id="level" name="level"
                            class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1"
                            id="name" name="name">

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
                    busca: '',
                    levels: [],
                    quantity: [],
                    developers: [],
                    createForm: {
                        errors: [],
                        disabled: false,
                        errors: [],
                        level: null,
                        developers: [],
                    },
                    editForm: {
                        open: false,
                        errors: [],
                        disabled: false,
                        errors: [],
                        id: null,
                        level: null,
                        developers: [],
                    },
                },
                mounted() {
                    this.getLevels();
                    this.qnantity();  
                },
                methods: {
                    getLevels() {
                        let url = '/v1/levels';
                        if (this.busca) {
                            url = url + '/?filter[level]=' + this.busca;
                        }
                        axios.get(url)
                            .then(response => {
                                this.levels = response.data.data;
                            });
                    },
                    limparBusca() {
                        this.busca = '';
                        this.getLevels();
                    },
                    store() {
                        this.createForm.disabled = true;
                        axios.post('/v1/levels', this.createForm)
                            .then(response => {
                                this.createForm.level = null;
                                this.createForm.errors = [];
                                Swal.fire(
                                    'Nível criado com sucesso!'
                                )
                                this.getLevels();
                                this.createForm.disabled = false;
                            }).catch(error => {
                                this.createForm.errors = _.flatten(_.toArray(error.response.data.errors));
                                this.createForm.disabled = false;
                            })
                    },
                    edit(level) {
                        this.editForm.open = true;
                        this.editForm.errors = [];
                        this.editForm.id = level.id;
                        this.editForm.level = level.level;
                    },
                    update() {
                        this.editForm.disabled = true;
                        axios.put('/v1/levels/' + this.editForm.id, this.editForm)
                            .then(response => {
                                this.editForm.open = false;
                                this.editForm.disabled = false;
                                this.editForm.level = null;
                                this.editForm.errors = [];
                                Swal.fire(
                                    'Nível atualizado com sucesso!'
                                )
                                this.getLevels();
                            }).catch(error => {
                                this.editForm.errors = _.flatten(_.toArray(error.response.data.errors));
                                this.editForm.disabled = false;
                            })
                    },
                    destroy(level) {
                        // console.log(level);
                        Swal.fire({
                            title: 'Deseja realmente deletar o Nível?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Sim, delete agora!'
                        }).then((result) => {
                            if (result.isConfirmed) {

                                axios.delete('/v1/levels/' + level.id)
                                    .then(response => {
                                        Swal.fire(
                                            'Deletado com sucesso!'
                                        )
                                        this.getLevels();
                                    }).catch(() => {
                                        Swal.fire(
                                            'Desenvolvedor(es) associado a este Nível!'
                                        )
                                    })
                            }
                        })
                    },
                    qnantity() {
                        axios.get('/v1/levels/?included=developers')
                            .then(response => {
                                this.quantity = response.data.data;
                            });
                    },
                    ordenar() { 
                        if(this.isActive == true){
                            axios.get('/v1/levels/?sort=-level')
                                .then(response => {
                                    this.levels = response.data.data;
                                    
                                });                                
                        }
                        else{
                            axios.get('/v1/levels/?sort=level')
                                .then(response => {
                                    this.levels = response.data.data;
                                   
                                });                               
                        }  

                        this.isActive = !this.isActive; 
                    },
                }
            });
        </script>
    @endpush

</x-app-layout>
