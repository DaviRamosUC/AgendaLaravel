<script setup>
import { onMounted, ref } from "vue";
import AlertComponent from '../components/AlertComponent.vue'
import CustomAlertComponent from '../components/CustomAlertComponent.vue'
import SlideOverComponent from '../components/SlideOverComponent.vue'
import router from '../router'

let contatos = ref([])
let hasContatos = ref(false)

onMounted(async () => {
  consultaContatos()
});

const consultaContatos = async () => {
  await axios
    .get("/api/get_contacts")
    .then(response => {
      contatos.value = response.data.contacts;
      if (contatos.value.length == 0) {
        hasContatos.value = true
      }
    });
}

const open = ref(false)
const slideOver = ref(null)

const editarContato = (value) => {
  open.value = true;
  slideOver.value.preencher(value)
}

const deletarContato = async (id) => {
  await axios
    .delete(`/api/deletecontact/${id}`,)
    .then(response => {
      if (response.status == 200) {
        router.go()
      } else {

      }
    });
}

const verEndereco = () => {

}

const redireciona = () => {
  router.push('/registcontact')
}

</script>

<template>
  <div class="flex h-full bg-white">
    <div class="mx-auto py-20 w-4/5">
      <div class="flex flex-col">
        <div class="overflow-x-auto">
          <div class="p-1.5 w-full inline-block align-middle">
            <div class="overflow-hidden border rounded-lg" v-if="contatos.length > 0">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col" class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase">
                      ID
                    </th>
                    <th scope="col" class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase">
                      Nome
                    </th>
                    <th scope="col" class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase">
                      Email
                    </th>
                    <th scope="col" class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase">
                      Telefone
                    </th>
                    <th scope="col" class="px-6 py-3 text-xs font-bold text-right text-gray-500 uppercase">
                      Endereço
                    </th>
                    <th scope="col" class="px-6 py-3 text-xs font-bold text-right text-gray-500 uppercase">
                      Editar
                    </th>
                    <th scope="col" class="px-6 py-3 text-xs font-bold text-right text-gray-500 uppercase">
                      Deletar
                    </th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                  <tr v-for="contato in contatos" :key="contato.id">
                    <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap">
                      {{ contato.id }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                      {{ contato.nome }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                      {{ contato.email }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                      {{ contato.telefone }}
                    </td>
                    <td class="px-6 py-4 text-sm font-medium text-center whitespace-nowrap">
                      <a class="text-blue-500 hover:text-blue-700" href="#" @click="verEndereco(contato)">
                        Ver
                      </a>
                    </td>
                    <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                      <a class="text-green-500 hover:text-green-700" href="#" @click="editarContato(contato)">
                        Editar
                      </a>
                    </td>
                    <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                      <a class="text-red-500 hover:text-red-700" href="#" @click="deletarContato(contato.id)">
                        Deletar
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <AlertComponent titulo="Não há contatos" mensagem="Ainda não foram cadastrados novos contatos"
              botao="Cadastrar" cor="green" :redireciona="redireciona" v-if="hasContatos == true" />
          </div>
        </div>
      </div>
    </div>
    <SlideOverComponent :newOpen="open" ref="slideOver" />
    <CustomAlertComponent botao="Cadastrar" cor="green" :redireciona="redireciona" />
  </div>
</template>