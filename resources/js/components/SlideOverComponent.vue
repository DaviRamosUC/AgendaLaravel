<script>
import { ref } from 'vue'
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { XMarkIcon } from '@heroicons/vue/24/outline'
import router from '../router'

export default {
  data() {
    return {
      id: null,
      nome: '',
      sobrenome: '',
      email: '',
      telefone: '',
      cep: '',
      estado: '',
      bairro: '',
      logradouro: '',
      numero: '',
      cidade: '',
      states: {
        'AC': 'Acre',
        'AL': 'Alagoas',
        'AP': 'Amapá',
        'AM': 'Amazonas',
        'BA': 'Bahia',
        'CE': 'Ceará',
        'DF': 'Distrito Federal',
        'ES': 'Espírito Santo',
        'GO': 'Goías',
        'MA': 'Maranhão',
        'MT': 'Mato Grosso',
        'MS': 'Mato Grosso do Sul',
        'MG': 'Minas Gerais',
        'PA': 'Pará',
        'PB': 'Paraíba',
        'PR': 'Paraná',
        'PE': 'Pernambuco',
        'PI': 'Piauí',
        'RJ': 'Rio de Janeiro',
        'RN': 'Rio Grande do Norte',
        'RS': 'Rio Grande do Sul',
        'RO': 'Rondônia',
        'RR': 'Roraíma',
        'SC': 'Santa Catarina',
        'SP': 'São Paulo',
        'SE': 'Sergipe',
        'TO': 'Tocantins',
      },
      newOpen: ref(false),
    }
  },
  methods: {
    handleSubmit: async function (submitEvent) {
      const form = submitEvent.target.elements
      let id = this.id;
      let nome = form.nome.value;
      let sobrenome = form.sobrenome.value;
      let email = form.email.value;
      let telefone = form.telefone.value;
      let logradouro = form.logradouro.value;
      let bairro = form.bairro.value;
      let numero = form.numero.value;
      let cidade = form.cidade.value;
      let estado = form.estado.value;
      let cep = form.cep.value;
      
      await axios
        .put(`/api/updatecontact/${id}`, {
          id,
          nome,
          sobrenome,
          email,
          telefone,
          cep,
          estado,
          bairro,
          logradouro,
          numero,
          cidade,
        })
        .then(response => {
          router.go()
        });
    },
    preencher: function (contato) {
      this.id = contato.id
      this.nome = contato.nome;
      this.sobrenome = contato.sobrenome;
      this.email = contato.email;
      this.telefone = contato.telefone;
      this.cep = contato.addresses.CEP;
      this.estado = contato.addresses.estado;
      this.bairro = contato.addresses.bairro;
      this.logradouro = contato.addresses.endereco;
      this.numero = contato.addresses.numero;
      this.cidade = contato.addresses.cidade;
      this.newOpen = true
    }
  },
  components: {
    Dialog,
    DialogPanel,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
    XMarkIcon
  },
}
</script>

<template>
  <TransitionRoot as="template" :show="newOpen">
    <Dialog as="div" class="relative z-10" @close="newOpen = false">
      <TransitionChild as="template" enter="ease-in-out duration-500" enter-from="opacity-0" enter-to="opacity-100"
        leave="ease-in-out duration-500" leave-from="opacity-100" leave-to="opacity-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
      </TransitionChild>

      <div class="fixed inset-0 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
          <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
            <TransitionChild as="template" enter="transform transition ease-in-out duration-500 sm:duration-700"
              enter-from="translate-x-full" enter-to="translate-x-0"
              leave="transform transition ease-in-out duration-500 sm:duration-700" leave-from="translate-x-0"
              leave-to="translate-x-full">
              <DialogPanel class="pointer-events-auto relative w-screen max-w-md">
                <TransitionChild as="template" enter="ease-in-out duration-500" enter-from="opacity-0"
                  enter-to="opacity-100" leave="ease-in-out duration-500" leave-from="opacity-100" leave-to="opacity-0">
                  <div class="absolute top-0 left-0 -ml-8 flex pt-4 pr-2 sm:-ml-10 sm:pr-4">
                    <button type="button"
                      class="rounded-md text-gray-300 hover:text-white focus:outline-none focus:ring-2 focus:ring-white"
                      @click="newOpen = false">
                      <span class="sr-only">Close panel</span>
                      <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                    </button>
                  </div>
                </TransitionChild>
                <div class="flex h-full flex-col overflow-y-scroll bg-white py-6 shadow-xl">
                  <div class="px-4 sm:px-6">
                    <DialogTitle class="text-lg font-medium text-gray-900">Editar contato</DialogTitle>
                  </div>
                  <div class="relative mt-6 flex-1 px-4 sm:px-6">
                    <!-- Replace with your content -->
                    <form @submit.prevent="handleSubmit">
                      <div class="overflow-hidden shadow sm:rounded-md">
                        <div class="bg-white px-4 py-5 sm:p-6">
                          <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                              <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                              <input type="text" name="nome" id="nome" autocomplete="given-name" required v-model="nome"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                              <label for="sobrenome" class="block text-sm font-medium text-gray-700">Sobrenome</label>
                              <input type="text" name="sobrenome" id="sobrenome" autocomplete="family-name" required
                                v-model="sobrenome"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                              <label for="email" class="block text-sm font-medium text-gray-700">Endereço de
                                e-mail</label>
                              <input type="text" name="email" id="email" autocomplete="email" required v-model="email"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                              <label for="telefone" class="block text-sm font-medium text-gray-700">Telefone</label>
                              <input type="tel" name="telefone" id="telefone" autocomplete="tel" required
                                v-model="telefone"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                            </div>

                            <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                              <label for="cep" class="block text-sm font-medium text-gray-700">CEP</label>
                              <input type="text" name="cep" id="cep" autocomplete="postal-code"
                                onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                placeholder="ex: 24910530" required v-model="cep"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                              <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                              <select id="estado" name="estado" autocomplete="country-name" required v-model="estado"
                                class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                <option v-for="estado_nome in states" :key="estado_nome">{{ estado_nome }}</option>
                              </select>
                            </div>

                            <div class="col-span-3">
                              <label for="bairro" class="block text-sm font-medium text-gray-700">Bairro</label>
                              <input type="text" name="bairro" id="bairro" required v-model="bairro"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                            </div>

                            <div class="col-span-3">
                              <label for="logradouro" class="block text-sm font-medium text-gray-700">Logradouro</label>
                              <input type="text" name="logradouro" id="logradouro" autocomplete="street-address"
                                required v-model="logradouro"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                            </div>


                            <div class="col-span-3">
                              <label for="numero" class="block text-sm font-medium text-gray-700">Número</label>
                              <input type="text" name="numero" id="numero" v-model="numero"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                            </div>

                            <div class="col-span-3 sm:col-span-3 lg:col-span-3">
                              <label for="cidade" class="block text-sm font-medium text-gray-700">Cidade</label>
                              <input type="text" name="cidade" id="cidade" autocomplete="address-level2" required
                                v-model="cidade"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                            </div>
                          </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                          <button type="submit"
                            class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Enviar</button>
                        </div>
                      </div>
                    </form>
                    <!-- /End replace -->
                  </div>
                </div>
              </DialogPanel>
            </TransitionChild>
          </div>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>