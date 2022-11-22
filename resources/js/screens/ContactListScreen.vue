<script setup>
import { onMounted, ref } from "vue";
import AlertComponent from '../components/AlertComponent.vue'
import SlideOverComponent from '../components/SlideOverComponent.vue'

let contatos = ref([])
let hasContatos = ref(false)
let openSlideOver = ref({
  value: false,
  setValue() {
    this.value = !this.value
  }
})

onMounted(async () => {
  // await getContacts()
  await axios
    .get("/api/get_contacts")
    .then(response => {
      contatos.value = response.data.contacts;
      if(contatos.value.length == 0){
        hasContatos.value = true
      }
    });
});

const editarContato = (id) => {
  openSlideOver.value = !openSlideOver.value;
  console.log("Abrir")
}

const deletarContato = (id) => {

}

</script>

<template>
  <div class="flex h-full bg-white">
    <div class="mx-auto py-20 w-3/5">
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
                    <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                      <a class="text-green-500 hover:text-green-700" href="#" @click="editarContato(contato.id)">
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
           <AlertComponent titulo="Não há contatos" mensagem="Ainda não foram cadastrados novos contatos" botao="Cadastrar" cor="green" v-if="hasContatos == true"/>
          </div>
        </div>
      </div>
    </div>
    <SlideOverComponent v-bind:open="openSlideOver.value"/>
  </div>
</template>